<?php

namespace App\Providers\Admin;

use App\Contracts\Admin\Promo\PromoInterface;
use App\Services\Admin\PromoService;
use Illuminate\Support\ServiceProvider;

class PromoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PromoInterface::class, PromoService::class);
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
