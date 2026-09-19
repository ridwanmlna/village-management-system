<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\Admin\WargaDesaController;
use App\Http\Controllers\Admin\AdminDesaController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\PembuatanSuratController; // ← TAMBAH INI
use App\Http\Controllers\Admin\RekapSuratController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest
Route::get('/', [GuestController::class, 'wellcome'])->name('wellcome');
Route::get('/informasi', [GuestController::class, 'informasi'])->name('informasi');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.user');
Route::post('/register', [AuthController::class, 'registerUser'])->name('register.user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboardUser'])->name('dashboard.user');
    Route::get('/notifikasi', [DashboardController::class, 'notifkasi'])->name('notifikasi');
    Route::delete('/notifikasi/{id}', [DashboardController::class, 'deleteNotifikasi'])
    ->name('notifikasi.destroy');

    // Antrian
    Route::get('/antrian', [ServiceController::class, 'antrian'])->name('antrian');
    Route::get('/antrian/{id}', [ServiceController::class, 'antrianDetail'])->name('antrian.detail');
    Route::post('/antrian', [ServiceController::class, 'antrianStore'])->name('antrian.store');

    // Pengajuan
    Route::get('/pengajuan', [ServiceController::class, 'pengajuan'])->name('pengajuan');
    Route::get('/pengajuan/{id}', [ServiceController::class, 'pengajuanDetail'])->name('pengajuan.detail');
    Route::post('/pengajuan', [ServiceController::class, 'pengajuanStore'])->name('pengajuan.store');

    // Pengaduan
    Route::get('/pengaduan', [ServiceController::class, 'pengaduan'])->name('pengaduan');
    Route::get('/pengaduan/{id}', [ServiceController::class, 'pengaduanDetail'])->name('pengaduan.detail');
    Route::post('/pengaduan', [ServiceController::class, 'pengaduanStore'])->name('pengaduan.store');
});

// Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard.admin');

    // Admin Desa
    Route::get('/admin-desa', [AdminDesaController::class, 'index'])->name('admin.desa.index');
    Route::post('/admin-desa', [AdminDesaController::class, 'store'])->name('admin.desa.store');
    Route::get('/admin-desa/{id}', [AdminDesaController::class, 'show'])->name('admin.desa.show');
    Route::get('/admin-desa/{id}/edit', [AdminDesaController::class, 'edit'])->name('admin.desa.edit');
    Route::put('/admin-desa/{id}', [AdminDesaController::class, 'update'])->name('admin.desa.update');
    Route::delete('/admin-desa/{id}', [AdminDesaController::class, 'destroy'])->name('admin.desa.destroy');

    // Warga Desa
    Route::get('/warga-desa', [WargaDesaController::class, 'index'])->name('warga.desa.index');
    Route::post('/warga-desa', [WargaDesaController::class, 'store'])->name('warga.desa.store');
    Route::get('/warga-desa/{id}', [WargaDesaController::class, 'show'])->name('warga.desa.show');
    Route::get('/warga-desa/{id}/edit', [WargaDesaController::class, 'edit'])->name('warga.desa.edit');
    Route::put('/warga-desa/{id}', [WargaDesaController::class, 'update'])->name('warga.desa.update');
    Route::delete('/warga-desa/{id}', [WargaDesaController::class, 'destroy'])->name('warga.desa.destroy');

    // Layanan
    // --- Antrian
    Route::get('/antrian', [AdminServiceController::class, 'antrian'])->name('admin.antrian.index');
    Route::get('/antrian/{id}', [AdminServiceController::class, 'antrianDetail'])
    ->name('admin.antrian.show');
    Route::delete('/antrian/{id}', [AdminServiceController::class, 'antrianDestroy'])->name('admin.antrian.destroy');
    Route::get('/antrian/{id}/cetak', [AdminServiceController::class, 'antrianCetak'])->name('admin.antrian.cetak');
    Route::put('/antrian/{id}', [AdminServiceController::class, 'antrianUpdate'])->name('admin.antrian.update');

    // --- Pengajuan
    Route::get('/pengajuan', [AdminServiceController::class, 'pengajuan'])->name('admin.pengajuan.index');
    Route::get('/pengajuan/{id}', [AdminServiceController::class, 'pengajuanDetail'])->name('admin.pengajuan.show');
    Route::put('/pengajuan/{id}', [AdminServiceController::class, 'pengajuanUpdate'])->name('admin.pengajuan.update');
    Route::delete('/pengajuan/{id}', [AdminServiceController::class, 'pengajuanDestroy'])->name('admin.pengajuan.destroy');

    // --- FITUR PEMBUATAN SURAT
    Route::prefix('pembuatan-surat')->group(function () {

        // Halaman index pilih jenis surat
        Route::get('/', [AdminServiceController::class, 'indexPembuatanSurat'])
            ->name('admin.pembuatan-surat.index');

        // Form cari NIK
        Route::get('/cari-nik', [AdminServiceController::class, 'cariNikForm'])
            ->name('admin.pembuatan-surat.cari-nik.form');

        // Proses cari NIK
        Route::post('/cari-nik', [AdminServiceController::class, 'cariNikSurat'])
            ->name('admin.pembuatan-surat.cari-nik');

        // Form pembuatan surat (menampilkan data warga dan pilihan jenis surat)
        Route::get('/buat/{nik}', [AdminServiceController::class, 'buatSurat'])
            ->name('admin.pembuatan-surat.buat');

        // Proses tombol “Buat Surat” → langsung ke template surat sesuai jenis
        Route::post('/buat-surat', [AdminServiceController::class, 'tampilTemplateSurat'])
            ->name('admin.pembuatan-surat.tampil');

        // ===== KHUSUS SKTM =====

// 1. Cari NIK Anak
Route::get('/sktm', [AdminServiceController::class, 'formCariAnak'])
    ->name('admin.surat.sktm.form');

Route::post('/sktm/cari-anak', [AdminServiceController::class, 'cariAnak'])
    ->name('admin.surat.sktm.cari-anak');

// 2. Form Cari NIK Orang Tua
Route::get('/sktm/{nik_anak}/orang-tua', [AdminServiceController::class, 'formCariOrangTua'])
    ->name('admin.surat.sktm.cari-nik-orang-tua.form');

// 3. Proses Cari NIK Orang Tua
Route::post('/sktm/cari-ortu', [AdminServiceController::class, 'cariOrangTua'])
    ->name('admin.surat.sktm.cari-nik-orang-tua');

// 4. Cetak SKTM
Route::post('/sktm/cetak', [AdminServiceController::class, 'cetakSktm'])
    ->name('admin.surat.sktm.cetak');
});

// ========================
//  MENU REKAP SURAT
// ========================
Route::get('/rekap-surat', [AdminServiceController::class, 'rekapSurat'])
     ->name('admin.rekap.surat');

Route::get('/rekap-surat/download', [AdminServiceController::class, 'downloadRekapSurat'])
     ->name('admin.rekap.pdf');
     
Route::get('/rekap-surat/print-ulang/{id}', [AdminServiceController::class, 'printUlangSurat'])
     ->name('admin.rekap.printUlang');

Route::delete('/rekap-surat/{id}', [AdminServiceController::class, 'deleteSurat'])
    ->name('admin.rekap.destroy');

    // --- Pengaduan
    Route::get('/pengaduan', [AdminServiceController::class, 'pengaduan'])->name('admin.pengaduan.index');
    Route::get('/pengaduan/{id}', [AdminServiceController::class, 'pengaduanDetail'])->name('admin.pengaduan.show');
    Route::put('/pengaduan/{id}', [AdminServiceController::class, 'pengaduanUpdate'])->name('admin.pengaduan.update');
    Route::delete('/pengaduan/{id}', [AdminServiceController::class, 'pengaduanDestroy'])->name('admin.pengaduan.destroy');
});
