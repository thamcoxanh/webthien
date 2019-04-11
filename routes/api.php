<?php
Use App\Article;
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

Route::get('articles', 'ArticleController@index');
Route::get('articles/{id}', 'ArticleController@show');
Route::post('articles', 'ArticleController@store');
Route::put('articles/{id}', 'ArticleController@update');
Route::delete('articles/{id}', 'ArticleController@delete');

Route::get('get-basic-music/{id}', 'CategorysController@show');
Route::get('get-advanced-music/{id}', 'CategorysController@index');

Route::get('get-background', 'BackgrounController@index');
Route::get('get-background/{id}', 'BackgrounController@show');

Route::post('users', 'JwtController@login');
Route::get('token', 'JwtController@checkToken');
Route::post('dang-ky', 'JwtController@register');
Route::post('forgot', 'JwtController@resetPassword');
Route::post('confirm-password', 'JwtController@confirmResetPassword');


Route::get('history-user', 'HistoryUserController@index');
Route::get('history-user/{id}', 'HistoryUserController@show');
Route::post('history-user', 'HistoryUserController@store');
Route::put('history-user/{id}', 'HistoryUserController@update');
Route::delete('history-user/{id}', 'HistoryUserController@delete');


Route::post('history-check', 'HistoryController@index');
Route::post('history-payment', 'HistoryController@update');
Route::post('history-insert', 'HistoryController@store');
Route::post('history-all', 'HistoryController@show');
Route::delete('history/{id}', 'HistoryController@delete');
