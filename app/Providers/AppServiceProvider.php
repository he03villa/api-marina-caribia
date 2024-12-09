<?php

namespace App\Providers;

use App\Dao\AgenciasDao;
use App\Dao\BoletaServicioDao;
use App\Dao\LanchasDao;
use App\Dao\MotoNavesDao;
use App\Dao\PilotosDao;
use App\Dao\PuertoOrDestinoDao;
use App\Dao\ServiciosDao;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(AgenciasDao::class);
        $this->app->singleton(LanchasDao::class);
        $this->app->singleton(MotoNavesDao::class);
        $this->app->singleton(PilotosDao::class);
        $this->app->singleton(ServiciosDao::class);
        $this->app->singleton(PuertoOrDestinoDao::class);
        $this->app->singleton(BoletaServicioDao::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
