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
Route::pattern('city_dir', '(bj|zz)');
Route::group(['domain' => 'a.com', 'prefix' => '/{city_dir}', 'middleware' => ['web']], function () {
	Route::get('/', 'Web\Home@index');
	Route::get('/test', 'Test\Index@index');
	Route::post('/map/search_range', 'Test\Index@searchVisualRange')->name('web.map.search.visual.range');
});

