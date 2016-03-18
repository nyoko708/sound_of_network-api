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

Route::get('/', function () {
    return view('welcome');
});

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
});


/**
 * API Route
 */
Route::group(['prefix' => 'api'], function () {

  // ------------------ //
  // --- 認証系 API --- //
  // ------------------ //
  // 認証情報取得
  Route::get('/authenticate', 'AuthenticateController@get');

  // 認証処理
  Route::post('/authenticate', 'AuthenticateController@auth');

  // ---------------- //
  // --- me系 API --- //
  // ---------------- //
  Route::get('/me/profile', 'UserController@myProfile');
  Route::get('/me/projects', 'ProjectController@myProject');
  Route::get('/me/requests', 'RequestController@myRequests');


  // ---------------------- //
  // --- ユーザー系 API --- //
  // ---------------------- //
  Route::get('/user/{userId?}', 'UserController@get')->where('userId', '[0-9]');
  Route::get('/user/{userId}/cando', 'UserController@findCanDoOfUser')->where('userId', '[0-9]+');
  Route::post('/user', 'UserController@create');


  // -------------------------- //
  // --- プロジェクト系 API --- //
  // -------------------------- //
  Route::get('/project/{projectId?}', 'ProjectController@get')->where('projectId', '[0-9]+');
  Route::get('/project/{projectId}/members', 'ProjectController@members')->where('projectId', '[0-9]+');
  Route::get('/project/search', 'ProjectController@search');
  Route::post('/project/create', 'ProjectController@create');


  // ------------------------ //
  // --- リクエスト系 API --- //
  // ------------------------ //
  Route::get('/request/{requestId}', 'RequestController@get')->where('requestId', '[0-9]+');
  Route::post('/request/create', 'RequestController@create');
  Route::post('/request/read', 'RequestController@read');
  Route::post('/request/response', 'RequestController@response');

});
