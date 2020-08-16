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

// 動画一覧画面を表示
Route::get('/', 'FmobjController@showList')->name('fmobjs');

// 動画詳細画面を表示
Route::get('/fmobj/{id}', 'FmobjController@showDetail')->name('show');
