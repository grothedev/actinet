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

/*Route::get('/', function () {
    return view('home');
});*/



Auth::routes();

Route::get('register/verify/{confirmationCode}', 
	['as' => 'confirmation_path', 
	'uses' => 'RegisterController@confirm']
);

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@index');
Route::get('/make-post', 'PostController@index');
Route::post('/make-post', 'PostController@store');
Route::post('/make-comment/{commentable_data}', 'CommentController@store');
Route::get('/vote', 'PostController@vote');
Route::get('/feedback', 'FeedbackController@index');
Route::post('/feedback', 'FeedbackController@create');
Route::get('/u/edit', function(){
	return view('auth.user_edit');
});
Route::post('/u/edit', 'Auth\UserEditController@edit');
Route::get('/u/{id}', function($id){
	$user = App\User::findOrFail($id);
	return view('user', compact('user'));
});



Route::get('/{id}', 'PostController@show');

