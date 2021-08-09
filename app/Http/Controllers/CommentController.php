<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = Comment::paginate(15);

        return view('pages.admin.comments.index', ['data' => $all]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comment $comments, Post $posts)
    {
        //
        $post = $posts->select('id')->where('slug', $request->slug)->first();

        $comments->post_id = $post->id;
        $comments->user_id = Auth::user()->id;
        $comments->content = $request->content;

        $comments->save();

        Toastr::success('', 'Đã gửi ý kiến của bạn!');
        return redirect()->route('post', ['slug' => $request->slug]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        try {
            $comment->delete();
            Toastr::success('Ý kiến đã được chuyển vào thùng rác.', 'Thành công!');
            return redirect()->route('admin.comments.index');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
            return redirect()->route('admin.comments.index');
        }
    }


    public function deleted()
    {
        //
        $all =  Comment::onlyTrashed()->paginate(15);
        return view('pages.admin.comments.deleted', ['data' => $all]);
    }


    public function restore($id)
    {
        //
        try {
            Comment::withTrashed()->find($id)->restore();
            Toastr::success('Ý kiến đã được khôi phục.', 'Thành công!');
            return redirect()->route('admin.comments.deleted');
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình khôi phục.', 'Lỗi!');
            return redirect()->route('admin.comments.deleted');
        }
    }


    public function remove($id)
    {
        //
        try {
            Comment::withTrashed()
                ->where('id', $id)
                ->forceDelete();

            Toastr::success('Ý kiến đã bị xóa.', 'Thành công!');
            return redirect()->route('admin.comments.deleted');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
            return redirect()->route('admin.comments.deleted');
        }
    }
}
