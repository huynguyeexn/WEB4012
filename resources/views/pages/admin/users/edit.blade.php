@extends('layouts.admin')


@section('page-content')

    <section class="row">
        <div class="mx-auto col-12 col-md-6">
            <div class="card">
                <div class="pb-0 card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-inline">
                        Chỉnh sửa tài khoản
                    </h4>
                    <a href="{{ route('admin.users.index') }}" class="mb-2 btn btn-light-secondary icon"><i
                            class='bx bx-arrow-back'></i>Quay về</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                            class="form form-horizontal">



                            <input type="password" style="opacity: 0;position: absolute; z-index: -1">
                            @method('PUT')
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name">Họ tên</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="{{ $user->name }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">Email</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="email" id="email" class="form-control" name="email"
                                            value="{{ $user->email }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">Mật khẩu mới</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="password" id="new_password" class="form-control" name="new_password"
                                            value="{{ old('new_password') }}">
                                        @error('new_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">Xác nhận mật khẩu mới</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="password" id="new_password_confirmation" class="form-control"
                                            name="new_password_confirmation"
                                            value="{{ old('new_password_confirmation') }}">
                                        @error('new_password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-8 offset-md-4 form-group">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <input type="checkbox" id="is_admin" name="is_admin"
                                                    class="form-check-input" @if ($user->is_admin) checked @endif>
                                                <label for="is_admin">Tài khoản Admin?</label>
                                            </div>
                                            @error('is_admin')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="reset" class="mb-1 btn btn-light-secondary me-1">Reset</button>
                                        <button type="submit" class="mb-1 btn btn-primary me-1">Lưu tài khoản</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/choices.js/choices.min.css') }}" />
    <script src="{{ asset('assets/admin/vendors/choices.js/choices.min.js') }}"></script>

@endsection
