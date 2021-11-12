<?php

namespace App\Providers\Admin;

use App\Contracts\Admin\SocialMedia\SocialMediaInterface;
use App\Services\Admin\SocialMediaService;
use Illuminate\Support\ServiceProvider;

class SocialMediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SocialMediaInterface::class,SocialMediaService::class);
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
