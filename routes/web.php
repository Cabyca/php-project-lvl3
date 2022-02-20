<?php

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


//Route::get('articles', [ArticleController::class, 'index']);

//Route::resource('urls', 'UrlController');

//$app->get('/schools/new', function ($request, $response) {
//    $params = [
//        'schoolData' => [],
//        'errors' => []
//    ];
//    return $this->get('renderer')->render($response, 'schools/new.phtml', $params);
//})->setName('newSchool');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('urls', UrlController::class);

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
