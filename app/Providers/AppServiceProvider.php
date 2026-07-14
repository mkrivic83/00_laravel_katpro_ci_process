<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
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
        if(app()->environment('dev') || app()->environment('test') || app()->environment('production')){
            URL::forceScheme('https');
        }
        Gate::define('admin-access',function ($user){
             return $user->isAdmin;
        });
    }
}
