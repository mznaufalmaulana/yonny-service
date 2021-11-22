<?php

namespace App\Providers\Admin;

use App\Contracts\Admin\Master\ProductCategoryInterface;
use App\Contracts\Admin\Master\ProductTypeInterface;
use App\Contracts\Admin\Product\ProductInterface;
use App\Contracts\Admin\Master\RegionInterface;
use App\Services\Admin\ProductCategoryService;
use App\Services\Admin\ProductService;
use App\Services\Admin\ProductTypeService;
use App\Services\Admin\RegionService;
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
      $this->app->bind(ProductCategoryInterface::class, ProductCategoryService::class);
      $this->app->bind(RegionInterface::class, RegionService::class);
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
