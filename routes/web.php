<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\InvoiceController;

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

Route::group(['middleware' => ['auth']], function() {
	Route::resource('homes', HomeController::class); 
	Route::resource('orders', OrderController::class);
	Route::resource('artworks', ArtworkController::class); 
	Route::resource('posts', PostController::class); 
	Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
	Route::resource('invoice', InvoiceController::class);
	Route::get('/generate-pdf/{id}', [InvoiceController::class, 'generatePDF'])->name('pdf');
	Route::get('/request-payment/{id}', [InvoiceController::class, 'requestPayment'])->name('request-payment');
	Route::post('send-email', [InvoiceController::class, 'sendEmail'])->name('send-email');
	Route::post('sendemail2', [InvoiceController::class, 'sendEmail2'])->name('sendemail2');

	Route::get('completed', [ArtworkController::class, 'completed'])->name('completed');
	Route::get('/generate-bill/{id}', [Artworkcontroller::class, 'generateBill'])->name('generate-bill');
	Route::get('/generate-billUSD/{id}', [Artworkcontroller::class, 'generateBillUSD'])->name('generate-billUSD');

	Route::get('send-email', [InvoiceController::class, 'sendEmail'])->name('send-email');

});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

