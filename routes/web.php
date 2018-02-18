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
    return redirect('admin/login');
});

// Route::get('test','StandardPagesController@dashboard');

// Route::get('test','TestController@index');

Route::get('checking',function(){

	switch(Auth::user()->role_id){
		case '1':
			return redirect('admin/dashboard');
		break;
		default:
			return redirect('/');
		break;
	}

});

// Standard Routes
// Route::group(['middleware'=>'web'],function(){
// 	Route::group(['middleware'=>'userMiddleware:1'],function(){

// 		Route::get('main','MainController@index');

// 		Route::get('pelanggan','PelangganController@index');
// 		Route::group(['prefix'=>'pelanggan'],function(){

// 		});
// 		// end teknisi group
// 		Route::get('teknisi','TeknisiController@index');
// 		Route::group(['prefix'=>'teknisi'],function(){

// 		});
// 		// end teknisi group

// 		Route::get('setting','SettingController@index');
// 		Route::group(['prefix'=>'setting'],function(){

// 		});
// 		// end setting group

// 		Route::get('jasa','JasaController@index');
// 		Route::group(['prefix'=>'jasa'],function(){
// 			Route::get('create','JasaController@create');
// 			Route::post('store','JasaController@store');
// 			Route::post('edit','JasaController@edit');
// 			Route::post('update','JasaController@update');
// 		});
// 		// end jasa group

// 		Route::get('material','MaterialController@index');
// 		Route::group(['prefix'=>'material'],function(){
// 			Route::get('create','MaterialController@create');
// 			Route::post('store','MaterialController@store');
// 			Route::post('edit','MaterialController@edit');
// 			Route::post('update','MaterialController@update');
// 		});
// 		// end material group

// 	});
// });

// API routes
Route::group(['middleware'=>'api','prefix'=>'api'],function(){
	Route::post('auth/login','ApiController@login');

	Route::group(['middleware'=>'jwt.auth'],function(){
		Route::post('user','ApiController@getAuthUser');
		Route::post('getService','ApiController@getService');
		Route::post('request','ApiController@request');
	});
});

Auth::routes();

Route::get('/home', function(){
	return redirect('checking');
});

Route::group(['middleware'=>'userMiddleware:1'],function(){

	Route::group(['prefix' => 'admin',],function(){

		Route::get('dashboard', 'MainController@index');
		Route::get('order','OrderController@index');
		Route::group(['prefix'=>'order'],function(){
			Route::post('delete','OrderController@delete');
			Route::post('getTechnician','OrderController@getTechnician');
			Route::post('setTechnician','OrderController@setTechnician');
			Route::post('technicianDetail','OrderController@technicianDetail');
		});

		Route::group(['namespace' => 'Admin'], function(){

			CRUD::resource('service', 'ServiceCrudController');
			CRUD::resource('material' ,'MaterialCrudController');
			CRUD::resource('admin', 'AdminCrudController');
			// CRUD::resource('biodataAdmin','BiodataAdminCrudController');
			CRUD::resource('technician', 'TechnicianCrudController');
			CRUD::resource('client', 'ClientCrudController');
			CRUD::resource('biodata','BiodataCrudController');

		});
	});

});
