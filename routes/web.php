<?php

use App\Site;
use App\Image;

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::post('/getAnalythics', 'DashboardController@getAnalythics');

    Route::get('/veranstaltung', 'EventController@events_future')->name('event_future_index');
    Route::get('/veranstaltung/archiv', 'EventController@events_archived')->name('event_archived_index');
    Route::post('/veranstaltung', 'EventController@store')->name('event_store');
    Route::get('/veranstaltung/{event}/edit', 'EventController@edit')->name('event_edit');
    Route::put('/veranstaltung/{event}', 'EventController@update')->name('event_update');
    Route::put('/veranstaltung/{event}/konflikt', 'EventController@resolve_conflict')->name('event_resolve_conflict');
    Route::delete('/veranstaltung/{event}', 'EventController@destroy')->name('event_destroy');

    Route::post('/veranstaltung/{event}/bild', 'EventImageController@store')->name('event_image_store');

    Route::get('/veranstaltung-kategorie', 'EventCategoryController@index')->name('event_category_index');
    Route::post('/veranstaltung-kategorie', 'EventCategoryController@store')->name('event_category_store');
    Route::get('/veranstaltung-kategorie/{event_category}/edit', 'EventCategoryController@edit')->name('event_category_edit');
    Route::put('/veranstaltung-kategorie/{event_category}', 'EventCategoryController@update')->name('event_category_update');
    Route::get('/veranstaltung-kategorie/{event_category}/konflikt', 'EventCategoryController@conflict')->name('event_category_conflict');
    Route::delete('/veranstaltung-kategorie/{event_category}', 'EventCategoryController@destroy')->name('event_category_destroy');

    Route::get('/person-kategorie', 'PersonCategoryController@index')->name('person_category_index');
    Route::post('/person-kategorie', 'PersonCategoryController@store')->name('person_category_store');
    Route::get('/person-kategorie/{person_category}/edit', 'PersonCategoryController@edit')->name('person_category_edit');
    Route::put('/person-kategorie/{person_category}', 'PersonCategoryController@update')->name('person_category_update');
    Route::delete('/person-kategorie/{person_category}', 'PersonCategoryController@destroy')->name('person_category_destroy');

    Route::get('/person/{category}', 'PersonController@index')->name('person_index');
    Route::get('/person/{category}/add', 'PersonController@create')->name('person_create');
    Route::post('/person/add', 'PersonController@store')->name('person_store');
    Route::get('/person/{person}/edit', 'PersonController@edit')->name('person_edit');
    Route::put('/person/{person}', 'PersonController@update')->name('person_update');
    Route::delete('/person/{person}/edit', 'PersonController@destroy')->name('person_destroy');

    Route::get('/nutzer', 'UserController@index')->name('user_index');
    Route::get('/nutzer/{user}/delete', 'UserController@user_delete')->name('user_delete');

    Route::get('/nutzer/{user}/edit', 'UserRoleController@edit')->name('user_role_edit');
    Route::put('/nutzer/{user}', 'UserRoleController@update')->name('user_role_update');
    Route::delete('/nutzer/{user}/rolle/{role}', 'UserRoleController@destroy')->name('user_role_destroy');

    Route::get('/rolle', 'RoleController@index')->name('role_index');
    Route::post('/rolle', 'RoleController@store')->name('role_store');
    Route::delete('/rolle/{role}', 'RoleController@destroy')->name('role_destroy');

    Route::post('/rolle/{role}/berechtigung/{permission}', 'PermissionRoleController@store')->name('permission_role_store');
    Route::delete('/rolle/{role}/berechtigung/{permission_id}', 'PermissionRoleController@destroy')->name('permission_role_destroy');

    Route::get('/seite/{site_category}', 'SiteController@edit')->name('site_edit');
    Route::delete('/seite/{site}', 'SiteController@destroy')->name('site_destroy');

    Route::post('/seite', 'SiteController@store')->name('site_store');
    Route::post('/seite/{site}/update', 'SiteController@update')->name('site_update');
    Route::post('/seite/update/reihenfolge', 'SiteController@update_order')->name('site_order_update');

    Route::get('/bild', 'ImageController@index')->name('image_index');
    Route::post('/bild', 'ImageController@store')->name('image_store');
    Route::delete('/bild/{image}', 'ImageController@destroy')->name('image_destroy');

    Route::get('/datei', 'FileController@index')->name('file_index');
    Route::get('/datei/edit/{file}', 'FileController@edit')->name('file_edit');
    Route::put('/datei/{file}', 'FileController@update')->name('file_update');
    Route::post('/datei', 'FileController@store')->name('file_store');
    Route::delete('/datei/{file}', 'FileController@delete')->name('file_destroy');

    Route::get('/thermin', 'FixtureController@index')->name('fixture_index');
    Route::post('/thermin', 'FixtureController@store')->name('fixture_store');
    Route::get('/thermin/{fixture}/edit', 'FixtureController@edit')->name('fixture_edit');
    Route::put('/thermin/{fixture}', 'FixtureController@update')->name('fixture_update');
    Route::delete('/thermin/{fixture}', 'FixtureController@destroy')->name('fixture_destroy');

    Route::get('/thermin-kategorie', 'FixtureCategoryController@index')->name('fixture_category_index');
    Route::post('/thermin-kategorie', 'FixtureCategoryController@store')->name('fixture_category_store');
    Route::get('/thermin-kategorie/{fixturecategory}/edit', 'FixtureCategoryController@edit')->name('fixture_category_edit');
    Route::put('/thermin-kategorie/{fixturecategory}', 'FixtureCategoryController@update')->name('fixture_category_update');
    Route::delete('/thermin-kategorie/{fixturecategory}', 'FixtureCategoryController@destroy')->name('fixture_category_destroy');
});

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/über_uns', 'FrontendController@about')->name('about');
Route::get('/veranstaltungen/archiv/{type?}', 'FrontendController@events_archived')->name('events_archive');
Route::get('/veranstaltungen/{type?}', 'FrontendController@events_future')->name('events');

Route::get('/sga', 'FrontendController@sga')->name('sga');
Route::get('/info', 'FrontendController@info')->name('info');
Route::get('/kontakt', 'FrontendController@contact')->name('contact');
Route::get('/impressum', 'FrontendController@imprint')->name('imprint');

Route::post('email/ev', 'MailController@send_ev')->name('mail_ev');
Route::post('email/obmann', 'MailController@send_obmann')->name('mail_obmann');

Route::get('/download', 'DownloadController@index')->name('downloads_view');
Route::get('/download/{file}', 'DownloadController@file_download')->name('file_download');

Route::post('/people/{category}', 'ApiController@getPeople');

Route::get('/test', function () {
    $images = Image::all();
    $site = Site::first();

    return view('admin.sites.test', [
        'images' => $images,
        'site' => $site
    ]);
});
// Route::get('/mail', function(){
//     $data = [
//         'name' => 'Jon Doe',
//         'text' => 'Ist ein langer Beispieltext der für die E-Mail geschrieben wurden. Ist ein langer Beispieltext der für die E-Mail geschrieben wurden.
//         Ist ein langer Beispieltext der für die E-Mail geschrieben wurden. Ist ein langer Beispieltext der für die E-Mail geschrieben wurden.'
//     ];
//     return new App\Mail\EvMail('test@test.com', $data);
// });
