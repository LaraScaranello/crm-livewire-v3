<?php

namespace App\Providers;

use App\Enum\Can;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        foreach (Can::cases() as $can) {
            Gate::define(
                $can->value,
                fn (User $user) => $user->hasPermissionTo($can)
            );
        }
    }
}
