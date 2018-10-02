<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AppServiceProvider extends ServiceProvider
{



    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {


//        \View::share('product', \App\Product::where('id',  request()->id)->firstOrFail());


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


    }
}
