<?php

namespace App\Providers;

use App\Dao\AgenciasDao;
use App\Dao\BoletaServicioDao;
use App\Dao\CargoDao;
use App\Dao\ClienteDao;
use App\Dao\Concepto_serviciosDao;
use App\Dao\FacturacionDao;
use App\Dao\GeneralDao;
use App\Dao\LanchasDao;
use App\Dao\MotoNavesDao;
use App\Dao\PilotosDao;
use App\Dao\PuertosOrDestinoDao;
use App\Dao\ServiciosDao;
use App\Dao\TarifasConceptoDao;
use App\Dao\TrabajadoresDao;
use App\Dao\UserDao;
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
        $this->app->singleton(PuertosOrDestinoDao::class);
        $this->app->singleton(BoletaServicioDao::class);
        $this->app->singleton(UserDao::class);
        $this->app->singleton(TrabajadoresDao::class);
        $this->app->singleton(ClienteDao::class);
        $this->app->singleton(CargoDao::class);
        $this->app->singleton(TarifasConceptoDao::class);
        $this->app->singleton(GeneralDao::class);
        $this->app->singleton(FacturacionDao::class);
        $this->app->singleton(Concepto_serviciosDao::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
