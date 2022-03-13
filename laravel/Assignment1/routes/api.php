<?php

use App\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','AuthController@login');
//Route::middleware('auth:api')->prefix('student')->group(function () {
//    Route::get('index','API\ApiController@index');
//    Route::post('create','API\ApiController@create');
//    Route::get('details/{id}','API\ApiController@detail');
//    Route::get('delete/{id}','API\ApiController@delete');
//    Route::post('update','API\ApiController@update');
//});
Route::prefix('student')->group(function () {
    Route::get('index','API\StudentAPIController@index');
    Route::post('store','API\StudentAPIController@store');
    Route::get('show/{id}','API\StudentAPIController@show');
    Route::get('delete/{id}','API\StudentAPIController@delete');
    Route::post('update/{id}','API\StudentAPIController@update');
});


Route::prefix('ajax/students')->group(function () {
    Route::get('index','StudentAjaxController@index');
    Route::post('store','StudentAjaxController@store');
    Route::get('show/{id}','StudentAjaxController@show');
    Route::get('delete/{id}','StudentAjaxController@delete');
    Route::post('update','StudentAjaxController@update');
});