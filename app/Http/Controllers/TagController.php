<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleCreateTag;
use App\Models\Tag;
use App\Models\TagsOfPost;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = Tag::orderBy('updated_at', 'desc')->paginate(20);

        return view('pages.admin.tags.index', ['data' => $all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.admin.tags.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuleCreateTag $request, Tag $tag)
    {
        try {
            $formValue = $request->only(['name', 'slug', 'hidden']);

            $tag->name = $formValue['name'];
            $tag->slug = $formValue['slug'];
            $tag->hidden = isset($formValue['hidden']) ?  1 : 0;
            $tag->save();

            Toastr::success('Thêm thẻ mới thành công.', 'Thành công!');
            return redirect()->route('admin.tags.index');
        } catch (\Throwable $th) {
            Toastr::error('Đã có lỗi xảy ra trong quá trình thêm mới.', 'Lỗi!');
            return redirect()->route('admin.tags.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
        return view('pages.admin.tags.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        try {
            $formValue = $request->only(['name', 'slug', 'hidden']);

            $tag->name = $formValue['name'];
            $tag->slug = $formValue['slug'];
            $tag->hidden = isset($formValue['hidden']) ?  1 : 0;
            $tag->update();

            Toastr::success('Sửa thẻ thành công.', 'Thành công!');
            return redirect()->route('admin.tags.index');
        } catch (\Throwable $th) {
            Toastr::error('Đã có lỗi xảy ra trong quá trình lưu.', 'Lỗi!');
            return redirect()->route('admin.tags.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        // //
        try {
            $tag->delete();

            $tag->tagsOfPost()->delete();

            Toastr::success('Thẻ đã được chuyển vào thùng rác.', 'Thành công!');
            return redirect()->route('admin.tags.index');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
            return redirect()->route('admin.tags.index');
        }
    }


    public function deleted()
    {
        //
        $all =  Tag::onlyTrashed()->paginate(20);
        return view('pages.admin.tags.deleted', ['data' => $all]);
    }


    public function restore($id)
    {
        //
        try {
            Tag::withTrashed()->find($id)->restore();
            Tag::find($id)->tagsOfPost()->withTrashed()->restore();

            Toastr::success('Thẻ đã được khôi phục.', 'Thành công!');
            return redirect()->route('admin.tags.deleted');
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình khôi phục.', 'Lỗi!');
            return redirect()->route('admin.tags.deleted');
        }
    }


    public function remove($id)
    {
        //
        try {
            Tag::withTrashed()
                ->where('id', $id)
                ->forceDelete();

            Toastr::success('Thẻ đã bị xóa.', 'Thành công!');
            return redirect()->route('admin.tags.deleted');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
            return redirect()->route('admin.tags.deleted');
        }
    }

    public function apiGetAll(Tag $tag)
    {
        return response($tag->all(), 200);
    }
}
