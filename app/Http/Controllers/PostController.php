<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleCreatePost;
use App\Http\Requests\RuleUpdatePost;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagsOfPost;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use stdClass;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        //
        // $key = createCacheKey('PostController', 'index', $request->get('page', 1));

        $paginate = new stdClass();
        $paginate->perpage = 15;
        $paginate->page = $request->get('page', 1);
        $paginate->total = $post->countPost();

        // $all = Cache::remember($key, 60, function () {
        //     return  Post::paginate(12);
        // });

        $all =  Post::orderBy('updated_at', 'desc')->paginate(12);

        return view('pages.admin.posts.index', ['data' => $all, 'paginate' => $paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('pages.admin.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuleCreatePost $request, Post $post)
    {
        //
        try {
            $formValue = $request->only(['title', 'desc', 'content', 'cat_id', 'hidden', 'tags']);

            $post->title = $formValue['title'];
            $post->desc = $formValue['desc'];
            $post->content = $formValue['content'];
            $post->cat_id = $formValue['cat_id'];
            $post->hidden = isset($formValue['hidden']) ?  1 : 0;
            $post->date = Carbon::now();
            $post->save();

            // Add slug
            $post->find($post->id);
            $post->slug = Str::of($post->title)->slug('-') . "-" . $post->id;

            if ($request->file('thumb')) {
                // Upload images
                $image = $request->file('thumb');
                $storedPath = $image->move('assets/images/posts', $post->slug . '-' . Str::random(5) . "." . $image->extension());
                $post->thumb = $storedPath;
            }

            $post->save();

            $tags = $formValue['tags'];

            foreach ($tags as $tag) {
                $tagField = Tag::firstOrCreate(['name' => $tag, 'slug' => Str::slug($tag)]);
                TagsOfPost::firstOrCreate(['post_id' => $post->id, 'tag_id' => $tagField->id]);
            }

            Toastr::success('Th??m tin t???c m???i th??nh c??ng.', 'Th??nh c??ng!');
            return redirect()->route('admin.posts.index');
        } catch (\Throwable $th) {

            Toastr::error('???? c?? l???i x???y ra trong qu?? tr??nh th??m m???i.', 'L???i!');
            return redirect()->route('admin.posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::all();
        $tagsOfPost = $post->tagsOfPost()->get();
        if ($post === null) {
            return 'Kh??ng t??m th???y tin t???c n??y.';
        }
        return view('pages.admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tagsOfPost' => $tagsOfPost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(RuleUpdatePost $request, Post $post)
    {
        //
        try {
            $formValue = $request->only(['title', 'desc', 'content', 'cat_id', 'hidden', 'old_image', 'tags']);

            $post->title = $formValue['title'];
            $post->desc = $formValue['desc'];
            $post->content = $formValue['content'];
            $post->cat_id = $formValue['cat_id'];
            $post->hidden = isset($formValue['hidden']) ?  1 : 0;
            $post->slug = Str::slug($formValue['title']) . "-" . $post->id;

            if (!isset($formValue['old_image'])) {
                if ($request->file('thumb')) {
                    // Upload images
                    $image = $request->file('thumb');
                    $storedPath = $image->move('assets/images/posts', $post->slug . '-' . Str::random(5) . "." . $image->extension());
                    $post->thumb = $storedPath;
                } else {
                    $post->thumb = null;
                }
            }

            $post->update();

            $tags = $formValue['tags'] ?? null;
            $post->tagsOfPost()->delete();
            if ($tags) {
                foreach ($tags as $tag) {
                    $tagField = Tag::firstOrCreate(['name' => $tag, 'slug' => Str::slug($tag)]);
                    TagsOfPost::firstOrCreate(['post_id' => $post->id, 'tag_id' => $tagField->id]);
                }
            }

            Toastr::success('C???p nh???t tin t???c th??nh c??ng.', 'Th??nh c??ng!');
            return redirect()->route('admin.posts.index');
        } catch (\Throwable $th) {

            Toastr::error('???? c?? l???i x???y ra trong qu?? tr??nh c???p nh???t.', 'L???i!');
            return redirect()->route('admin.posts.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        try {
            $post->delete();
            Toastr::success('Tin t???c ???? ???????c chuy???n v??o th??ng r??c.', 'Th??nh c??ng!');
            return redirect()->route('admin.posts.index');
        } catch (\Throwable $th) {
            //
            Toastr::error('???? c?? l???i x???y ra trong qu?? tr??nh x??a.', 'L???i!');
            return redirect()->route('admin.posts.index');
        }
    }


    public function deleted(Request $request, Post $post)
    {
        //
        $paginate = new stdClass();
        $paginate->perpage = 15;
        $paginate->page = $request->get('page', 1);
        $paginate->total = $post->countPost();


        $all =  $post->onlyTrashed()->paginate(12);
        return view('pages.admin.posts.deleted', ['data' => $all, 'paginate' => $paginate]);
    }


    public function restore($id)
    {
        //
        try {
            $post = Post::withTrashed()->find($id);
            $post->restore();

            Toastr::success('Tin t???c ???? ???????c kh??i ph???c.', 'Th??nh c??ng!');
            return redirect()->route('admin.posts.deleted');
        } catch (\Throwable $th) {

            Toastr::error('???? c?? l???i x???y ra trong qu?? tr??nh kh??i ph???c.', 'L???i!');
            return redirect()->route('admin.posts.deleted');
        }
    }


    public function remove($id)
    {
        //
        try {
            Post::withTrashed()
                ->where('id', $id)
                ->forceDelete();

            Toastr::success('Tin t???c ???? b??? x??a.', 'Th??nh c??ng!');
            return redirect()->route('admin.posts.deleted');
        } catch (\Throwable $th) {
            //
            Toastr::error('???? c?? l???i x???y ra trong qu?? tr??nh x??a.', 'L???i!');
            return redirect()->route('admin.posts.deleted');
        }
    }

    public function search(Post $post, Request $request)
    {
        $query = $request->get('query');

        $result = $post->where('title', 'LIKE', "%{$query}%")->paginate(20);

        $data = [
            'query' => $query,
            'posts' => $result,
        ];

        return view('pages.site.searchresult', $data);
    }
}
