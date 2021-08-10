<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleCreateCategory;
use App\Http\Requests\RuleUpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $key = createCacheKey('CategoryController', 'index');

        $all = Category::all()->sortByDesc('updated_at');

        return view('pages.admin.categories.index', ['data' => $all]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parent_cat = Category::whereNull('parent_id')->get();
        return view('pages.admin.categories.create', ['parent_cat' => $parent_cat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuleCreateCategory $request, Category $category)
    {
        try {
            $formValue = $request->only(['name', 'slug', 'parent_id', 'hidden']);
            $slug = $formValue['slug'];

            if ($formValue['parent_id'] !== null) {
                $parent = $category->where('id', $formValue['parent_id'])->first()->slug;
                $slug = $parent . '/' .  $slug;
            };

            $category->name = $formValue['name'];
            $category->slug = $slug;
            $category->parent_id = $formValue['parent_id'];
            $category->hidden = isset($formValue['hidden']) ?  1 : 0;
            $category->save();

            Toastr::success('Thêm danh mục mới thành công.', 'Thành công!');
            return redirect()->route('admin.categories.index');
        } catch (\Throwable $th) {
            Toastr::error('Đã có lỗi xảy ra trong quá trình thêm mới.', 'Lỗi!');
            return redirect()->route('admin.categories.index');
        }
    }


    public function edit($id)
    {
        //

        $parent_cat = Category::whereNull('parent_id')->get();
        $category = Category::find($id);


        if ($category === null) {
            return 'Không tìm thấy Danh nục này.';
        }
        return view('pages.admin.categories.edit', ['category' => $category, 'parent_cat' => $parent_cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RuleUpdateCategory $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return 'Không tìm thấy danh mục này';
            }

            $formValue = $request->only(['name', 'slug', 'parent_id', 'hidden']);
            $slug = $formValue['slug'];

            if ($formValue['parent_id'] !== null) {
                $parent = $category->where('id', $formValue['parent_id'])->first()->slug;
                $slug = $parent . '/' .  $slug;
            };

            $category->name = $formValue['name'];
            $category->slug = $slug;
            $category->parent_id = $formValue['parent_id'];
            $category->hidden = isset($formValue['hidden']) ?  1 : 0;
            $category->update();

            Toastr::success('Sửa danh mục thành công.', 'Thành công!');
            return redirect()->route('admin.categories.index');
        } catch (\Throwable $th) {
            Toastr::error('Đã có lỗi xảy ra trong quá trình lưu.', 'Lỗi!');
            return redirect()->route('admin.categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $category = Category::find($id);
            if (count($category->children) > 0 && $category->countPost() > 0) {
                Toastr::success('Đang có tin tức hoặc danh mục khác thuộc danh mục này (Hãy xóa danh mục con và bài viét trước)', 'Không thể xóa!');
                return redirect()->route('admin.categories.index');
            };
            $category->delete();
            // Toastr::success('Danh mục đã được chuyển vào thùng rác.', 'Thành công!');
            Toastr::success('Đã xóa danh mục.', 'Thành công!');
            return redirect()->route('admin.categories.index');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
            return redirect()->route('admin.categories.index');
        }
    }

    // public function deleted()
    // {
    //     //
    //     $all =  Category::onlyTrashed()->get();
    //     return view('pages.admin.categories.deleted', ['data' => $all]);
    // }


    // public function restore($id)
    // {
    //     //
    //     try {
    //         $category = Category::withTrashed()->find($id);

    //         foreach ($category->children as $child) {
    //             $child->restore();
    //         }

    //         $category->restore();

    //         Toastr::success('Danh mục đã được khôi phục.', 'Thành công!');
    //         return redirect()->route('admin.categories.deleted');
    //     } catch (\Throwable $th) {
    //         throw $th;
    //         Toastr::error('Đã có lỗi xảy ra trong quá trình khôi phục.', 'Lỗi!');
    //         return redirect()->route('admin.categories.deleted');
    //     }
    // }


    // public function remove($id)
    // {
    //     //
    //     try {
    //         Category::withTrashed()
    //             ->where('id', $id)
    //             ->forceDelete();

    //         Toastr::success('Danh mục đã bị xóa.', 'Thành công!');
    //         return redirect()->route('admin.categories.deleted');
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
    //         return redirect()->route('admin.categories.deleted');
    //     }
    // }
}
