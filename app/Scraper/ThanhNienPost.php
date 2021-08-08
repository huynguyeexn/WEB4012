<?php

namespace App\Scraper;

use Carbon\Carbon;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;

class ThanhNienPost
{
    public $category;
    public $index;

    public function __construct($id)
    {
        $this->index = 0;
        $this->category = Category::find($id);
    }

    public function scrape()
    {
        try {
            $category = $this->category;

            $url = $category->rss_link;

            $client = new Client();

            $crawler = $client->request('GET', $url);
            $crawler->filterXPath('//rss/channel/item')->each(
                function (Crawler $item) use ($category) {
                    $title = $item->filter('title')->text();
                    $desc = preg_replace('/(<([^>]+)>)/', '', $item->filter('description')->text());
                    $link = $item->filter('link')->text();
                    $thumb = null;
                    try {
                        $thumb = $item->filter('image')->text(null);
                    } catch (\Throwable $th) {
                    }
                    $date = new Carbon($item->filter('pubDate')->text());

                    $post = new Post();

                    // Check exitst post in database
                    if (!$post->where('source_link', $link)->exists() && !$post->where('title', $title)->exists()) {
                        // Get require field
                        $post->title = $title;
                        $post->desc = Str::limit($desc, 250, '...');
                        $post->source_link = $link;
                        $post->thumb = $thumb;
                        $post->date = $date;
                        $post->views = random_int(1000, 10000);
                        $post->like = random_int(10, 1000);
                        $post->source = 'Báo Thanh Niên';
                        $post->cat_id = $category->id;
                        $post->save();


                        // Add slug
                        $post->find($post->id);
                        $post->slug = Str::of($title)->slug('-')."-".$post->id;
                        // $post->save();


                        // Get content
                        $contentUrl = $link;
                        $content = new Client();
                        $content = $content->request('GET', $contentUrl);

                        $html = $content->filter('#abody')->html();

                        $post->content = $html;
                        $post->save();

                        $this->index++;
                    }
                }
            );

            print($this->index.' rows.');
        } catch (\Throwable $th) {
            print($this->index.' rows. (Error)');
        }
    }
}
