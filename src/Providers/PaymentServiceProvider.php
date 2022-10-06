<?php

namespace Sashagm\Payment\Providers;

use Illuminate\Support\ServiceProvider;
use Sashagm\Payment\Console\Commands\PaymentCommand;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__.'/../routes/payment.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'payment');

        $this->publishes([
            __DIR__.'/../config/payment.php' => config_path('payment.php'),
        ]);
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/payment'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                PaymentCommand::class,
            ]);
        }
    }
}
