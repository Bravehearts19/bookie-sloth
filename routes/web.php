<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

/* Route::get(
    return '/user/{id}/show';
    ) */

Route::namespace("User")
    ->prefix("user")
    ->name("user.")
    ->middleware("auth")
    ->group(function () {
        Route::get('/', 'UserController@show')->name('dashboard');

        Route::resource('apartment', 'Apartment\ApartmentController');

        Route::resource('/{apartment}/message', 'Apartment\MessageController');

        Route::get('/apartment/statistics', 'Apartment\ViewController@index');

        Route::get('/apartment/sponsor', 'Apartment\SponsorController@index');
    });

Route::get('{any?}', function () {
    return view('welcome');
})->where('any', '.*');
