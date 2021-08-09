@extends('layouts.admin')

@section('head')
@endsection

@section('page-content')

    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <section class="row">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm tin tức mới</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="desc">Tóm tắt</label>
                            <input type="text" name="desc" id="desc" class="form-control" value="{{ $post->desc }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="content" cols="30" rows="20"
                                required>{{ $post->content }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input class="form-control" type="file" id="thumb" name="thumb" value="{{ $post->thumb }}">
                            <img id="thumb-preview"
                                src="{{ route('resizes', ['size' => '200x200', 'imagePath' => $post->thumb]) }}" alt=""
                                class="d-none" />
                            <button id="clear-thumb" type="button" class="d-none">Xóa ảnh</button>
                            <button id="restore-thumb" type="button" class="d-none">Khôi phục</button>
                            <input type="checkbox" name="old_image" id="old-image" checked hidden>
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select class="choices form-select" name="cat_id">
                                <option value="">Không có</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" @if ($post->cat_id === $cat->id) selected @endif>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Thẻ</label>
                            <select class="form-select" id="validationTags" name="tags[]" multiple data-allow-new="true">
                                <option disabled hidden value="">Gõ tên thẻ và nhấn enter...</option>

                                @foreach ($tagsOfPost as $row)
                                    <option selected value="{{ $row->tag->name }}">{{ $row->tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <div class="checkbox">
                                    <input type="checkbox" id="hidden" name="hidden" class="form-check-input">
                                    <label for="hidden">Ẩn tin tức <i class="fa fa-eye-slash" aria-hidden="true" @if ($post->hidden === 1) checked @endif></i></label>
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
        function myCustomOnInit() {
            alert("We are ready to rumble!!");
        }
        tinymce.init({
            selector: '#content',
            plugins: [
                'a11ychecker advcode advlist anchor autolink codesample fullscreen help image imagetools tinydrive',
                ' lists link media noneditable powerpaste preview',
                ' searchreplace table template tinymcespellchecker visualblocks wordcount'
            ],
            toolbar: 'insertfile a11ycheck undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image tinydrive',
            setup: function(ed) {
                ed.on('init', function(args) {
                    let content = this.getContent();
                    content = content.replace(/data-src/gi, 'src');
                    this.setContent(content);
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var thumb = document.getElementById('thumb');
            var thumbReview = document.getElementById('thumb-preview');
            var clearThumb = document.getElementById('clear-thumb');
            var restoreThumb = document.getElementById('restore-thumb');
            var oldImage = document.getElementById('old-image');
            var thumbSrc = null;

            // Onload
            if (thumbReview.src) {
                thumbSrc = thumbReview.src;
                thumbReview.setAttribute('class',
                    'p-1 my-2 border w-100 d-block');
                clearThumb.setAttribute('class', 'btn btn-danger');
                restoreThumb.setAttribute('class', 'btn btn-primary');
            }

            // restore click
            restoreThumb.addEventListener('click', function(e) {
                oldImage.checked = true;
                thumb.value = '';
                thumbReview.setAttribute('src', thumbSrc);
                thumbReview.setAttribute('class',
                    'p-1 my-2 border w-100 d-block');
                clearThumb.setAttribute('class', 'btn btn-danger');
            });

            // Clearthumb click
            clearThumb.addEventListener('click', function(e) {
                oldImage.checked = false;
                e.preventDefault();
                thumb.value = '';
                thumbReview.setAttribute('src', '');
                thumbReview.setAttribute('class', 'd-none');
                clearThumb.setAttribute('class', 'd-none');
            });

            // Thumb input onchange
            thumb.addEventListener('change', function(e) {
                oldImage.checked = false;
                readURL(this);
            })


            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        thumbReview.setAttribute('src', e.target.result);
                        thumbReview.setAttribute('class',
                            'p-1 my-2 border w-100 d-block');
                        clearThumb.setAttribute('class', 'btn btn-danger');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
    <script type="module">
        import Tags from "../../../assets/admin/vendors/bootstrap5-tags-master/tags.min.js";
        Tags.init();
    </script>
@endsection
