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
    // HomeController
    Route::get('home', 'HomeController@index')->name('home');

    // PostController
    Route::resource('post', 'PostController');
    Route::get('trash/post', 'PostController@trash')->name('post.trash');
    Route::post('trash/post/{post}/restore', 'PostController@restore')->name('post.restore');
    Route::delete('trash/post/{post}/kill', 'PostController@kill')->name('post.kill');

    // PageController
    Route::resource('page', 'PageController');
    Route::get('trash/page', 'PageController@trash')->name('page.trash');
    Route::post('trash/page/{page}/restore', 'PageController@restore')->name('page.restore');
    Route::delete('trash/page/{page}/kill', 'PageController@kill')->name('page.kill');

    // CategoryController
    Route::resource('category', 'CategoryController');
    Route::get('trash/category', 'CategoryController@trash')->name('category.trash');
    Route::post('trash/category/{category}/restore', 'CategoryController@restore')->name('category.restore');
    Route::delete('trash/category/{category}/kill', 'CategoryController@kill')->name('category.kill');

    // TagController
    Route::resource('tag', 'TagController');
    Route::get('trash/tag', 'TagController@trash')->name('tag.trash');
    Route::post('trash/tag/{tag}/restore', 'TagController@restore')->name('tag.restore');
    Route::delete('trash/tag/{tag}/kill', 'TagController@kill')->name('tag.kill');

    // ImageController
    Route::resource('image', 'ImageController');

    // UserController
    Route::resource('user', 'UserController');
});
