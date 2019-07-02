<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CharacterRepository;
use App\Repositories\MovieRepository;
use Illuminate\Support\Facades\App;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(
            'characterrepository',
            function() {
                return new CharacterRepository();
            }
        );
        App::bind(
            'movierepository',
            function() {
                return new MovieRepository();
            }
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
