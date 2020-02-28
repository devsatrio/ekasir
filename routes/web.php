<?php
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/getlistdata','admincontroller@getlistdata');
Route::resource('admin','admincontroller');

Route::get('stokbarang/kurangi','barangcontroller@kurangistok');
Route::get('barang/carikode/{kode}','barangcontroller@carikode');
Route::get('barang/getlistdata','barangcontroller@getlistdata');
Route::resource('barang','barangcontroller');