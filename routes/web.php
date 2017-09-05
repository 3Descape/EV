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
    Route::get('/', 'DashboardController@index')->name('admin_dashboard');
    Route::post('/getAnalythics', 'DashboardController@getAnalythics');

    Route::get('/events', 'EventsController@events_future')->name('admin_events_future');
    Route::get('/events/archived', 'EventsController@events_archived')->name('admin_events_archived');
    Route::post('/events', 'EventsController@store')->name('admin_events_store');
    Route::put('/events/{id}', 'EventsController@update')->name('admin_events_update');
    Route::get('/events/{id}/edit', 'EventsController@edit')->name('admin_events_edit');
    Route::post('/events/{id}/image', 'ImagesController@store')->name('admin_events_store_image');
    Route::delete('/events/{event}/image/{image}', 'ImagesController@destroy')->name('admin_events_destroy_image');
    Route::delete('/events/{id}', 'EventsController@destroy')->name('admin_events_destroy');

    Route::get('/categories', 'CategoriesController@index')->name('admin_categories');
    Route::get('/categories/{id}/edit', 'CategoriesController@edit')->name('admin_categories_edit');
    Route::put('/categories/{id}', 'CategoriesController@update')->name('admin_categories_update');
    Route::post('/categories', 'CategoriesController@store')->name('admin_categories_store');
    Route::get('/categories/{id}/delte', 'CategoriesController@pre_delete')->name('adming_categories_pre_delete');
    Route::delete('/categories/{id}', 'CategoriesController@destroy')->name('admin_categories_destroy');

    Route::get('/people/frontend/sga', 'AdminController@personen_frontend_sga')->name('admin_people_frontend_sga');
    Route::get('/people/frontend/ev', 'AdminController@personen_frontend_ev')->name('admin_people_frontend_ev');
    Route::get('/people/backend', 'AdminController@personen_backend')->name('admin_people_backend');
    Route::get('/people/add/{type?}', 'PersonController@add')->name('person_add');
    Route::post('/people/add', 'PersonController@store')->name('api_person_store');
    Route::get('/people/{person}/edit', 'PersonController@edit')->name('api_person_edit');
    Route::put('/people/{person}', 'PersonController@update')->name('api_person_update');
    Route::get('/people/{person}/delete', 'PersonController@delete')->name('api_person_delete');

    Route::get('/users/{user}/edit', 'AdminController@user_role')->name('user_role');
    Route::put('/users/{user}', 'AdminController@user_role_update')->name('api_user_role_update');
    Route::get('/users/{user}/delete', 'AdminController@user_delete')->name('api_user_delete');
    Route::delete('/users/{user}/role/{role}', 'AdminController@detach_role')->name('api_user_role_detach');

    Route::get('/roles', 'RolesController@index')->name('roles_show');
    Route::post('/roles', 'RolesController@store')->name('api_role_add');
    Route::post('/roles/permission/add', 'RolesController@add_permission')->name('api_role_permission_add');
    Route::delete('/roles/{role}/permission/{permission}','RolesController@destroy_permission')->name('api_role_permission_destroy');
    Route::delete('/roles/{role}/delete', 'RolesController@destroy')->name('api_role_delete');

    Route::get('/sites/über_uns', 'SitesController@about')->name('admin_about');
    Route::get('/sites/sga', 'SitesController@sga')->name('admin_sga');
    Route::get('/sites/info', 'SitesController@info')->name('admin_info');
    Route::get('/sites/impress', 'SitesController@imprint')->name('admin_imprint');

    Route::get('/sites/{id}/edit', 'SitesController@edit')->name('admin_sites_edit');
    Route::put('/sites/{id}', 'SitesController@update')->name('admin_sites_update');

    Route::get('/ferien', 'HolidayController@index')->name('holiday_index');
    Route::post('/ferien', 'HolidayController@store')->name('holiday_store');
    Route::get('/ferien/{holiday}/edit', 'HolidayController@edit')->name('holiday_edit');
    Route::put('/ferien/{holiday}', 'HolidayController@update')->name('holiday_update');
    Route::delete('/ferien/{holiday}', 'HolidayController@destroy')->name('holiday_destroy');
});


Route::get('/', 'FrontendController@index')->name('home');
Route::get('/förderansuchen', 'FrontendController@download_pdf')->name('pdf_start_download');

Route::get('/über_uns', 'FrontendController@about')->name('about');
Route::get('/veranstaltungen/archiv/{type?}', 'FrontendController@events_archived')->name('events_archive');
Route::get('/veranstaltungen/{type?}', 'FrontendController@events_future')->name('events');

Route::get('/sga', 'FrontendController@sga')->name('sga');
Route::get('/info', 'FrontendController@info')->name('info');
Route::get('/kontakt', 'FrontendController@contact')->name('contact');
Route::get('/impressum', 'FrontendController@imprint')->name('imprint');

Route::post('email/ev', 'MailController@send_ev')->name('mail_ev');
Route::post('email/obmann', 'MailController@send_obmann')->name('mail_obmann');

Route::get('/mail', function(){
    $data = ['name' => 'Franz Rüdiger', 'text' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."];
    return view('emails.contact', [
        'data' => $data
    ]);
});
