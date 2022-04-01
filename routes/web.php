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

route::group(['middleware'=>['guest']],function (){

    Route::get('/', function()
    {
        return view('auth.login');
    });
});

Route::group(['middleware' => 'auth'], function () {


Route::get('/home', 'HomeController@index')->name('home');
route::group(['namespace' => 'Section'], function () {
    Route::resource('sections', 'SectionController');


});

route::group(['namespace' => 'Room'], function () {
    Route::resource('room', 'RoomController');
    Route::get('/edit_room/{id}','RoomController@edit');
    Route::get('Unreservedrooms', 'RoomController@Getrooms')->name('Unreservedrooms');
    Route::post('delete_all', 'RoomController@delete_all')->name('delete_all');
    Route::get('Unreservedrooms', 'RoomController@Getrooms')->name('Unreservedrooms');
    Route::get('reservedrooms', 'RoomController@Getroomsreseved')->name('reservedrooms');
});

route::group(['namespace' => 'Order'], function () {
    Route::resource('order', 'OrderController');
    Route::get('/getcity/{id}','OrderController@getcity');
    Route::get('/get_hospital/{id}','OrderController@get_hospital');
    
});
    



});
Route::get('/{page}', 'AdminController@index');
