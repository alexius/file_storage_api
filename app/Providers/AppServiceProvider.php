<?php

namespace App\Providers;

use App\Contracts\FileManagerFactoryContract;
use App\Factories\FileManagerFactory;
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
        /*$this->app->singleton(FileManagerFactoryContract::class, function() {
            return new FileManagerFactory();
        });*/

        $this->app->bind(FileManagerFactoryContract::class, FileManagerFactory::class);
    }
}
