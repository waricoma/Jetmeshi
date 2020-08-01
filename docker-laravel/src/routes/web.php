<?php

declare(strict_types=1);

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
  return view('top');
});

Auth::routes();

// resouce(query, controller) will declare index, create, store, show, edit, update, destory methodes to controller
// Route::resource('user', 'UserController', ['except' => ['create', 'store', 'destroy']]);

// User
Route::get('user/', 'User\IndexUserController')->name('user.index');
Route::get('user/{user}', 'User\ShowUserController')->name('user.show');
Route::get('user/{user}/edit', 'User\EditUserController')->name('user.edit');
Route::match(['put', 'patch'], 'user/{user}', 'User\UpdateUserController')->name('user.update');
Route::delete('user/{user}', 'User\DestroyUserController')->name('user.destroy');

// ChangePassword
Route::get('changepassword', 'ShowChangePasswordController')->name('changepassword.form');
Route::match(['put', 'patch'], 'changepassword/{user}', 'ChangePasswordController')->name('changepassword');

// Route::resource('post', 'PostController');
// Post
Route::get('post/', 'Post\IndexPostController@index')->name('post.index');
Route::get('post/create', 'Post\CreatePostController')->name('post.create');
Route::post('post/', 'Post\StorePostController')->name('post.store');
Route::get('post/{post}', 'Post\ShowPostController@show')->name('post.show');
Route::get('post/{post}/edit', 'Post\EditPostController')->name('post.edit');
Route::match(['put', 'patch'], 'post/{post}', 'Post\UpdatePostController')->name('post.update');
Route::delete('post/{post}', 'Post\DestroyPostController')->name('post.destroy');

Route::post('post/review/{post}', 'ReviewController@store')->name('review.store');
Route::get('search', 'SearchController@index')->name('search');

Route::post('like/{post}', 'LikeController@ajaxstore')->name('like');
Route::post('post/like/{post}', 'LikeController@ajaxstore')->name('like.post');
Route::post('user/like/{post}', 'LikeController@ajaxstore')->name('like.user');
