<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\ReservasiController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Auth::routes();
Route::get('/logout', [HomeController::class, 'logout'])->name('keluar');

// User General
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/kamar', [HomeController::class, 'kamar'])->name('kamar');
Route::get('/fasilitas', [HomeController::class, 'fasilitas'])->name('fasilitas');
Route::get('/cek-jumlah-kamar/{id}', [HomeController::class, 'cekJKamar'])->name('cekJKamar');

Route::group(['middleware' => ['auth']], function () {
    Route::put('/update-profile', [HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/update-profile', [HomeController::class, 'updateProfile'])->name('updateProfile');
});

Route::group(['middleware' => ['auth','pemesan']], function () {
    Route::post('/save-reservasi', [ReservasiController::class, 'indexAdd'])->name('indexAdd');
    Route::get('/riwayat-pesanan', [HomeController::class, 'riwayatPesanan'])->name('riwayatPesanan');
    Route::get('/bukti-reservasi-pdf/{date}', [ReservasiController::class, 'ReservasiPDF'])->name('ReservasiPDF');
    Route::get('/bukti-reservasi-print/{date}', [ReservasiController::class, 'ReservasiPrint'])->name('ReservasiPrint');
    Route::get('/bukti-reservasi-print-redirect/', [ReservasiController::class, 'ReservasiPrint'])->name('ReservasiRedirect');
    Route::post('/riwayat-pesanan/download-pdf/{id}/{date}', [ReservasiController::class, 'RiwayatPDF'])->name('RiwayatPDF');
    Route::post('/riwayat-pesanan/print/{id}/{date}', [ReservasiController::class, 'RiwayatPDFPrint'])->name('RiwayatPDFPrint');
});

Route::group(['middleware' => ['auth','admin']], function () {

    // Kamar
    Route::get('/admin', [AdminController::class, 'kamar'])->name('Adminkamar');
    Route::post('/admin/save-kamar', [AdminController::class, 'saveKamar'])->name('saveKamar');
    Route::get('/admin/edit-kamar/{id}', [AdminController::class, 'editKamar'])->name('editKamar');
    Route::put('/admin/update-kamar/{id}', [AdminController::class, 'updateKamar'])->name('updateKamar');
    Route::get('/admin/konfirmasi-hapus-kamar/{id}', [AdminController::class, 'konfirHapus'])->name('konfirHapus');
    Route::delete('/admin/delete-kamar/{id}', [AdminController::class, 'deleteKamar'])->name('deleteKamar');

    // Fasilitas Hotel
    Route::get('/admin/fasilitas-hotel', [AdminController::class, 'fasilitasHotel'])->name('fasilitasHotel');
    Route::post('/admin/save-fasilitas-hotel', [AdminController::class, 'saveFhotel'])->name('saveFhotel');
    Route::get('/admin/find-fasilitas-hotel/{id}', [AdminController::class, 'FHotel'])->name('FHotel');
    Route::delete('/admin/delete-fasilitas-hotel/{id}', [AdminController::class, 'deleteFHotel'])->name('deleteFHotel');
    Route::put('/admin/update-fasilitas-hotel/{id}', [AdminController::class, 'updateFHotel'])->name('updateFHotel');

    // Fasilitas Kamar
    Route::get('/admin/fasilitas-kamar', [AdminController::class, 'fasilitasKamar'])->name('fasilitasKamar');
    Route::get('/admin/find-fasilitas-kamar/{id}', [AdminController::class, 'findFKamar'])->name('findFKamar');
    Route::post('/admin/save-fasilitas-kamar', [AdminController::class, 'saveFasilitasKamar'])->name('saveFasilitasKamar');
    Route::put('/admin/update-fasilitas-kamar/{id}', [AdminController::class, 'updateFKamar'])->name('updateFKamar');
    Route::delete('/admin/delete-fasilitas-kamar/{id}', [AdminController::class, 'deleteFKamar'])->name('deleteFKamar');
});

Route::group(['middleware' => ['auth','resepsionis']], function () {
    Route::get('/resepsionis', [ResepsionisController::class, 'reservasi'])->name('Rreservasi');
    Route::get('/resepsionis/kamar', [ResepsionisController::class, 'index'])->name('resepsionis');
    Route::get('/resepsionis/fasilitas-kamar', [ResepsionisController::class, 'fasilKamar'])->name('RfasilKamar');
    Route::get('/resepsionis/fasilitas-hotel', [ResepsionisController::class, 'fasilHotel'])->name('RfasilHotel');
    Route::post('/resepsionis/reservasi/filter-date', [ResepsionisController::class, 'dateFilter'])->name('RdateFilter');
    Route::post('/resepsionis/reservasi/search-tamu', [ResepsionisController::class, 'searchTamu'])->name('searchTamu');
    Route::get('/resepsionis/selesai-pemesanan/{id}', [ResepsionisController::class, 'Dreservasi'])->name('Dreservasi');
    Route::put('/resepsionis/selesai-pemesanan/{id}', [ResepsionisController::class, 'Ureservasi'])->name('Ureservasi');
});