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


Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index')->name('admin_index');
    Route::get('/about', 'AdminController@about')->name('admin_about');
    Route::get('/events', 'AdminController@events')->name('admin_events');
    Route::get('/sga', 'AdminController@sga')->name('admin_sga');
    Route::get('/info', 'AdminController@info')->name('admin_info');
});

Route::group(['prefix' => 'api'], function () {
    Route::resource('events', 'EventController');
    Route::get('people/{id}', 'FrontendController@get_people');
});

//Route::get('/{route}', 'FrontendController@dynamic');

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/über_uns', 'FrontendController@about')->name('about');
Route::get('/veranstaltungen', 'FrontendController@events')->name('events');
Route::get('/veranstaltungen/archiv', 'FrontendController@events_archive')->name('events_archive');
Route::get('/sga', 'FrontendController@sga')->name('sga');
Route::get('/info', 'FrontendController@info')->name('info');
Route::get('/kontakt', 'FrontendController@contact')->name('contact');
Route::get('/impressum', 'FrontendController@imprint')->name('imprint');
