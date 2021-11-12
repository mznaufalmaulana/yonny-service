<?php

namespace App\Providers\Admin;

use App\Contracts\Admin\Contact\ContactInterface;
use App\Services\Admin\ContactService;
use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(ContactInterface::class,ContactService::class);
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
