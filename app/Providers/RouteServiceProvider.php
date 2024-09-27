<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * El espacio de nombres aplicable a los controladores de rutas.
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define las rutas para la aplicación.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Configure las rutas de la aplicación.
     */
    public function map(): void
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();
    }

    /**
     * Define las rutas "web" para la aplicación.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define las rutas "api" para la aplicación.
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
