<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('client', 'ClientController@index');
Route::post('client', 'ClientController@store');
Route::get('client/{id}', 'ClientController@show');
Route::delete('client/{id}/delete', 'ClientController@destroy');
Route::put('client/{id}/update',  'ClientController@update');


Route::get('project', 'ProjectController@index');
Route::post('project', 'ProjectController@store');
Route::get('project/{id}', 'ProjectController@show');
Route::delete('project/{id}/delete', 'ProjectController@destroy');
Route::put('project/{id}/update',  'ProjectController@update');

Route::get('note', 'ProjectNoteController@index');
Route::post('note', 'ProjectNoteController@store');
Route::get('note/{id}', 'ProjectNoteController@show');
Route::delete('note/{id}/delete', 'ProjectNoteController@destroy');
Route::put('note/{id}/update',  'ProjectNoteController@update');