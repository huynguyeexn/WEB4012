@extends('layouts.main')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="p-4 card">
                <h1 class="text-center text-uppercase">
                    Đăng ký tài khoản
                </h1>
            </div>
        </div>
        <div class="mx-auto mt-4 col-12 col-md-8 col-lg-6">
            <div class="card-box">
                <div class="modal-body">
                    <form action="{{ route('toRegister') }}" method="post" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên của bạn:</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name"
                                placeholder="Tên của bạn...">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email đăng nhập:</label>
                            <input value="{{ old('email') }}" type="email" class="form-control" name="email"
                                placeholder="Email đăng nhập...">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu đăng nhập:</label>
                            <input value="{{ old('password') }}" type="password" class="form-control" name="password"
                                placeholder="Mật khẩu đăng nhập...">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Nhập lại mật khẩu:</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Nhập lại mật khẩu...">
                        </div>
                    </form>
                    <div class="text-center form-group">
                        <button type="submit" class="btn btn-block btn-primary" form="register-form">Đăng ký</button>

                        <p class="my-2"><a class="text-primary" href="">Quên mật khẩu?</a></p>

                        <p class="my-2">Bạn đã có tài khoản? <a class="text-primary"
                                href="{{ route('login') }}"><strong>Đăng
                                    Nhập</strong></a></p>
                        <hr>
                        <button type="button" class="btn btn-block btn-purple">
                            Đăng nhập bằng Facebook
                        </button>
                        <a href="{{ route('login.google') }}" type="button" class="btn btn-block btn-danger">
                            Đăng nhập bằng Gmail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
