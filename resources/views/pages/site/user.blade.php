@extends('layouts.main')

@section('page-title', 'Tài khoản của bạn')

@section('main-content')

<div class="mb-5 row">
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">Tài khoản</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">Lịch sử đọc tin tức</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <div class="flex justify-content-center row">
                                <img src="{{ $user->avatar }}" alt="" class="text-center rounded-circle avatar"
                                    height="50">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-20">
                                        <form action="{{ route('updateUser') }}" method="POST"
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
                                                        <input type="password" id="new_password" class="form-control"
                                                            name="new_password" value="{{ old('new_password') }}">
                                                        @error('new_password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="name">Xác nhận mật khẩu mới</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="password" id="new_password_confirmation"
                                                            class="form-control" name="new_password_confirmation"
                                                            value="{{ old('new_password_confirmation') }}">
                                                        @error('new_password_confirmation')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                        <button type="reset"
                                                            class="mb-1 mr-1 btn btn-secondary">Reset</button>
                                                        <button type="submit" class="mb-1 mr-1 btn btn-primary">Đổi
                                                            thông tin</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4>Lịch sử xem</h4>
                            @if (json_decode($user->history_read))
                                @foreach (json_decode($user->history_read) as $key => $value)
                                    <div class="accordion" id="{{ $key }}">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <p class="mb-0">
                                                    <button class="text-left btn btn-block" type="button"
                                                        data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Ngày
                                                        {{ \Carbon\Carbon::createFromTimestamp($key)->format('d/m/Y') }}

                                                        (Đã đọc: {{ count($value) }})
                                                    </button>
                                                </p>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#{{ $key }}">
                                                <div class="card-body">
                                                    <ul>
                                                        @foreach (array_reverse($value) as $row)
                                                            <li>
                                                                <a
                                                                    href="{{ route('post', \App\Models\Post::find($row)->slug) }}">
                                                                    {{ \App\Models\Post::find($row)->title }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Chưa có lịch sử xem</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
