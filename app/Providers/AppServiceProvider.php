<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();

        $essay_type = ['Common App','Coalition App', 'UCAS', 'Personal Statement', 'Supplemental Essay', 'Digital Team Blog Post','Other'];
        View::share('essay_type', $essay_type);
    }
}
