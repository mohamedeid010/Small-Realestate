<?php

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

Route::get('/','RealestatesController@showall');
Route::get('/realestate/show/{id}','RealestatesController@show')->name('realestate.show');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin' ,'middleware'=>'auth'],function(){
  Route::get('/details','DetailsController@index')->name('details');
  Route::get('/details/create','DetailsController@create')->name('details.create');
  Route::post('/details/store','DetailsController@store')->name('details.store');
  Route::get('/detail/edit/{id}','DetailsController@edit')->name('detail.edit');
  Route::post('/detail/update/{id}','DetailsController@update')->name('details.update');
  Route::get('/detail/delete/{id}','DetailsController@destroy')->name('detail.delete');
  Route::get('/realestates','RealestatesController@index')->name('realestates');
  Route::get('/realestate/create','RealestatesController@create')->name('realestate.create');
  Route::post('/realestate/store','RealestatesController@store')->name('realestate.store');
  Route::get('/realestate/edit/{id}','RealestatesController@edit')->name('realestate.edit');
  Route::post('/realestate/update/{id}','RealestatesController@update')->name('realestate.update');
  Route::get('/realestate/delete/{id}','RealestatesController@destroy')->name('realestate.delete');
  Route::get('/removeseason', 'RealestatesController@removeseason')->name('removeseason');

});
