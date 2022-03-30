<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\SiteCategory;
use App\Models\PersonCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        setlocale(LC_TIME, 'German');
        Carbon::setLocale('de');
        if (!app()->runningInConsole()) {
            View::share('site_categories', SiteCategory::all());
            View::composer(
                'admin.layouts.sitebar',
                function ($view) {
                    $view->with('person_categories', PersonCategory::orderBy('name')->get());
                }
            );
        }
    }
}
