<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class WorkOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A daily crawl new Post from ThanhNien.VN';

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
        Category::whereNull('parent_id')->each(
            function ($cat) {
                print(PHP_EOL . "[$cat->id] ");

                $bot = new \App\Scraper\ThanhNienPost($cat->id);
                $bot->scrape();
            }
        );
    }
}
