<?php

namespace App\Providers\Admin;

use App\Contracts\Admin\Authentication\authenticationInterface;
use App\Services\Admin\AuthenticationService;
use Illuminate\Support\ServiceProvider;

class AuthenticationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(AuthenticationInterface::class, AuthenticationService::class);
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
