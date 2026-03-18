<?php

namespace App\Providers;

use App\Models\Player;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        $this->registerPolicies();

        Gate::define("check-players", function (User $user, Player $player): bool {
            return $user->id === $player->user_id || $user->name === 'admin';
        });
        Gate::define("view-players", function (User $user): bool {
            return true; // Любой авторизованный может видеть список
        });

    }
}
