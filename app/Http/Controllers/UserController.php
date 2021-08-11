<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegsiterForm;
use App\Http\Requests\RuleCreateUser;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = User::orderBy('updated_at', 'desc')->paginate(15);

        return view('pages.admin.users.index', ['data' => $all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegsiterForm $request, User $user)
    {
        try {
            $input = $request->only('email', 'password', 'name');

            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = bcrypt($input['password']);
            $user->is_admin = isset($formValue['is_admin']) ?  1 : 0;
            $user->avatar = 'assets/images/unknown-person-icon.jpg';

            $user->save();
            Toastr::success('', 'Tạo tài khoản thành công!');
            return redirect()->route('admin.users.index');
        } catch (\Throwable $th) {
            Toastr::error('Đã có lỗi xảy ra trong quá trình thêm mới.', 'Lỗi!');
            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            Toastr::success('Đã xóa tài khoản.', 'Thành công!');
            return redirect()->route('admin.users.index');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
            return redirect()->route('admin.users.index');
        }
    }


    public function deleted()
    {
        //
        $all =  User::onlyTrashed()->get();
        return view('pages.admin.users.deleted', ['data' => $all]);
    }


    public function restore($id)
    {
        //
        try {
            $user = User::withTrashed()->find($id);

            $user->restore();

            Toastr::success('Tài khoản đã được khôi phục.', 'Thành công!');
            return redirect()->route('admin.users.deleted');
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình khôi phục.', 'Lỗi!');
            return redirect()->route('admin.users.deleted');
        }
    }


    public function remove($id)
    {
        //
        try {
            User::withTrashed()
                ->where('id', $id)
                ->forceDelete();

            Toastr::success('Tài khoản đã bị xóa.', 'Thành công!');
            return redirect()->route('admin.users.deleted');
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Đã có lỗi xảy ra trong quá trình xóa.', 'Lỗi!');
            return redirect()->route('admin.users.deleted');
        }
    }
}
