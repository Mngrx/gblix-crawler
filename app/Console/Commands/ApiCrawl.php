<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use App\Models\Character;
use App\Facades\CrawlerGhibli;

class ApiCrawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get informantion on Studio Ghibli API and persist it in our database. :)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        CrawlerGhibli::doCrawl();

        $this->comment('Got data successfully!');
    }
}
