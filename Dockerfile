# ===============================
# Stage 1 — Composer dependencies
# ===============================
FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader

# ===============================
# Stage 2 — Vite build
# ===============================
FROM node:20-alpine AS assets
WORKDIR /app

COPY package.json package-lock.json* ./
RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi

COPY vite.config.* ./
COPY resources ./resources

RUN npm run build

# ===============================
# Stage 3 — PHP 8.2 + Apache runtime
# ===============================
FROM php:8.2-apache AS runtime

WORKDIR /var/www/html

# --- Install system & PHP dependencies ---
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libonig-dev \
        unzip \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        bcmath \
        opcache \
    && a2enmod rewrite \
    && apt-get purge -y --auto-remove \
    && rm -rf /var/lib/apt/lists/*

# --- PHP OPcache (production tuned) ---
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.enable_cli=0"; \
    echo "opcache.memory_consumption=192"; \
    echo "opcache.interned_strings_buffer=16"; \
    echo "opcache.max_accelerated_files=20000"; \
    echo "opcache.validate_timestamps=0"; \
} > /usr/local/etc/php/conf.d/opcache.ini

# --- Apache config: serve /public ---
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' \
        /etc/apache2/sites-available/000-default.conf \
 && sed -ri 's!AllowOverride None!AllowOverride All!g' \
        /etc/apache2/apache2.conf

# --- Copy application source ---
COPY . .

# --- Copy build artifacts ---
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

# --- Laravel permissions ---
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R ug+rwx storage bootstrap/cache

EXPOSE 80

# --- Start container ---
CMD ["bash", "-lc", "\
php artisan storage:link || true && \
php artisan migrate --force || true && \
exec apache2-foreground \
"]
