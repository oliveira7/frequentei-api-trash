<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Requests\BaseRequests\FormRequestServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(FormRequestServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
