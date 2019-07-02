<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MovieRepository extends Facade {
    protected static function getFacadeAccessor() {
        return 'movierepository';
    }
}
