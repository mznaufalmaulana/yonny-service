<?php

namespace App\Providers\Admin;

use App\Contracts\Admin\Project\ProjectInterface;
use App\Services\Admin\ProjectService;
use Illuminate\Support\ServiceProvider;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(ProjectInterface::class, ProjectService::class);
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
