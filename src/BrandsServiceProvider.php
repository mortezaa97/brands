<?php

namespace Mortezaa97\Brands;

use Illuminate\Support\ServiceProvider;
use Mortezaa97\Brands\Models\Brand;
use Mortezaa97\Brands\Policies\BrandPolicy;

class BrandsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        Gate::policy(Brand::class, BrandPolicy::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('coupons.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'migrations');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'brands');

        // Register the main class to use with the facade
        $this->app->singleton('brands', function () {
            return new Brands;
        });
    }
}
