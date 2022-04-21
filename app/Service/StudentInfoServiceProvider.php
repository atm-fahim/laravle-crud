<?php

namespace App\Service;

use Illuminate\Support\ServiceProvider;

class StudentInfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Service\StudentInfoService',
            'App\Service\StudentInfoServiceImplementation'
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
