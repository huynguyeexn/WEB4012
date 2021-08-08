<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Mail\SendContact;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    //
    public function index()
    {
        $mostViews = Post::orderBy('views', 'desc')->take(8)->get();
        $newPosts = Post::orderBy('date', 'desc')->take(8)->get();
        $carousel = Post::orderBy('date', 'desc')->take(5)->get();
        $popular =  Post::orderBy('date', 'desc')->skip(10)->take(6)->get();

        $thethao = Category::slug('thoi-su');
        $thegioi = Category::slug('the-gioi');
        $vanhoa = Category::slug('van-hoa');

        $data = [
            'carousel' => $carousel,
            'popular' => $popular,
            'rightSide' => [
                [
                    'name' => 'Tin mới',
                    'data' => $newPosts,
                ],
                [
                    'name' => 'Xem nhiều',
                    'data' => $mostViews,
                ],
            ],
            'list' => [
                [
                    'name' => $thethao->name,
                    'data' => $thethao->post->sortByDesc('date')->take(12),
                ],
                [
                    'name' => $thegioi->name,
                    'data' => $thegioi->post->sortByDesc('date')->take(12),
                ],
                [
                    'name' => $vanhoa->name,
                    'data' => $vanhoa->post->sortByDesc('date')->take(12),
                ],
            ]
        ];
        return view('pages.site.home', $data);
    }

    public function category(Request $request, Category $category, $parent, $child = null)
    {

        $key = createCacheKey('PageController', 'index' . $parent . $child, $request->get('page', 1));

        $data = Cache::remember($key, 10, function () use ($category, $parent, $child) {
            $slug = "$parent/$child";

            $parent = $category->slug($parent);
            $child = $category->slug($slug);

            $otherCat = $parent->children()->whereNotIn('slug', [$child->slug ?? ''])->get();

            $posts = $parent->post()->paginate(20);
            if ($child !== null) {
                $posts = $child->post()->paginate(20);
            }

            return [
                'parent' => $parent,
                'child' => $child,
                'otherCat' => $otherCat,
                'posts' => $posts
            ];
        });

        return view('pages.site.category', $data);
    }

    public function post(Request $request, Post $posts)
    {
        $post = $posts->where('slug', $request->slug)->first();

        ++$post->views;
        $post->update();

        $data = [
            'post' => $post
        ];
        return view('pages.site.post', $data);
    }

    public function contact()
    {
        return view('pages.site.contact');
    }
    public function sendContact(Request $request)
    {
        $data = [
            'email' => $request->email,
            'phone' => $request->phone ?? 'none',
            'title' => $request->title,
            'message' => $request->message,
        ];

        Mail::to('huynguyeexn@gmail.com')->send(new SendContact($data));

        Session::flash('flash_message', 'Send message successfully!');

        return redirect(route('home'));
    }

    public function login()
    {
        return view('pages.site.login');
    }
    public function register()
    {
        return view('pages.site.register');
    }
}
