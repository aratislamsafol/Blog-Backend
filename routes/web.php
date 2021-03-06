<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin' ,'middleware'=>['admin','auth'], 'namespace'=>'admin'],function(){
    Route::get('dashborad','AdminController@index')->name('admin.dashborad');
    Route::get('logout','AdminController@logout')->name('logout');
});

Route::group(['prefix'=>'user', 'Middleware'=>['user','auth'], 'namespace'=>'user'],function(){
    Route::get('dashboard','UserController@index')->name('user.dashborad');
    Route::get('logout','UserController@logout')->name('logout');
});

Route::resource('posts','Admin\PostController');
Route::get('post/index','Admin\PostController@index');
Route::get('post/all','Admin\PostController@getall')->name('getall.post');

// Comment
Route::post('comment/add/{id}','Admin\PostController@Comment')->name('add.comment');
Route::post('comment/update/{id}','Admin\PostController@CommentUpdate')->name('comment.update');
Route::get('comment/edit/{id}','Admin\PostController@CommentEdit')->name('comment.edit');
Route::get('comment/delete/{id}','Admin\PostController@deleteComment')->name('comment.del');




