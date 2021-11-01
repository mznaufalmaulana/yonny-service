<?php

namespace App\Providers\Admin;

use App\Contracts\Admin\Master\ProductTypeInterface;
use App\Services\Admin\ProductTypeService;
use Illuminate\Support\ServiceProvider;

class MasterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductTypeInterface::class, ProductTypeService::class);
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
