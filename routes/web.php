<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});



Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/make-post', 'PostController@index');
Route::post('/make-post', 'PostController@store');
Route::post('/make-comment/{commentable_data}', 'CommentController@store');

Route::get('/{id}', 'PostController@show');
