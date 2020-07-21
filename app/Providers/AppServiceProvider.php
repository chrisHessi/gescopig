<?php

namespace App\Providers;

use App\Models\Ingoing;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('APP_ENV') === 'production'){
            URL::forceScheme('https');
        }

        if(request()->server("SCRIPT_NAME") !== 'artisan') {
            view ()->share ('absences_notif', Ingoing::where('ingoing_type', 'App\Models\Contrat')->get());
            view()->share('enseignements_notif', Ingoing::where('ingoing_type', 'App\Models\Enseignement')->latest()->get());
        }

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
