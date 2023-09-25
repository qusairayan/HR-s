<?php

namespace App\Providers;

use App\Models\Year;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
        View::composer('layouts.app', function ($view) {
            $years=Year::get();
            $year = session('year'); // Replace with your session key
            $view->with('years', $years);
            $view->with('year', $year);
        });
    
    }
}
