<?php
// use Illuminate\Support\Facades\Cache;


// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |

// Route::get('/cache', function () {
//     return Cache::get('key');
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/adapt', 'AdaptController@adaptrequest');

Route::get('/getclass/{batch}/{semester}', 'HomeController@getclass');

Route::post('/changeclass','ChangeController@changeClass');

Route::post('/nochangeclass','ChangeController@noChangeClass');

Route::post('/comments','AdaptController@storeComments');
