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

// Route::get('test','StandardPagesController@dashboard');

// Route::get('test','TestController@index');

Route::get('checking',function(){

	switch(Auth::user()->role_id){
		case '1':
			return redirect('main');
		break;
		default:
			return redirect('/');
		break;
	}

});

// Standard Routes
Route::group(['middleware'=>'web'],function(){
	Route::group(['middleware'=>'userMiddleware:1'],function(){
		Route::get('main','MainController@index');
	});
});

// API routes
Route::group(['middleware'=>'api','prefix'=>'api'],function(){
	Route::post('auth/login','ApiController@login');

	Route::group(['middleware'=>'jwt.auth'],function(){
		Route::post('user','ApiController@getAuthUser');
		Route::post('problem','ApiController@getProblem');
		Route::post('request','ApiController@request');
	});
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
