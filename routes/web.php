<?php

use Illuminate\Support\Facades\Route;

Route::post('/loans', 'LoanController@store');
Route::put('/loans/{id}', 'LoanController@update');
Route::get('/', 'LoanController@index');
Route::get('/loans/{id}', 'LoanController@show');
Route::delete('/loans/{id}', 'LoanController@destroy');
