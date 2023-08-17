<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::patch('/profile/{id}', 'HomeController@update')->name('profile.edit');
    Route::resource('/home', 'HomeController');
    // Master Car
    Route::get('/m-cars-list', 'MCarController@list')->name('m-cars-list');
    Route::resource('/m-cars','MCarController');
    // Peminjaman
    Route::get('/t-car-loans-list', 'TCarLoanController@list')->name('t-car-loans-list');
    Route::resource('/t-car-loans','TCarLoanController');
    // Pengembalian
    Route::post('/t-car-returns-check', 'TCarReturnController@check')->name('t-car-returns.check');
    Route::resource('/t-car-returns','TCarReturnController');

});