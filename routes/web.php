<?php


use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// // Tampilkan semua data pegawai
// Route::get('/pegawai',[PegawaiController::class, 'index'])->name('pegawai.index');
// // Form tambah pegawai
// Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
// // Simpan pegawai baru
// Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
// // Form edit pegawai
// Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
// // Form update pegawai
// Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
// //Form hapus pegawai
// Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

// Route::resource('pegawai', PegawaiController::class);
