<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AbsensiController;

// Halaman utama (Welcome page)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rute Materi (Siswa dan Pengajar)
Route::get('/materi', [MateriController::class, 'index'])->name('materi.index'); // Siswa
Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create'); // Pengajar
Route::post('/materi', [MateriController::class, 'store'])->name('materi.store'); // Pengajar
Route::get('/materi/download/{materi}', [MateriController::class, 'download'])->name('materi.download'); // Siswa
Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy'); // Pengajar

// Rute Otentikasi
Auth::routes();

// Rute untuk halaman home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute untuk Admin (Mengelola Pengguna)
Route::prefix('admin')->middleware('auth')->group(function () {
    // Melihat semua pengguna
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users.index');
    // Form tambah pengguna
    Route::get('/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    // Simpan pengguna baru
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    // Form edit pengguna
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    // Update pengguna
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    // Hapus pengguna
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

use App\Http\Controllers\TaskController;

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');



// Halaman daftar pengguna
Route::get('admin/users', [AdminController::class, 'index'])->name('admin.users.index');

// Menambah Pengajar
Route::get('admin/users/create/pengajar', [AdminController::class, 'createPengajar'])->name('admin.users.createPengajar');

// Menambah Siswa
Route::get('admin/users/create/siswa', [AdminController::class, 'createSiswa'])->name('admin.users.createSiswa');

// Menyimpan pengguna baru
Route::post('admin/users', [AdminController::class, 'store'])->name('admin.users.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

// Rute untuk halaman Contact Person
Route::get('/contact', [ContactController::class, 'index'])->name('contact');



Route::middleware(['auth'])->group(function () {
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
});

Route::get('/absensi/rekap', [AbsensiController::class, 'rekap'])->name('absensi.rekap');

Route::get('/rekap-siswa', [AbsensiController::class, 'rekapSiswa'])->name('absensi.rekap-siswa');

// Tambahkan route untuk export PDF
Route::get('/absensi/export-pdf', [AbsensiController::class, 'exportPDF'])->name('absensi.export-pdf');