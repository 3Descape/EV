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

Route::group(['prefix' => 'ev'], function () {
  Auth::routes();

  Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index')->name('admin_index');
    Route::get('/about', 'AdminController@about')->name('admin_about');
    Route::get('/about/text_edit/{id}', 'AdminController@text_edit')->name('admin_text_edit');
    Route::get('/about/text_delete/{id}', 'AdminController@text_delete')->name('admin_text_delete');
    Route::post('/about/menu_cont_update/{id}', 'AdminController@menu_cont_update')->name('admin_menu_cont_update');

    Route::get('/events', 'AdminController@events')->name('admin_events');
    Route::get('/sga', 'AdminController@sga')->name('admin_sga');
    Route::get('/info', 'AdminController@info')->name('admin_info');
  });

  Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::resource('events', 'EventController');
  });




  //Route::get('/{route}', 'FrontendController@dynamic');

  Route::get('/', 'FrontendController@index')->name('home');
  Route::get('/über_uns', 'FrontendController@about')->name('about');
  Route::get('/veranstaltungen', 'FrontendController@events')->name('events');
  Route::get('/sga', 'FrontendController@sga')->name('sga');
  Route::get('/info', 'FrontendController@info')->name('info');
  Route::get('/kontakt', 'FrontendController@contact')->name('contact');
  Route::get('/impressum', 'FrontendController@imprint')->name('imprint');
});
