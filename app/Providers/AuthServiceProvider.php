<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void {
        $this->registerPolicies();

        //agregamos el usuario Super Admin
        // Otorga implícitamente todos los permisos a la función "Superadministrador"
        Gate::before(function ($user, $ability) {
            return $user->email == 'desarrollo@admin.com' ?? null;
        });
	
	Gate::before(function ($user, $ability) {
            return $user->email == 'lrivero@inea.gob.ve' ?? null;
        });

        Gate::before(function ($user, $ability) {
            return $user->email == 'adiazm@inea.gob.ve' ?? null;
        });

        Gate::before(function ($user, $ability) {
            return $user->email == 'yacevedo@inea.gob.ve' ?? null;
        });

        Gate::before(function ($user, $ability) {
            return $user->email == 'jufernandez@inea.gob.ve' ?? null;
        });
    }
}
