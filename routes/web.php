<?php

use App\Http\Controllers\UrlCheckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

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
})->name('home');

Route::resource('urls', UrlController::class)->only([
    'index', 'store', 'show'
]);

Route::resource('urls/{id}/checks', UrlCheckController::class)->only([
    'store'
]);
