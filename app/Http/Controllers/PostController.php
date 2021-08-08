<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleCreatePost;
use App\Http\Requests\RuleUpdatePost;
use App\Models\Category;
use App\Models\Post;
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
            $formValue = $request->only(['title', 'desc', 'content', 'cat_id', 'hidden']);

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

            Toastr::success('Thêm tin tức mới thành công.', 'Thành công!');
            return redirect()->route('admin.posts.index');
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình thêm mới.', 'Lỗi!');
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
        if ($post === null) {
            return 'Không tìm thấy tin tức này.';
        }
        return view('pages.admin.posts.edit', ['post' => $post, 'categories' => $categories]);
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
            $formValue = $request->only(['title', 'desc', 'content', 'cat_id', 'hidden', 'old_image']);

            $post->title = $formValue['title'];
            $post->desc = $formValue['desc'];
            $post->content = $formValue['content'];
            $post->cat_id = $formValue['cat_id'];
            $post->hidden = isset($formValue['hidden']) ?  1 : 0;
            $post->slug = Str::of($formValue['title'])->slug('-') . "-" . $post->id;

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

            // dd($post);

            $post->update();

            Toastr::success('Cập nhật tin tức thành công.', 'Thành công!');
            return redirect()->route('admin.posts.index');
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình cập nhật.', 'Lỗi!');
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
            Toastr::success('Tin tức đã được chuyển vào thùng rác.', 'Thành công!');
            return redirect()->route('admin.posts.index');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
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

            Toastr::success('Tin tức đã được khôi phục.', 'Thành công!');
            return redirect()->route('admin.posts.deleted');
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình khôi phục.', 'Lỗi!');
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

            Toastr::success('Tin tức đã bị xóa.', 'Thành công!');
            return redirect()->route('admin.posts.deleted');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
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
