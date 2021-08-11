@extends('layouts.admin')


@section('page-content')

    <section class="row">
        <div class="mx-auto col-12 col-md-6">
            <div class="card">
                <div class="pb-0 card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-inline">
                        Thêm tài khoản mới
                    </h4>
                    <a href="{{ route('admin.users.index') }}" class="mb-2 btn btn-light-secondary icon"><i
                            class='bx bx-arrow-back'></i>Quay về</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="POST" class="form form-horizontal">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name">Họ tên</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">Email</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="email" id="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">Mật khẩu</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="password" id="password" class="form-control" name="password"
                                            value="{{ old('password') }}" required>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">Xác nhận mật khẩu</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="password" id="password_confirmation" class="form-control"
                                            name="password_confirmation" value="{{ old('password_confirmation') }}"
                                            required>
                                        @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-8 offset-md-4 form-group">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <input type="checkbox" id="is_admin" name="is_admin"
                                                    class="form-check-input" @if (old('is_admin') === 'on') checked @endif>
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

    <script defer>
        function string_to_slug(str) {
            //Đổi chữ hoa thành chữ thường
            slug = str.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”

            return slug;
        }
        document.getElementById('name').addEventListener('input', function() {
            document.getElementById('slug').value = string_to_slug(this.value);
        })
    </script>
@endsection
