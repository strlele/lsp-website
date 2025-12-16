<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Models\Berita;
use App\Http\Controllers\LspController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\SkemaAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [LspController::class, 'index'])->name('home');
Route::view('/profile', 'profileKami')->name('profile');
Route::view('/kontak-kami', 'kontakKami')->name('kontak.kami');

// Berita (public)
Route::get('/berita', function () {
    $q = trim((string) request('q'));
    $query = Berita::where('status', 'publish');
    if ($q !== '') {
        $query->where(function ($sub) use ($q) {
            $sub->where('judul', 'like', "%{$q}%")
                ->orWhere('isi', 'like', "%{$q}%");
        });
    }
    $beritas = $query->latest('tanggal')->paginate(9)->appends(request()->query());
    return view('berita.index', compact('beritas'));
})->name('berita.index');
Route::get('/berita/{berita:slug}', function (Berita $berita) {
    if ($berita->status !== 'publish') {
        abort(404);
    }
    return view('berita.show', compact('berita'));
})->name('berita.show');
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

    // Admin Login Alias (points to same login form)
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login.admin')->middleware('guest');

    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});

// Admin CMS
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');
    Route::get('/slideshow', [SlideshowController::class, 'index'])->name('slideshow.index');
    Route::get('/slideshow/create', [SlideshowController::class, 'create'])->name('slideshow.create');
    Route::post('/slideshow', [SlideshowController::class, 'store'])->name('slideshow.store');
    Route::get('/slideshow/{slideshow}/edit', [SlideshowController::class, 'edit'])->name('slideshow.edit');
    Route::put('/slideshow/{slideshow}', [SlideshowController::class, 'update'])->name('slideshow.update');
    Route::delete('/slideshow/{slideshow}', [SlideshowController::class, 'destroy'])->name('slideshow.destroy');

    // Provide admin-scoped alias for Berita index to satisfy links using admin.berita.index
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    // kategori (CMS)
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // skema
    Route::get('/skema', [SkemaController::class, 'adminIndex'])->name('skema.index');
    Route::get('/skema/create', [SkemaController::class, 'create'])->name('skema.create');
    Route::post('/skema', [SkemaController::class, 'store'])->name('skema.store');
    Route::get('/skema/{skema}', [SkemaController::class, 'show'])->name('skema.show');
    Route::get('/skema/{skema}/edit', [SkemaController::class, 'edit'])->name('skema.edit');
    Route::put('/skema/{skema}', [SkemaController::class, 'update'])->name('skema.update');
    Route::delete('/skema/{skema}', [SkemaController::class, 'destroy'])->name('skema.destroy');

    // kompetensi (CMS)
    Route::get('/kompetensi', [KompetensiController::class, 'index'])->name('kompetensi.index');
    Route::get('/kompetensi/create', [KompetensiController::class, 'create'])->name('kompetensi.create');
    Route::post('/kompetensi', [KompetensiController::class, 'store'])->name('kompetensi.store');
    Route::get('/kompetensi/{kompetensi}', [KompetensiController::class, 'show'])->name('kompetensi.show');
    Route::get('/kompetensi/{kompetensi}/edit', [KompetensiController::class, 'edit'])->name('kompetensi.edit');
    Route::put('/kompetensi/{kompetensi}', [KompetensiController::class, 'update'])->name('kompetensi.update');
    Route::delete('/kompetensi/{kompetensi}', [KompetensiController::class, 'destroy'])->name('kompetensi.destroy');

    // pendaftar (CMS)
    Route::get('/pendaftar', [\App\Http\Controllers\Admin\PendaftaranAdminController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftar/{pendaftaran}', [\App\Http\Controllers\Admin\PendaftaranAdminController::class, 'show'])->name('pendaftaran.show');

    // subkategori (CMS)
    Route::get('/subkategori', [\App\Http\Controllers\SubKategoriController::class, 'index'])->name('subkategori.index');
    Route::get('/subkategori/create', [\App\Http\Controllers\SubKategoriController::class, 'create'])->name('subkategori.create');
    Route::post('/subkategori', [\App\Http\Controllers\SubKategoriController::class, 'store'])->name('subkategori.store');
    Route::get('/subkategori/{subkategori}/edit', [\App\Http\Controllers\SubKategoriController::class, 'edit'])->name('subkategori.edit');
    Route::put('/subkategori/{subkategori}', [\App\Http\Controllers\SubKategoriController::class, 'update'])->name('subkategori.update');
    Route::delete('/subkategori/{subkategori}', [\App\Http\Controllers\SubKategoriController::class, 'destroy'])->name('subkategori.destroy');
});

Route::get('/skema', [SkemaController::class, 'index'])->name('skema.index');
Route::get('/skema/{skema}', [SkemaController::class, 'show'])->name('skema.show');

// Pendaftaran (wizard)
Route::get('/pendaftaran', [PendaftaranController::class, 'step1'])->name('pendaftaran.step1');
Route::post('/pendaftaran', [PendaftaranController::class, 'storeStep1'])->name('pendaftaran.step1.store');
Route::get('/pendaftaran/portofolio', [PendaftaranController::class, 'step2'])->name('pendaftaran.step2');
Route::post('/pendaftaran/portofolio', [PendaftaranController::class, 'storeStep2'])->name('pendaftaran.step2.store');
Route::get('/pendaftaran/asesmen', [PendaftaranController::class, 'step3'])->name('pendaftaran.step3');
Route::post('/pendaftaran/submit', [PendaftaranController::class, 'submit'])->name('pendaftaran.submit');


