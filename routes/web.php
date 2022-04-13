<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FixtureCategoryController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PermissionRoleController;
use App\Http\Controllers\PersonCategoryController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Auth::routes(['reset' => false]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/getAnalytics', [DashboardController::class, 'getAnalytics']);

    Route::get('/veranstaltung', [EventController::class, 'events_future'])->name('event_future_index');
    Route::get('/veranstaltung/archiv', [EventController::class, 'events_archived'])->name('event_archived_index');
    Route::post('/veranstaltung', [EventController::class, 'store'])->name('event_store');
    Route::get('/veranstaltung/{event}/edit', [EventController::class, 'edit'])->name('event_edit');
    Route::put('/veranstaltung/{event}', [EventController::class, 'update'])->name('event_update');
    Route::put('/veranstaltung/{event}/konflikt', [EventController::class, 'resolve_conflict'])->name('event_resolve_conflict');
    Route::delete('/veranstaltung/{event}', [EventController::class, 'destroy'])->name('event_destroy');

    Route::post('/veranstaltung/{event}/bild', [EventImageController::class, 'store'])->name('event_image_store');

    Route::get('/veranstaltung-kategorie', [EventCategoryController::class, 'index'])->name('event_category_index');
    Route::post('/veranstaltung-kategorie', [EventCategoryController::class, 'store'])->name('event_category_store');
    Route::get('/veranstaltung-kategorie/{event_category}/edit', [EventCategoryController::class, 'edit'])->name('event_category_edit');
    Route::put('/veranstaltung-kategorie/{event_category}', [EventCategoryController::class, 'update'])->name('event_category_update');
    Route::get('/veranstaltung-kategorie/{event_category}/konflikt', [EventCategoryController::class, 'conflict'])->name('event_category_conflict');
    Route::delete('/veranstaltung-kategorie/{event_category}', [EventCategoryController::class, 'destroy'])->name('event_category_destroy');

    Route::get('/person-kategorie', [PersonCategoryController::class, 'index'])->name('person_category_index');
    Route::post('/person-kategorie', [PersonCategoryController::class, 'store'])->name('person_category_store');
    Route::get('/person-kategorie/{person_category}/edit', [PersonCategoryController::class, 'edit'])->name('person_category_edit');
    Route::put('/person-kategorie/{person_category}', [PersonCategoryController::class, 'update'])->name('person_category_update');
    Route::delete('/person-kategorie/{person_category}', [PersonCategoryController::class, 'destroy'])->name('person_category_destroy');

    Route::get('/person/{category}', [PersonController::class, 'index'])->name('person_index');
    Route::get('/person/{category}/create', [PersonController::class, 'create'])->name('person_create');
    Route::post('/person/add', [PersonController::class, 'store'])->name('person_store');
    Route::get('/person/{person}/edit', [PersonController::class, 'edit'])->name('person_edit');
    Route::put('/person/{person}', [PersonController::class, 'update'])->name('person_update');
    Route::delete('/person/{person}/edit', [PersonController::class, 'destroy'])->name('person_destroy');

    Route::get('/nutzer', [UserController::class, 'index'])->name('user_index');
    Route::get('/nutzer/{user}/delete', [UserController::class, 'user_delete'])->name('user_delete');

    Route::get('/nutzer/{user}/edit', [UserRoleController::class, 'edit'])->name('user_role_edit');
    Route::put('/nutzer/{user}', [UserRoleController::class, 'update'])->name('user_role_update');
    Route::delete('/nutzer/{user}/rolle/{role}', [UserRoleController::class, 'destroy'])->name('user_role_destroy');

    Route::get('/rolle', [RoleController::class, 'index'])->name('role_index');
    Route::post('/rolle', [RoleController::class, 'store'])->name('role_store');
    Route::delete('/rolle/{role}', [RoleController::class, 'destroy'])->name('role_destroy');

    Route::post('/rolle/{role}/berechtigung/{permission}', [PermissionRoleController::class, 'store'])->name('permission_role_store');
    Route::delete('/rolle/{role}/berechtigung/{permission_id}', [PermissionRoleController::class, 'destroy'])->name('permission_role_destroy');

    Route::get('/seite/{site_category}', [SiteController::class, 'edit'])->name('site_edit');
    Route::delete('/seite/{site}', [SiteController::class, 'destroy'])->name('site_destroy');
    Route::post('/seite', [SiteController::class, 'store'])->name('site_store');
    Route::post('/seite/{site}/update', [SiteController::class, 'update'])->name('site_update');
    Route::post('/seite/update/reihenfolge', [SiteController::class, 'update_order'])->name('site_order_update');

    Route::get('/bild', [ImageController::class, 'index'])->name('image_index');
    Route::post('/bild', [ImageController::class, 'store'])->name('image_store');
    Route::delete('/bild/{image}', [ImageController::class, 'destroy'])->name('image_destroy');

    Route::get('/datei', [FileController::class, 'index'])->name('file_index');
    Route::get('/datei/edit/{file}', [FileController::class, 'edit'])->name('file_edit');
    Route::put('/datei/{file}', [FileController::class, 'update'])->name('file_update');
    Route::post('/datei', [FileController::class, 'store'])->name('file_store');
    Route::delete('/datei/{file}', [FileController::class, 'delete'])->name('file_destroy');

    Route::get('/termin', [FixtureController::class, 'index'])->name('fixture_index');
    Route::post('/termin', [FixtureController::class, 'store'])->name('fixture_store');
    Route::get('/termin/{fixture}/edit', [FixtureController::class, 'edit'])->name('fixture_edit');
    Route::put('/termin/{fixture}', [FixtureController::class, 'update'])->name('fixture_update');
    Route::delete('/termin/{fixture}', [FixtureController::class, 'destroy'])->name('fixture_destroy');

    Route::get('/termin-kategorie', [FixtureCategoryController::class, 'index'])->name('fixture_category_index');
    Route::post('/termin-kategorie', [FixtureCategoryController::class, 'store'])->name('fixture_category_store');
    Route::get('/termin-kategorie/{fixturecategory}/edit', [FixtureCategoryController::class, 'edit'])->name('fixture_category_edit');
    Route::put('/termin-kategorie/{fixturecategory}', [FixtureCategoryController::class, 'update'])->name('fixture_category_update');
    Route::delete('/termin-kategorie/{fixturecategory}', [FixtureCategoryController::class, 'destroy'])->name('fixture_category_destroy');

    // Route::get('/email-bild', [EmailImageController::class, 'index'])->name('email_image_index');
    // Route::post('/email-bild/store', [EmailImageController::class, 'store'])->name('email_image_store');
});

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/über_uns', [FrontendController::class, 'about'])->name('about');
Route::get('/veranstaltungen/archiv/{type?}', [FrontendController::class, 'events_archived'])->name('events_archive');
Route::get('/veranstaltungen/{type?}', [FrontendController::class, 'events_future'])->name('events');

Route::get('/sga', [FrontendController::class, 'sga'])->name('sga');
Route::get('/info', [FrontendController::class, 'info'])->name('info');
Route::get('/kontakt', [FrontendController::class, 'contact'])->name('contact');
Route::get('/impressum', [FrontendController::class, 'imprint'])->name('imprint');

Route::post('email/ev', [MailController::class, 'send_ev'])->name('mail_ev');
Route::post('email/obmann', [MailController::class, 'send_obmann'])->name('mail_obmann');

Route::get('/download', [DownloadController::class, 'index'])->name('downloads_view');
Route::get('/download/{file}', [DownloadController::class, 'file_download'])->name('file_download');

Route::post('/people/{category}', [ApiController::class, 'getPeople']);

// Route::get('/mail', function () {
//     $data = [
//         'name' => 'Jon Doe',
//         'text' => 'Sehr geehrter Herr
//         Ist ein langer Beispieltext der für die E-Mail geschrieben wurden. Ist ein langer Beispieltext der für die E-Mail geschrieben wurden.
//         Ist ein langer Beispieltext der für die E-Mail geschrieben wurden. Ist ein langer Beispieltext der für die E-Mail geschrieben
//         wurden.
//         LG Test'
//     ];

//     return new App\Mail\EvMail('test@test.com', $data);
// });
