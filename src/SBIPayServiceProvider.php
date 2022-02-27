<?php

namespace JagdishJP\SBIPay;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SBIPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->configureRoutes();

        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'SBIPay');

        $this->configurePublish();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'sbipay');

        $this->app->bind('sbi-pay', function(){
            return new SBIPay();
        });
    }

    public function configureRoutes()
    {
        Route::group([
            'middleware' => Config::get('sbipay.middleware'),
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    public function configurePublish()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('sbipay.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../stubs/Controller.php' => app_path('Http/Controllers/SBIPay/Controller.php'),
            ], 'sbi-pay-controller');

            $this->publishes([
                __DIR__ . '/../public/assets' => public_path('assets/SBIPay'),
            ], 'sbi-pay-assets');

            $this->publishes([
                __DIR__ . '/../resources/views/payment.blade.php' => resource_path('views/SBIPay/payment.blade.php'),
            ], 'sbi-pay-views');
        }
    }
}
