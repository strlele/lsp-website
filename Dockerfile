# Multi-stage Dockerfile for Laravel (PHP 8.2 + Apache + Vite)

# --- Stage 1: Composer dependencies ---
FROM composer:2 AS vendor
WORKDIR /app

# Copy only composer files to leverage Docker layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-progress --no-scripts

# --- Stage 2: Node build for assets (Vite) ---
FROM node:20-alpine AS assets
WORKDIR /app

# Install dependencies using cached layers where possible
COPY package.json package-lock.json* ./
RUN [ -f package-lock.json ] && npm ci --no-audit --no-fund || npm install --no-audit --no-fund

# Copy only files needed for asset build
COPY vite.config.js* ./
COPY resources ./resources

# Build assets (adjust if your build script differs)
RUN npm run build

# --- Stage 3: Runtime (PHP 8.2 + Apache) ---
FROM php:8.2-apache AS runtime

# Set working directory to Apache docroot
WORKDIR /var/www/html

# Install system dependencies and PHP extensions commonly required by Laravel
# Note: keep this minimal; add/remove as your app requires
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       libzip4 libzip-dev libonig-dev unzip git \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j"$(nproc)" \
       pdo_mysql \
       mbstring \
       exif \
       bcmath \
       opcache \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Copy application source
COPY . .

# Copy Composer vendor directory from Stage 1
COPY --from=vendor /app/vendor ./vendor

# Copy built assets from Stage 2 into public/build (Vite default)
COPY --from=assets /app/dist ./public/build

# Configure Apache to serve from public/ and enable rewrites
# Update DocumentRoot and Directory directives
RUN sed -ri 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' /etc/apache2/sites-available/000-default.conf \
 && sed -ri 's#<Directory /var/www/>#<Directory /var/www/html/public/>#' /etc/apache2/apache2.conf \
 && sed -ri 's#AllowOverride None#AllowOverride All#' /etc/apache2/apache2.conf

# Set correct permissions for Laravel storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R ug+rwx storage bootstrap/cache

# Expose HTTP port
EXPOSE 80

# Environment defaults (override at runtime)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0 \
    PHP_OPCACHE_MAX_ACCELERATED_FILES=20000 \
    PHP_OPCACHE_MEMORY_CONSUMPTION=192 \
    PHP_OPCACHE_INTERNED_STRINGS_BUFFER=16

# Optional: optimize autoload (safe at build time)
RUN composer dump-autoload --optimize --no-dev --no-interaction || true

# Note: Do NOT bake .env into the image. Provide env vars at runtime.

# Start Apache in foreground
# Run database reset and seed, ensure storage symlink, then start Apache
CMD ["bash", "-lc", "php artisan migrate:fresh --seed --force && php artisan storage:link || true; exec apache2-foreground"]
