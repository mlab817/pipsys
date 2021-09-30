<?php

namespace App\Providers;

use App\Http\ViewComposers\ProjectComposer;
use App\Http\ViewComposers\SidebarComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('projects.create', ProjectComposer::class);
        view()->composer('projects.edit', ProjectComposer::class);
        view()->composer('partials.sidebar', SidebarComposer::class);
    }
}
