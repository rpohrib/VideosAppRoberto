<?php

namespace App\Providers;

use App\Helpers\UserHelpers;
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
        // Definir les portes d'accés
        UserHelpers::define_gates();

        // Registrar les polítiques d'autorització
        Gate::policy(User::class, UserPolicy::class);
    }
}
