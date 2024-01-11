<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // define gate untuk user dengan role admin atau kasir
        Gate::define('admin', function ($user) {
            return $user->role == "admin";
        });
        // kasir
        Gate::define('kasir', function ($user) {
            return $user->role == "admin" || $user->role == "kasir";
        });
        // role "gate"
        Gate::define('gate', function ($user) {
            return $user->role == "admin" || $user->role == "gate";
        });
    }
}
