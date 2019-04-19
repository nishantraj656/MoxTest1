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




Route::post('/article/e','ArticleController@updateV')->middleware('auth');
Route::post('/articles/s','ArticleController@stores')->middleware('auth');
Route::delete('/article/d/{id}','ArticleController@remove')->middleware('auth');
Route::get('/article/v','ArticleController@view')->middleware('auth');


Route::post('/categories/save','CategoryController@save')->middleware('auth');


Route::resource('/articles','ArticleController')->middleware('auth');
Route::resource('/categories','CategoryController')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();


