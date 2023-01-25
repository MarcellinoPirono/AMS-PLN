<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('Keuangan', function(User $user){
            return $user->role;

         });
        Gate::define('Staff', function(User $user){
            return $user->role;

         });
        Gate::define('Manager', function(User $user){
            return $user->role;

         });
        Gate::define('Admin', function(User $user){
            return $user->role;

         });
        Gate::define('Perencanaan', function(User $user){
            return $user->role;

         });



        //
    }
}
