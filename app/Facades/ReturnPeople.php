<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ReturnPeople extends Facade {
    protected static function getFacadeAccessor() {
        return 'returnpeople';
    }
}
