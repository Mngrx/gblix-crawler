<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CrawlerGhibli extends Facade {
    protected static function getFacadeAccessor() {
        return 'crawlerghibli';
    }
}
