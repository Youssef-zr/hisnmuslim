<?php

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

Route::get('/', "AppController@index");

Route::get('{any}', function () {
    if (request()->segments()[0] == 'dashboard') {

        return view('dashboard.index');

    } else {
        return view('website.index');
    }
})->where('any', '.*');