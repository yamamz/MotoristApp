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
    Route::post('member/edit/{id}', 'member\MemberController@update');
    Route::get('member/all', 'member\MemberController@index');
    Route::get('member/all/tree', 'member\MemberController@getAllTree');
    Route::get('member/get/treeFlat/{id}', 'member\MemberController@getNodeToTreeFlat');
    Route::get('member/get/{id}','member\MemberController@getNodeToTree');
    Route::get('member/show/{id}','member\MemberController@show');
    Route::post('member/searchByName', 'member\MemberController@searchbyName');
    
    Route::post('motorrelease/create', 'member\MotorReleaseController@store');
    Route::post('motorrelease/update/{id}', 'member\MotorReleaseController@update');
    Route::get('motorrelease/all', 'member\MotorReleaseController@index');
    Route::post('motor/create', 'member\MotorController@store');
    Route::get('motor/all', 'member\MotorController@index');

    Route::post('memberloan/create', 'accounting\MemberLoanController@store');
    Route::post('memberloan/delete/{id}', 'accounting\MemberLoanController@destroy');
    Route::post('memberloan/update/{id}', 'accounting\MemberLoanController@update');
    Route::get('memberloan/all', 'accounting\MemberLoanController@index');
    Route::get('memberloan/show/{id}', 'accounting\MemberLoanController@show');

    Route::post('loanpayment/create', 'accounting\LoanPaymentController@store');
    Route::get('loanpayment/all', 'accounting\LoanPaymentController@index');
    Route::post('loanpayment/delete/{id}', 'accounting\LoanPaymentController@destroy');
    Route::post('branch/create', 'member\BranchController@store');
    Route::get('branch/all', 'member\BranchController@index');
});

Route::post('user/create', 'Auth\RegisterController@register');
Route::get('member/all/withtree', 'member\MemberController@allwithTree');









