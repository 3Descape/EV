<?php

namespace App\Providers;

use Carbon\Carbon;
use App\SiteCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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

        view()->share('site_categories', SiteCategory::all());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
