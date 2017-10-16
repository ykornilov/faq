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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::post('questions.store', 'QuestionsController@store')->name('questions.store');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('users', 'UsersController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('questions', 'QuestionsController');
});

Route::get('/{id?}', 'PagesController@index')->name('home');
