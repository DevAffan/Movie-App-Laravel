<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\MoviesController@index')->name('movies.index');


Route::get('/movies', 'App\Http\Controllers\MoviesController@index')->name('movies.index');
Route::get('/movies/{id}', 'App\Http\Controllers\MoviesController@show')->name('movies.show');

Route::get('/actors', 'App\Http\Controllers\ActorsController@index')->name('actors.index');
Route::get('/actors/{id}', 'App\Http\Controllers\ActorsController@show')->name('actors.show');


Route::get('/actors/page/{page?}', 'App\Http\Controllers\ActorsController@index');


Route::get('/tvshows', 'App\Http\Controllers\TvController@index')->name('tvshows.index');
Route::get('/tvshows/{id}', 'App\Http\Controllers\TvController@show')->name('tvshows.show');


Route::get('/tvshows/page/{page?}', 'App\Http\Controllers\TvController@index');
