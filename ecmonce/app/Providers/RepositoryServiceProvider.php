<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\SuggestProduct\SuggestProductRepository;
use App\Repositories\SuggestProduct\SuggestProductInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserInterface::class, UserRepository::class);
        App::bind(ProductInterface::class, ProductRepository::class);
        App::bind(CategoryInterface::class, CategoryRepository::class);
        App::bind(SuggestProductInterface::class, SuggestProductRepository::class);
    }
}
