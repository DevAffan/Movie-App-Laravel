<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'App\Http\Controllers\MoviesController@index')->name('movies.index');


Route::get('/movies', 'App\Http\Controllers\MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'App\Http\Controllers\MoviesController@show')->name('movies.show');

Route::get('/actors', 'App\Http\Controllers\ActorsController@index')->name('actors.index');
Route::get('/actors/{actor}', 'App\Http\Controllers\ActorsController@show')->name('actors.show');


Route::get('/actors/page/{page?}', 'App\Http\Controllers\ActorsController@index');
