<?php

namespace App\Providers;

use Bezhanov\Faker\ProviderCollectionHelper;
use Faker\Generator as FakerGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->afterResolving(FakerGenerator::class, function (FakerGenerator $faker) {
            ProviderCollectionHelper::addAllProvidersTo($faker);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
    }
}
