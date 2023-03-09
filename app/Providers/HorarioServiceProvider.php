<?php

namespace App\Providers;

use App\Interfaces\HorarioServiceInterface;
use App\Services\HorarioServices;
use Illuminate\Support\ServiceProvider;

class HorarioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(HorarioServiceInterface::class, HorarioServices::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
