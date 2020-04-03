<?php

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

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/{id}/send-request', 'FriendsController@sendRequestAction')->name('send_request');
Route::get('/user/{id}/block', 'FriendsController@blockUserAction')->name('block_user');
Route::get('/user/{id}/unblock', 'FriendsController@unblockUserAction')->name('unblock_user');
Route::get('/user/request/{id}/accept', 'FriendsController@acceptAction')->name('accept');
Route::get('/user/request/{id}/deny', 'FriendsController@denyAction')->name('deny');

Route::get('/user/pending-list', 'UserController@pendingUserAction')->name('pending_user');
Route::get('/user/blocked/list', 'UserController@blockedUserAction')->name('blocked_user');
Route::get('/user/friends/list', 'UserController@fiendsListAction')->name('friends');
Route::get('/user/request/list', 'UserController@requestListAction')->name('request_user');

Route::get('/user/history', function () {
     return view('user.history');
})->name('history');
