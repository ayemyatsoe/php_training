<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\API\APIController;
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
//Route::get('student', 'StudentsController@index')->name('student.index');
//Route::post('student', 'StudentsController@store')->name('student.store');
//Route::get('student/create', 'StudentsController@create')->name('student.create');
//Route::get('student/{student}', 'StudentsController@show')->name('student.show');
//Route::put('student/{student}', 'StudentsController@update')->name('student.update');
//Route::delete('student/{student}', 'StudentsController@destroy')->name('student.destroy');
//Route::get('student/{student}/edit', 'StudentsController@edit')->name('student.edit');


Route::resource('student', 'StudentsController');
Route::get('importExportView', 'StudentsController@importExportView')->name('importExportView');
Route::get('export', 'StudentsController@export')->name('export');
Route::post('import', 'StudentsController@import')->name('import');
Route::get('search', 'StudentsController@search')->name('search');
Route::get('date', 'StudentsController@date')->name('date');
Route::get('dateView', 'StudentsController@dateView');

//Route::apiResource('api/studentAPI', 'API\StudentAPIController');
//Route::prefix('student')->group(function () {
//    Route::get('index','API\StudentController@index');
//    Route::post('store','API\StudentController@store');
//    Route::get('show/{id}','API\StudentController@show');
//    Route::get('delete/{id}','API\StudentController@delete');
//    Route::post('update','API\StudentController@update');
//});
//Route::prefix('ajax/students')->group(function () {
//    Route::get('index','StudentAjaxController@index');
//    Route::post('store','StudentAjaxController@store');
//    Route::get('show/{id}','StudentAjaxController@show');
//    Route::get('delete/{id}','StudentAjaxController@delete');
//    Route::post('update','StudentAjaxController@update');
//});
Route::resource('ajax/majors', 'MajorsController');
Route::resource('ajax/students', 'StudentAjaxController');

Route::get("ajax/studentsData", function(){
    return view("ajax.students");
});