<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
        $this->mapStoreRoute();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
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
