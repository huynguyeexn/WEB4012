<?php

namespace App\Scraper;

use Carbon\Carbon;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagsOfPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ThanhNienTagOfPost
{
    public $post;
    public function __construct($id)
    {
        $this->post = Post::find($id);
    }

    public function scrape()
    {
        try {
            $post = $this->post;

            $url = $post->source_link;

            $client = new Client();
            $crawler = $client->request('GET', $url);
            $html = array();
            try {
                $html = $crawler->filter('#abde > .details__tags')->html();
                $html = preg_replace('/(<([^>]+)>)/', '', $html);
                $html = explode("#", $html);
            } catch (\Throwable $th) {
                $html = array();
            }

            foreach ($html as $tagCrawl) {
                $tag = Tag::where('name', $tagCrawl)->first();

                // Nếu tag chưa tồn tại
                // Thêm tag vào DB
                // @return Gán lại $tag thành tag vừa thêm
                if (!$tag) {
                    $tag = new Tag();
                    $tag->name = $tagCrawl;
                    $tag->slug = Str::slug($tagCrawl);
                    $tag->save();
                }

                // Nếu Post chưa có Tag này
                // Thêm tag này cho post
                if (DB::table('tags_of_post')->where([
                    ['post_id', '=', $post->id],
                    ['tag_id', '=', $tag->id],
                ])->doesntExist()) {
                    DB::table('tags_of_post')->insert([
                        'post_id' => $post->id,
                        'tag_id' => $tag->id,
                    ]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
