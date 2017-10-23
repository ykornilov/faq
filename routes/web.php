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


Route::resource('questions', 'QuestionsController', [ 'only' => ['store']]);

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::resource('users', 'UsersController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('authors', 'AuthorsController');
    Route::resource('questions', 'QuestionsController', [ 'except' => ['store']]);
});

Route::get('/{id?}', 'PagesController@index')->name('home');
