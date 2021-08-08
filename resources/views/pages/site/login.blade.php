@extends('layouts.main')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="p-4 card">
                <h1 class="text-center text-uppercase">
                    Đăng nhập
                </h1>
            </div>
        </div>
        <div class="mx-auto mt-4 col-12 col-md-8 col-lg-6">
            <div class="card-box">
                <div class="modal-body">
                    <form action="{{ route('toLogin') }}" method="post" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email đăng nhập:</label>
                            <input type="email" class="form-control" name="email" placeholder="Email đăng nhập...">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu đăng nhập:</label>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu đăng nhập...">
                        </div>
                    </form>
                    <div class="text-center form-group">
                        <button type="submit" class="btn btn-block btn-primary" form="login-form">Đăng nhập</button>

                        <p class="my-2"><a class="text-primary" href="">Quên mật khẩu?</a></p>

                        <p class="my-2">Bạn chưa có tài khoản? <a class="text-primary"
                                href="{{ route('register') }}"><strong>Đăng
                                    ký</strong></a></p>
                        <hr>
                        <div class="row login-btn">
                            {{-- GOOGLE --}}
                            <div class="col-6 mt-2">
                                <a href="{{ route('login.google') }}" type="button" class="btn btn-block google">
                                    <h3 class="m-0"><i class="fab fa-google" aria-hidden="true"></i></h3>
                                </a>
                            </div>
                            {{-- FACEBOOK --}}
                            <div class="col-6 mt-2">
                                <button type="button" class="btn btn-block facebook">
                                    <h3 class="m-0"><i class="fab fa-facebook-f" aria-hidden="true"></i></h3>
                                </button>
                            </div>
                            {{-- GITHUB --}}
                            <div class="col-6 mt-2">
                                <a href="{{ route('login.github') }}" type="button" class="github btn btn-block">
                                    <h3 class="m-0"><i class="fab fa-github" aria-hidden="true"></i></h3>
                                </a>
                            </div>
                            {{-- TWITTER --}}
                            <div class="col-6 mt-2">
                                <button type="button" class="twitter btn btn-block">
                                    <h3 class="m-0"><i class="fab fa-twitter" aria-hidden="true"></i></h3>
                                </button>
                            </div>
                            {{-- TWITCH --}}
                            <div class="col-6 mt-2">
                                <button type="button" class="twitch btn btn-block">
                                    <h3 class="m-0"><i class="fab fa-twitch" aria-hidden="true"></i></h3>
                                </button>
                            </div>
                            {{-- DISCORD --}}
                            <div class="col-6 mt-2">
                                <button type="button" class="discord btn btn-block">
                                    <h3 class="m-0"><i class="fab fa-discord"></i></h3>
                                </button>
                            </div>
                            {{-- Tiktok --}}
                            <div class="col-6 mt-2">
                                <button type="button" class="tiktok btn btn-block">
                                    <h3 class="m-0"><i class="fab fa-tiktok"></i></h3>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
