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
    Route::resource('users', 'UsersController', [ 'except' => ['show']]);
    Route::resource('categories', 'CategoriesController', [ 'except' => ['index', 'show']]);
    Route::resource('authors', 'AuthorsController', [ 'only' => ['edit', 'update']]);
    Route::resource('questions', 'QuestionsController', [ 'except' => ['store']]);

    Route::put('questions.publish/{id}', 'QuestionsController@publish')->name('questions.publish');
    Route::put('questions.reply/{id}', 'QuestionsController@reply')->name('questions.reply');
    Route::put('questions.changeCategory/{id}', 'QuestionsController@changeCategory')->name('questions.changeCategory');
});

Route::get('/{id?}', 'PagesController@index')->name('home');
