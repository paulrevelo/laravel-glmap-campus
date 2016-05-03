<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	    //

	Route::get('/', [
		'uses' => 'BuildingController@index2', 
		'as' => 'home'
	]);

	Route::get('buildingdata', 'BuildingController@json');

	Route::get('buildingdata/{id}', 'BuildingController@jsonByID');

	Route::get('testmap', function(){
		return view('maptest');
	});

	Route::get('language/{lang}', 'HomeController@language')->where('lang', '[A-Za-z_-]+');

	Route::get('/index', 'BuildingController@polygon_index');

	Route::resource('events','EventController');

	Route::get('events/create','BuildingController@events_create_polygon');

	Route::resource('buildings','BuildingController');

// <<<<<<< HEAD
// 	Route::get('buildings?search={$search}', [
// 		'as'=>'search',
// 		'uses'=>'BuildingController@searchByString($search)'
// 	]);

// 	Route::resource('buildings/create','BuildingController@buildings_create_polygon');

// 	//Route::resource('buildings/edit','BuildingController@polygon{$id}');

// 	Route::resource('buildings/{$id}/edit', 'BuildingController@buildings_edit($id)');
// =======
	Route::get('buildings/create','BuildingController@buildings_create_polygon');

	Route::get('buildings/edit','BuildingController@buildings_edit_polygon');
//>>>>>>> 584881c48720511a0a9505bbbb693a1ddf27a065

	Route::resource('map-editor','BuildingController@index_map_editor');

	// Route::resource('user', 'UserController');

	

	//Route::resource('buildings/{{$building->id}}/edit','BuildingController@buildings_edit_polygon');

/*	
	// Admin
	Route::get('admin', [
		'uses' => 'AdminController@admin',
		'as' => 'admin',
		'middleware' => 'admin'
	]);

	Route::get('medias', [
		'uses' => 'AdminController@filemanager',
		'as' => 'medias',
		'middleware' => 'redac'
	]);


	Route::get('/index', function () {
	    return view('main.index');
	});




	*/
	
	/* 

	Route::get('user', UserController);
	//add user backend routes
	*/

/*
	Route::get('/about', function () {
	    return view('about');
	});*/

	//Route::get('/settings', function () {
	//    return view('settings');
	//});

	//Normal User  Routes
	/*
		Route::get('/', function () {
		    return view('welcome'); 
		});

		Route::get('map-editor', function () {
		    return view('layouts.back.map'); 
	});
	*/

	/* modified routes (RESTful API)
	Route::resource('/', DisplayController, [
		'only' => ['show'] //show metadata of buildings
	]});
	*/

	// User
	// Route::get('user/sort/{role}', 'UserController@indexSort');

	// Route::get('user/roles', 'UserController@getRoles');
	// Route::post('user/roles', 'UserController@postRoles');

	// Route::put('userseen/{user}', 'UserController@updateSeen');

	// Route::resource('user', 'UserController');


	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::get('auth/confirm/{token}', 'Auth\AuthController@getConfirm');

	// Resend routes...
	Route::get('auth/resend', 'Auth\AuthController@getResend');

	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');

	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
/*	
*/
});
