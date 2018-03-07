<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function(){

	Route::get('/news/published','NewsApiController@published');
	Route::get('/news/draft','NewsApiController@draft');
	Route::get('/news/deleted','NewsApiController@deleted');
	Route::get('/news/topic/{id}','TopicApiController@filter');
	Route::resource('/topics','TopicApiController',['except' => ['create']]);
	Route::resource('/news','NewsApiController');

});
