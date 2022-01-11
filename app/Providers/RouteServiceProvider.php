<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/home';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
        $this->mapStoreRoute();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes()
    {
      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/product_type.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/product_category.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/product.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/project.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/social_media.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/contact.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/region.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/email.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/promo.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/authentication.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/user.php'));

      Route::prefix('admin')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/admin/dashboard.php'));
    }

    public function mapStoreRoute()
    {
      Route::prefix('store')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/store/email_store.php'));

      Route::prefix('store')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/store/product_category.php'));

      Route::prefix('store')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/store/social_media.php'));

      Route::prefix('store')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/store/promo.php'));

      Route::prefix('store')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/store/contact.php'));

      Route::prefix('store')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/store/product_type.php'));

      Route::prefix('store')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/store/product.php'));

      Route::prefix('store')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/store/project.php'));

    }
}
