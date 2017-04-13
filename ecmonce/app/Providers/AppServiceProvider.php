<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Reposities\User\UserInterface;
use App\Reposities\User\UserRepository;
use App\Reposities\Product\ProductInterface;
use App\Reposities\Product\ProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserInterface::class, UserRepository::class);
        App::bind(ProductInterface::class, ProductRepository::class);
    }
}
