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



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

 

});
Route::group([
    'middleware' => 'jwt.auth',
], function ($router) {
    Route::post('member/create', 'member\MemberController@store');
    Route::get('member/all', 'member\MemberController@index');
    Route::get('member/all/tree', 'member\MemberController@getAllTree');
    Route::get('member/get/{id}','member\MemberController@getNodeToTree');
});




