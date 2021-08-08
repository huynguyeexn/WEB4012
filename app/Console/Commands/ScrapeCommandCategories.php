<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScrapeCommandCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:ThanhNienCategory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $bot = new \App\Scraper\ThanhNienCategory();
        $bot->scrape();
        // return 0;
    }
}
