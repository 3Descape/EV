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
    Route::get('/', 'AdminController@index')->name('admin_dashboard');
    Route::get('/about', 'AdminController@about')->name('admin_about');
    Route::get('/events', 'AdminController@events')->name('admin_events');
    Route::get('/sga', 'AdminController@sga')->name('admin_sga');
    Route::get('/info', 'AdminController@info')->name('admin_info');


    Route::group(['prefix' => 'personen'], function(){
        Route::get('/frontend', 'AdminController@personen_frontend')->name('admin_people_frontend');
        Route::get('/backend', 'AdminController@personen_backend')->name('admin_people_backend');
    });

    Route::get('/person/add/{type?}', 'PersonController@add')->name('person_add');
    Route::post('/person/add', 'PersonController@store')->name('api_person_store');
    Route::get('/person/{person}/edit', 'PersonController@edit')->name('api_person_edit');
    Route::put('/person/{person}', 'PersonController@update')->name('api_person_update');
    Route::get('/person/{person}/delete', 'PersonController@delete')->name('api_person_delete');

    Route::get('/user/{user}/edit', 'AdminController@user_role')->name('user_role');
    Route::put('/user/{user}', 'AdminController@user_role_update')->name('api_user_role_update');
    Route::get('/user/{user}/delete', 'AdminController@user_delete')->name('api_user_delete');
});

//Route::get('/{route}', 'FrontendController@dynamic');

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/förderansuchen', 'FrontendController@download_pdf')->name('pdf_start_download');

Route::get('/über_uns', 'FrontendController@about')->name('about');
Route::get('/veranstaltungen', 'FrontendController@events_future')->name('events');
Route::get('/veranstaltungen/archiv', 'FrontendController@events_archived')->name('events_archive');
Route::get('/sga', 'FrontendController@sga')->name('sga');
Route::get('/info', 'FrontendController@info')->name('info');
Route::get('/kontakt', 'FrontendController@contact')->name('contact');
Route::get('/impressum', 'FrontendController@imprint')->name('imprint');
