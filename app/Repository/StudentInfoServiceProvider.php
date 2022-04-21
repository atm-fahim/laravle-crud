<?php

namespace App\Repository;

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
            'App\Repository\StudentInfoInterface',
            'App\Repository\StudentInfoRepository'
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
