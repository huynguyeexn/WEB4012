<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Console\Command;

class TagOfPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:getTag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A daily crawl new Post from ThanhNien.VN';

    public $index;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->index = 0;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = Post::count();
        Post::all()->each(
            function ($post) use ($count) {
                print(PHP_EOL . ++$this->index . "/" . $count);
                $bot = new \App\Scraper\ThanhNienTagOfPost($post->id);
                $bot->scrape();
            }
        );
    }
}
