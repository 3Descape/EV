<?php

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::post('/getAnalythics', 'DashboardController@getAnalythics');

    Route::get('/veranstaltungen', 'EventController@events_future')->name('event_future_index');
    Route::get('/veranstaltungen/archiv', 'EventController@events_archived')->name('event_archived_index');
    Route::post('/veranstaltungen', 'EventController@store')->name('event_store');
    Route::get('/veranstaltungen/{event}/edit', 'EventController@edit')->name('event_edit');
    Route::put('/veranstaltungen/{event}', 'EventController@update')->name('event_update');
    Route::delete('/veranstaltungen/{event}', 'EventController@destroy')->name('event_destroy');

    Route::post('/veranstaltungen/{event}/bild', 'EventImageController@store')->name('event_image_store');

    Route::get('/veranstaltung-kategorien', 'EventCategoryController@index')->name('event_category_index');
    Route::post('/veranstaltung-kategorien', 'EventCategoryController@store')->name('event_category_store');
    Route::get('/veranstaltung-kategorien/{event_category}/add', 'EventCategoryController@edit')->name('event_category_edit');
    Route::put('/veranstaltung-kategorien/{event_category}', 'EventCategoryController@update')->name('event_category_update');
    Route::get('/veranstaltung-kategorien/{event_category}/konflikt', 'EventCategoryController@conflict')->name('event_category_conflict');
    Route::delete('/veranstaltung-kategorien/{event_category}', 'EventCategoryController@destroy')->name('event_category_destroy');

    Route::get('/person/frontend/{category}', 'PersonController@index')->name('person_frontend_index');
    Route::get('/person/{category}/add', 'PersonController@create')->name('person_create');
    Route::post('/person/add', 'PersonController@store')->name('person_store');
    Route::get('/person/{person}/edit', 'PersonController@edit')->name('person_edit');
    Route::put('/person/{person}', 'PersonController@update')->name('person_update');
    Route::delete('/person/{person}/edit', 'PersonController@destroy')->name('person_destroy');

    Route::get('/nutzer/{user}/edit', 'UserRoleController@edit')->name('user_role_edit');
    Route::put('/nutzer/{user}', 'UserRoleController@update')->name('user_role_update');
    Route::delete('/nutzer/{user}/rolle/{role}', 'UserRoleController@destroy')->name('user_role_destroy');

    Route::get('/nutzer', 'UserController@index')->name('user_index');
    Route::get('/nutzer/{user}/delete', 'UserController@user_delete')->name('user_delete');

    Route::get('/rolle', 'RoleController@index')->name('role_index');
    Route::post('/rolle', 'RoleController@store')->name('role_store');
    Route::delete('/rolle/{role}', 'RoleController@destroy')->name('role_destroy');

    Route::post('/rolle/{role}/berechtigung/{permission}', 'PermissionRoleController@store')->name('permission_role_store');
    Route::delete('/rolle/{role}/berechtigung/{permission_id}', 'PermissionRoleController@destroy')->name('permission_role_destroy');

    Route::get('/seite/über_uns', 'SiteController@about')->name('about_edit');
    Route::get('/seite/sga', 'SiteController@sga')->name('sga_edit');
    Route::get('/seite/info', 'SiteController@info')->name('info_edit');
    Route::get('/seite/impress', 'SiteController@imprint')->name('imprint_edit');

    Route::post('/seite/update/{site}/text', 'SiteController@update_body')->name('site_body_update');
    Route::post('/seite/update/{site}/titel', 'SiteController@update_title')->name('site_title_update');

    Route::post('/seite/über_uns/hochladen', 'ImagesController@uploud_group_image')->name('group_image_store');
    Route::delete('seite/über_uns', 'ImagesController@remove_group_image')->name('group_image_destroy');

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

Route::get('/downloads', 'DownloadController@index')->name('downloads_view');
Route::get('/download/{file}', 'DownloadController@file_download')->name('file_download');

Route::post('/bild/{image}', 'ImagesController@getImage');
