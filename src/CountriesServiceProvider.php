<?php

namespace Apsonex\Countries;

use Illuminate\Support\Facades\Http;
use Apsonex\Countries\Commands\SeedCountriesCommand;
use Illuminate\Support\ServiceProvider;

class CountriesServiceProvider extends ServiceProvider
{

    const CONFIG_PATH = __DIR__ . '/../config/country.php';

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                self::CONFIG_PATH => config_path('country.php'),
            ], 'country');

            $this->loadMigrationsFrom(__DIR__ . '/../database/Migrations');

            $this->commands([
                SeedCountriesCommand::class,
            ]);
        }
    }


    public function register()
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'country');
    }

    protected function getPackageBaseDir(): string
    {
        $reflector = new \ReflectionClass(get_class($this));

        return dirname($reflector->getFileName());
    }
}