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

Route::get('/', function () {
    return view('welcome');
});
Route::view('/payment', 'payment.index');

Route::post('/create-checkout-session', 'PaymentController@index');
Route::get('/success', 'PaymentController@success');
Route::get('/cancel', 'PaymentController@cancel');