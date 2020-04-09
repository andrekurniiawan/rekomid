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
})->name('welcome');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('post', 'PostController');
    Route::get('trash/post', 'PostController@trash')->name('post.trash');
    Route::post('trash/post/{post}/restore', 'PostController@restore')->name('post.restore');
    Route::delete('trash/post/{post}/kill', 'PostController@kill')->name('post.kill');
    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::resource('user', 'UserController');
});
