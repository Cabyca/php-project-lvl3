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
});

Route::resource('urls', UrlController::class);

Route::resource('urls/{id}/checks', UrlCheckController::class)->only([
    'store'
]);
// checks.store

Route::get('/test', function() {
    if (DB::connection()->getDatabaseName())  {
        print_r(DB::connection()->getDatabaseName());
        print_r(DB::connection()->getDriverName()); //Получите имя драйвера PDO.
        print_r(DB::connection()->getConfig());


        dd('Есть контакт!');
    } else {
        return 'Соединения нет';
    }
});
