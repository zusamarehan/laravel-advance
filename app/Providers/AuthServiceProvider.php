<?php

namespace App\Providers;

use App\Policies\ProductsPolicy;
use App\Products;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Products::class => ProductsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        Gate::define('create', 'App\Policies\ProductsPolicy@create');
        Gate::define('delete', 'App\Policies\ProductsPolicy@delete');
        Gate::define('update', 'App\Policies\ProductsPolicy@update');

    }
}
