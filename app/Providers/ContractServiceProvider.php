<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /**
         * Bind repositories
         */

        /**
         * Bind services
         */
        $this->app->bind(
            \App\Contracts\Services\EasyBrokerServiceInterface::class,
            \App\Services\EasyBrokerService::class
        );
    }
}
