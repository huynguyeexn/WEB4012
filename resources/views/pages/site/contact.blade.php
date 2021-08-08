@extends('layouts.main')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card p-4">
                <h1 class="text-center text-uppercase">
                    Liên hệ
                </h1>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card-box">
                <form class="form-horizontal" role="form" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Email của bạn </label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-3 col-form-label">Số điện thoại</label>
                        <div class="col-9">
                            <input type="phone" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-3 col-form-label">Tiêu đề</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-3 col-form-label">Nội dung</label>
                        <div class="col-9">
                            <textarea class="form-control" rows="5" name="message" required></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Gửi thư liên hệ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
