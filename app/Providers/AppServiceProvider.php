<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            if (Session::has('locale')) {
                $locale = Session::get('locale');
            } else {
                $locale = 'en';
                Session::put('locale', $locale);
            }
            
            App::setLocale($locale);
            Session::put('dir', $locale === 'ar' ? 'rtl' : 'ltr');
            
            $view->with('currentLocale', $locale);
        });
    }
}
