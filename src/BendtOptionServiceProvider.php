<?php
/*
 *
  ____                 _ _     _____           _                       _
 |  _ \               | | |   |_   _|         | |                     (_)
 | |_) | ___ _ __   __| | |_    | |  _ __   __| | ___  _ __   ___  ___ _  __ _
 |  _ < / _ \ '_ \ / _` | __|   | | | '_ \ / _` |/ _ \| '_ \ / _ \/ __| |/ _` |
 | |_) |  __/ | | | (_| | |_   _| |_| | | | (_| | (_) | | | |  __/\__ \ | (_| |
 |____/ \___|_| |_|\__,_|\__| |_____|_| |_|\__,_|\___/|_| |_|\___||___/_|\__,_|

 Last Update 24 Jul 2020
 */

namespace Bendt\Invoice;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Bendt\Option\Classes\OptionManager;
use Bendt\Option\Facades\Option as OptionFacades;

class BendtOptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Schema::defaultStringLength(191);

        $this->publishes([
            __DIR__.'/config/bendt-option.php' => config_path('bendt-option.php'),
        ], 'config');

        //Load Migrations
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        //Load routes
        require __DIR__ . '/helper.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $alias_loader = AliasLoader::getInstance();

        // Bind Invoice Class
        App::bind('optionManager', function()
        {
            return new OptionManager();
        });
        $alias_loader->alias('Option', OptionFacades::class);
    }
}
