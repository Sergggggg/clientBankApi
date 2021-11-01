<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function (){
    return view('home');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::post('/sent', [App\Http\Controllers\LanguageController::class, 'sent'])->name('sent');

Route::get('/page/{id}', [App\Http\Controllers\LanguageController::class, 'page']);

Route::get('/',  [App\Http\Controllers\LanguageController::class, 'index']);

Route::get('change/locale/{lang}', [App\Http\Controllers\LanguageController::class, 'switchLang']);

Route::post('/redirect',  [App\Http\Controllers\Api\Auth\AuthController::class, 'redirect']);

Route::get('/bank/paket',  [App\Http\Controllers\BankPaketDataController::class, 'oauthApp']);

/**
 * Show the registration app page.
 */
Route::get('/registration/app', function (){
    return view('registration_app');
});

Route::get('/access/api/', function (){
    return view('access_api');
});