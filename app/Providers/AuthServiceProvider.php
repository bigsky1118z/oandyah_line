<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

// use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
// use DragonCode\Contracts\Cashier\Http\Response;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define("is_admin", function($user){
            return $user->is_admin() ? Response::allow() : Response::denyAsNotFound();
        });

        Gate::define("isAdmin", function($user){
            return $user->roles()->whereRole('admin')->exists()
                ? Response::allow()
                : Response::denyAsNotFound();
        });

        Gate::define("isStaff", function($user){
            return $user->roles()->whereRole('staff')->exists()
                ? Response::allow()
                : Response::denyAsNotFound();
        });

        Gate::define("isClient", function($user){
            return $user->roles()->whereRole('client')->exists()
                ? Response::allow()
                : Response::denyAsNotFound();
        });
    }
}
