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
Route::pattern('subdomain', '(bj|zz)');
Route::group(['domain' => '{subdomain}.a.com', 'middleware' => ['web']], function () {
	Route::get('/', 'Web\Home@index');
	Route::get('/test', 'Test\Index@index');
});

