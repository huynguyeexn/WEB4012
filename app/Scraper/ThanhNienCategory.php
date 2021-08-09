<?php

namespace App\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

use App\Models\Category;
use Illuminate\Support\Str;

class ThanhNienCategory
{
    public function scrape()
    {
        $url = 'https://thanhnien.vn/rss.html';

        $client = new Client();

        $crawler = $client->request('GET', $url);

        $crawler->filter('.rss-list > ul > li')->each(
            function (Crawler $node) use (&$result) {
                $index = 0;

                $category = new Category();
                $category->name = $node->children()->filter('a')->first()->text();
                $slug = Str::of($category->name)->slug('-');


                $category->slug = $slug;
                $category->rss_link = $node->children()->filter('a')->first()->attr('href');
                $category->save();

                $id = $category->id;


                if ($node->children()->count() > 1) {
                    $node->children()->filter('ul li a')->each(
                        function ($child) use ($id, $slug, $index) {
                            $category = new Category();
                            $category->name = $child->text();
                            $category->slug = $slug . "/" . Str::of($category->name)->slug('-');
                            $category->rss_link = $child->attr('href');
                            $category->parent_id = $id;
                            $category->order = ++$index;
                            $category->save();
                        }
                    );
                }

                // print_r($node->eq(0)->text());

                // array_push($result,
                // [
                //     'title' => $node->eq(0)->text(),
                //     'href'=> $node->eq(0)->getUri(),
                //     'childrens' => $children
                // ]);
            }
        );

        // print_r($result);
    }
}

/**
let list = document.querySelectorAll('.rss-list > ul > li');

let result = [];
list.forEach((item) => {
    children = [];
    if(item.children.length > 1){
        item.children[1].querySelectorAll('ul li a').forEach((child) => {
            children.push({title: child.innerText, href: child.href});
        });
    }
    result.push({title: item.children[0].innerText, href: item.children[0].href, childrens: children});
})
result;
 */
