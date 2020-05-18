<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/feed', 'TwitterController');

Route::get( '/add' , 'TwitterUserController@addTwitterUserName')->name('addUser');
Route::get( '/remove' , 'TwitterUserController@removeTwitterUserName')->name('removeUser');
