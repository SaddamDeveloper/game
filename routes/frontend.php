<?php

use Illuminate\Support\Facades\Route;

Route::any('{slug}', 'HomeController@index');
Route::get('/', 'HomeController@show');