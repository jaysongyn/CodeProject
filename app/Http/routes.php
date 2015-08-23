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
    return view('app');

});

Route::post('oauth/access_token', function(){
    return Response::json(\Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function(){

    Route::resource('client','ClientController',['except' => ['create','edit']]);

    Route::resource('project','ProjectController',['except' => ['create','edit']]);

    Route::resource('task','ProjectTaskController',['except' => ['create','edit']]);

    Route::resource('note','ProjectNoteController',['except' => ['create','edit']]);

    Route::post('member/project','ProjectController@addMember');
    Route::delete('member/{mid}/project/{id}','ProjectController@removeMember');

    Route::post('project/{id}/file','ProjectFileController@store');

    Route::delete('project/file/{id}','ProjectFileController@destroy');
});



