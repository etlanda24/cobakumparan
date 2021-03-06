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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/topics', function(){
	return view('topics.index');
});
Route::resource('topics','TopicController',['except' => ['create']]);
Route::resource('news','NewsController');
// Route::get('news/show/{id}','NewsController@show');
