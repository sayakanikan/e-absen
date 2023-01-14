<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFour();

        Gate::define('superAdmin', function(User $superAdmin){
            return $superAdmin->role_id == 0;
        });

        Gate::define('admin', function(User $admin){
            return $admin->role_id == 0;
        });

        Gate::define('user', function(User $user){
            return $user->role_id == 0;
        });
    }
}
