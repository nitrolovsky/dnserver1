<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('/post');
});

Route::get('user/login', 'UserController@viewLogin');
Route::post('user/login', 'UserController@login');
Route::get('user/logout', 'UserController@logout');
Route::get('user/birthdays', 'UserController@birthdays');
Route::get('user/proposals', 'UserController@proposals');
Route::resource('user', 'UserController');

Route::get('eis', function() {
    return view('eis');
});

Route::get('medical', function() {
    return view('medical');
});

Route::get('help', function() {
    return view('help');
});

Route::resource('post', 'PostController');
Route::resource('proposal', 'ProposalController');
Route::resource('comment', 'CommentController');
Route::resource('computer-equipment', 'ComputerEquipmentController');
