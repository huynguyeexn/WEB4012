@extends('layouts.admin')

@section('head')
@endsection

@section('page-content')

    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section class="row">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm tin tức mới</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="desc">Tóm tắt</label>
                            <input type="text" name="desc" id="desc" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="content" cols="30" rows="20" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input class="form-control" type="file" id="thumb" name="thumb">
                            <img id="thumb-preview" src="" alt="" class="d-none" />
                            <button id="clear-thumb" type="button" class="d-none">Xóa ảnh</button>
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select class="choices form-select" name="cat_id">
                                <option value="">Không có</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" @if (old('cat_id') === $cat->id) selected @endif>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <div class="checkbox">
                                    <input type="checkbox" id="hidden" name="hidden" class="form-check-input">
                                    <label for="hidden">Ẩn tin tức <i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Đăng tin tức</button>
                    </div>
                </div>
            </div>
        </section>
    </form>



    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/choices.js/choices.min.css') }}" />
    <script src="{{ asset('assets/admin/vendors/choices.js/choices.min.js') }}"></script>

    <script src="{{ asset('assets/admin/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/tinymce/plugins/code/plugin.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: '#content'
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('thumb-preview').setAttribute('src', e.target.result);
                    document.getElementById('thumb-preview').setAttribute('class', 'p-1 my-2 border w-100 d-block');
                    document.getElementById('clear-thumb').setAttribute('class', 'btn btn-primary');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('clear-thumb').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('thumb').value = '';
            document.getElementById('thumb-preview').setAttribute('src', '');
            document.getElementById('thumb-preview').setAttribute('class', 'd-none');
            document.getElementById('clear-thumb').setAttribute('class', 'd-none');
        });

        document.getElementById('thumb').addEventListener('change', function(e) {
            readURL(this);
        })
    </script>
@endsection
