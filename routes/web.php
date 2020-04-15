<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'HomeController@filteredUsers')->name('filtered.users');

Route::prefix('friend_request')->group(function () {
    Route::post('send', 'FriendRequestController@send')->name('request.send');
    Route::post('accept', 'FriendRequestController@accept')->name('request.accept');
    Route::post('block', 'FriendRequestController@block')->name('request.block');
});

Route::get('/history', 'LogUserActionController@index')->name('history');