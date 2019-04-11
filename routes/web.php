<?php
use Illuminate\Http\Request;
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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});
Auth::routes();


/*------------------------ Admin Route ---------------------------------------------------------*/
Route::get('/admin', 'AdminController@getIndex')
    ->middleware('is_admin')
    ->name('admin');

Route::get('/admin/user-manager','UserAdminController@manager')->middleware('is_admin');
Route::get('/admin/user-delete/{id}','UserAdminController@delete')->middleware('is_admin');
Route::get('/admin/user-update/{id}','UserAdminController@update')->middleware('is_admin');
Route::get('/admin/user-create','UserAdminController@create_success')->middleware('is_admin');
Route::post('/admin/user-update-success/{id}','UserAdminController@update_success')->middleware('is_admin');


Route::get('/admin/paypal-manager','PaypalAdminController@manager')->middleware('is_admin');
Route::get('/admin/history-manager','HistoryAdminController@manager')->middleware('is_admin');

Route::get('/admin/category-manager','CategoryAdminController@manager')->middleware('is_admin');
Route::get('/admin/category-delete/{id}','CategoryAdminController@delete')->middleware('is_admin');
Route::get('/admin/category-update/{id}','CategoryAdminController@update')->middleware('is_admin');
Route::get('/admin/category-create','CategoryAdminController@create_success')->middleware('is_admin');
Route::post('/admin/category-update-success/{id}','CategoryAdminController@update_success')->middleware('is_admin');

Route::get('/admin/product-manager','ProductAdminController@manager')->middleware('is_admin');
Route::get('/admin/product-delete/{id}','ProductAdminController@delete')->middleware('is_admin');
Route::get('/admin/product-update/{id}','ProductAdminController@update')->middleware('is_admin');
Route::get('/admin/product-create','ProductAdminController@create_success')->middleware('is_admin');
Route::post('/admin/product-create','ProductAdminController@create_success')->middleware('is_admin');
Route::post('/admin/product-update-success/{id}','ProductAdminController@update_success')->middleware('is_admin');

Route::get('/admin/background-manager','BackgrounAdminController@manager')->middleware('is_admin');
Route::get('/admin/background-delete/{id}','BackgrounAdminController@delete')->middleware('is_admin');
Route::get('/admin/background-update/{id}','BackgrounAdminController@update')->middleware('is_admin');
Route::get('/admin/background-create','BackgrounAdminController@create_success')->middleware('is_admin');
Route::post('/admin/background-create','BackgrounAdminController@create_success')->middleware('is_admin');
Route::post('/admin/background-update-success/{id}','BackgrounAdminController@update_success')->middleware('is_admin');
