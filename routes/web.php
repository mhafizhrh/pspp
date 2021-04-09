<?php

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

Route::middleware(['auth'])->group(function () {
	Route::middleware(['admin'])->group(function () {
		Route::get('/', 'DashboardController@index')->name('dashboard');
		Route::get('dashboard', 'DashboardController@index');
		// Data Siswa
		Route::get('data-siswa', 'DataSiswaController@index')->name('data-siswa');
		Route::get('data-siswa/tambah', 'DataSiswaController@tambahDataSiswa');
		Route::post('data-siswa/tambah', 'DataSiswaController@postDataSiswa');
		Route::get('data-siswa/{nisn}', 'DataSiswaController@editDataSiswa');
		Route::put('data-siswa/{nisn}', 'DataSiswaController@putDataSiswa')->name('putDataSiswa');
		Route::delete('data-siswa', 'DataSiswaController@deleteDataSiswa');
		Route::post('data-siswa/search/redirect-keyword', 'DataSiswaController@redirectKeyword')->name('data-siswa-redirect-keyword');
		Route::get('data-siswa/search/{keyword}', 'DataSiswaController@search')->name('data-siswa-search');

		// Data Petugas

		Route::get('data-petugas', 'DataPetugasController@index')->name('data-petugas');
		Route::post('data-petugas-redirect-keyword', 'DataPetugasController@redirectKeyword')->name('data-petugas-redirect-keyword');
		Route::get('data-petugas/search/{keyword}', 'DataPetugasController@search')->name('data-petugas-search');
		Route::get('data-petugas/tambah', 'DataPetugasController@create')->name('create-data-petugas');
		Route::post('data-petugas/tambah', 'DataPetugasController@store')->name('store-data-petugas');
		Route::get('data-petugas/{id}', 'DataPetugasController@edit')->name('edit-data-petugas');
		Route::put('data-petugas/{id}', 'DataPetugasController@put')->name('put-data-petugas');
		Route::delete('data-petugas', 'DataPetugasController@destroy');

		// Data Kelas

		Route::get('data-kelas', 'DataKelasController@index')->name('data-kelas');
		Route::post('data-kelas-redirect-keyword', 'DataKelasController@redirectKeyword')->name('data-kelas-redirect-keyword');
		Route::get('data-kelas/search/{keyword}', 'DataKelasController@search')->name('data-kelas-search');
		Route::get('data-kelas/tambah', 'DataKelasController@create')->name('create-data-kelas');
		Route::post('data-kelas/tambah', 'DataKelasController@store')->name('store-data-kelas');
		Route::get('data-kelas/{id}', 'DataKelasController@edit')->name('edit-data-kelas');
		Route::put('data-kelas/{id}', 'DataKelasController@put')->name('put-data-kelas');
		Route::delete('data-kelas', 'DataKelasController@destroy');

		// SPP
		Route::get('transaksi/entri-data-spp', 'EntriDataSPPController@index');
		Route::post('transaksi/bayar-spp-siswa', 'EntriDataSPPController@bayarSPPSiswa');
		Route::post('transaksi/cari-data-siswa', 'EntriDataSPPController@cariDataSiswa');
		Route::post('transaksi/data-spp-siswa', 'EntriDataSPPController@dataSPPSiswa');

		// Tahun Pelajaran
		Route::get('transaksi/atur-tahun-pelajaran', 'EntriDataSPPController@dataTahunPelajaran');
		Route::delete('transaksi/atur-tahun-pelajaran', 'EntriDataSPPController@deleteTahunPelajaran');
		Route::get('transaksi/atur-tahun-pelajaran/tambah', 'EntriDataSPPController@tambahTahunPelajaran');
		Route::post('transaksi/atur-tahun-pelajaran/tambah', 'EntriDataSPPController@postTahunPelajaran');
		Route::post('transaksi/atur-tahun-pelajaran', 'EntriDataSPPController@setTahunPelajaran');

		Route::get('transaksi/riwayat-spp', 'RiwayatSPP@index')->name('riwayat-spp');
		Route::post('transaksi/riwayat-spp/search/redirect-keyword', 'RiwayatSPP@redirectKeyword')->name('riwayat-spp-redirect-keyword');
		Route::get('transaksi/riwayat-spp/search/{keyword}', 'RiwayatSPP@search')->name('riwayat-spp-search');

		// Laporan

		Route::get('laporan', 'LaporanController@index')->name('laporan');
		Route::post('laporan/pembayaran-spp', 'LaporanController@LaporanPembayaranSpp')->name('laporan-pembayaran-spp');
		Route::post('laporan/pembayaran-spp-pertahun', 'LaporanController@LaporanPembayaranSppPertahun')->name('laporan-pembayaran-spp-pertahun');
		Route::post('laporan/pembayaran-spp-perbulan', 'LaporanController@LaporanPembayaranSppPerbulan')->name('laporan-pembayaran-spp-perbulan');
	});

	Route::middleware(['petugas'])->group(function () {

		Route::get('/', 'DashboardController@index')->name('dashboard');
		Route::get('dashboard', 'DashboardController@index');

		// SPP
		Route::get('transaksi/entri-data-spp', 'EntriDataSPPController@index');
		Route::post('transaksi/bayar-spp-siswa', 'EntriDataSPPController@bayarSPPSiswa');
		Route::post('transaksi/cari-data-siswa', 'EntriDataSPPController@cariDataSiswa');
		Route::post('transaksi/data-spp-siswa', 'EntriDataSPPController@dataSPPSiswa');

		// Riwayat SPP
		Route::get('transaksi/riwayat-spp', 'RiwayatSPP@index')->name('riwayat-spp');
		Route::post('transaksi/riwayat-spp/search/redirect-keyword', 'RiwayatSPP@redirectKeyword')->name('riwayat-spp-redirect-keyword');
		Route::get('transaksi/riwayat-spp/search/{keyword}', 'RiwayatSPP@search')->name('riwayat-spp-search');

	});

	Route::middleware(['siswa'])->group(function () {

		Route::get('/', 'DashboardController@index')->name('dashboard');
		Route::get('dashboard', 'DashboardController@index');

		// Dashboard
		Route::post('transaksi/cari-data-siswa', 'EntriDataSPPController@cariDataSiswa');
		Route::post('transaksi/data-spp-siswa', 'EntriDataSPPController@dataSPPSiswa');

		// Riwayat SPP
		Route::get('transaksi/riwayat-spp', 'RiwayatSPP@index')->name('riwayat-spp');
		Route::post('transaksi/riwayat-spp/search/redirect-keyword', 'RiwayatSPP@redirectKeyword')->name('riwayat-spp-redirect-keyword');
		Route::get('transaksi/riwayat-spp/search/{keyword}', 'RiwayatSPP@search')->name('riwayat-spp-search');

	});

	Route::get('pengaturan', 'PengaturanController@index')->name('pengaturan');
	Route::put('pengaturan', 'PengaturanController@update')->name('pengaturan-update');
});


Route::get('logout', 'AuthController@logout');

// Auth
Route::get('login', 'AuthController@login')->name('login');
Route::post('login/validate', 'AuthController@validateLogin')->name('validate_login');
Route::get('login/failed', function () {
    return 'Gagal Login';
})->name('auth.failed');
