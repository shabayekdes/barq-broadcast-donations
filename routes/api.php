<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('donate', 'Api\DonationController@index');
Route::get('unread-donate', 'Api\DonationController@unread');
Route::post('donate', 'Api\DonationController@store');
Route::put('donate/{donate}', 'Api\DonationController@update');
Route::delete('donate/{donate}', 'Api\DonationController@destroy');

