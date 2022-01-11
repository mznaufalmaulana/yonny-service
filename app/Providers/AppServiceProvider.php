<?php

namespace App\Providers;


use App\Models\CategorytoProductModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductModel;
use App\Models\PromoModel;
use App\Observers\CategorytoProductObserver;
use App\Observers\ProductCategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\PromoObserver;
use Illuminate\Support\Facades\URL;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      if ($this->app->environment('production'))
      {
        URL::forceScheme('https');
      }

      PromoModel::observe(PromoObserver::class);
      ProductModel::observe(ProductObserver::class);
      CategorytoProductModel::observe(CategorytoProductObserver::class);
      ProductCategoryModel::observe(ProductCategoryObserver::class);
    }
}
