<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\RuleUpdateUser;
use App\Mail\SendContact;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
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
        $tagList = array_map(function ($row) {
            return $row["tag_id"];
        }, $post->tagsOfPost()->get()->toArray());

        $related = [];
        foreach ($tagList as $tagId) {
            array_push($related, ...Tag::find($tagId)->posts());
        }
        if (count(array_unique($related)) < 20) {
            $relatedByCategory = Category::find($post->cat_id)->post->take(20);
            array_push($related, ...$relatedByCategory);
        }
        $related =  array_slice(array_unique($related), 0, 20);

        if (\Auth::check()) {
            $user = User::find(\Auth::user()->id);

            $history = json_decode($user->history_read, true) ?: array();
            $today = Carbon::create(Carbon::now()->toDateString())->getTimestamp();

            // dd($history);

            if (!isset($history["$today"])) {
                $history[$today] = array();
            }
            if (!in_array($post->id, $history[$today])) {
                array_push($history[$today], $post->id);
                ++$post->views;
                $post->update();
            }
            $user->history_read = json_encode($history);
            $user->update();
        } else {
            ++$post->views;
            $post->update();
        }

        $data = [
            'post' => $post,
            'related' => $related
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

    public function tag(Request $request, Tag $tag, $slug)
    {

        $id = $tag->where('slug', $slug)->first()->id;

        $posts = Tag::find($id)->tagsOfPost()->paginate(20);

        $data =  [
            'tag' => $tag->where('slug', $slug)->first(),
            'posts' => $posts
        ];


        return view('pages.site.tag', $data);
    }

    public function updateUser(RuleUpdateUser $request)
    {
        //
        try {
            $user = User::find(\Auth::user()->id);

            $input = $request->only(['name', 'email', 'new_password']);

            $user->name = $input['name'];
            $user->email = $input['email'];
            if ($input['new_password']) {
                $user->password = bcrypt($input['new_password']);
            }

            $user->update();

            Toastr::success('Sửa tài khoản thành công.', 'Thành công!');
            return redirect()->route('user');
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình lưu.', 'Lỗi!');
            return redirect()->route('user');
        }
    }
}
