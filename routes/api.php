<?php

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

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('signin', 'AuthenticationController@signin')->name('auth.signin');
    Route::post('signout', 'AuthenticationController@signout')->name('auth.signout');
});

Route::group(['middleware' => 'auth:users'], function () {
	Route::apiResource('issue', 'IssueController');
	Route::apiResource('module', 'ModuleController');
	Route::apiResource('project', 'ProjectController');
	Route::apiResource('version', 'VersionController');

	Route::apiResource('database', 'DatabaseController');
	Route::apiResource('table', 'TableController');
	Route::apiResource('field', 'FieldController');

	Route::apiResource('interface', 'InterfacesController');
	Route::apiResource('request', 'RequestController');
	Route::apiResource('response', 'ResponseController');
	Route::apiResource('argument', 'ArgumentController');
	Route::apiResource('header', 'HeaderController');
	Route::apiResource('scheme', 'SchemeController');
	Route::apiResource('group', 'GroupController');

	Route::apiResource('user', 'UserController');

	Route::apiResource('repository', 'RepositoryController');
	Route::apiResource('preferences', 'PreferencesController');
	Route::get('system/menu', 'MenuController@index');
});

/**
 * 用户个人中心
 */
Route::group(['middleware' => 'auth:users', 'prefix' => 'account', 'namespace' => 'Account'], function () {
	Route::get('/', 'ProfileController@index');
	Route::post('avatar', 'ProfileController@avatar');
	Route::post('password', 'ProfileController@password');
});
