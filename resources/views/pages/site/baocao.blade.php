<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Báo cáo PHP3 - Nguyễn Ngọc Huy - PS14009</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    <style>
        .card {
            padding: 1rem;
            border-radius: .5rem;
            border: 0;
            box-shadow: 0 0.25rem 1rem rgb(48 55 66 / 15%);
            height: 100%;
        }

        body {
            padding: 20px;
        }

    </style>
</head>

<body class="container">
    <div class="columns">
        <div class="p-2 column col-8 col-mx-auto">
            <div class="m-2 card">
                <div class="card-header">
                    <h3>
                        BÁO CÁO ASM: Thực hiện website tin tức
                    </h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item" id="timeline-example-1">
                            <div class="timeline-left">
                                <a class="timeline-icon" href=""></a>
                            </div>
                            <div class="timeline-content">
                                <!-- tiles structure -->
                                Website online: <a
                                    href="https://the-news-php3.herokuapp.com/">https://the-news-php3.herokuapp.com/</a>
                            </div>
                        </div>
                        <div class="timeline-item" id="timeline-example-1">
                            <div class="timeline-left">
                                <a class="timeline-icon icon-lg" href="">
                                    <i class="icon icon-check"></i>
                                </a>
                            </div>
                            <div class="timeline-content">
                                <div class="tile">
                                    <div class="tile-content">
                                        <h4 class="tile-subtitle">Assignment Final</h4>
                                        <h6 class="mb-2">(Chức năng bổ sung)</h6>
                                        {{-- Người dùng --}}
                                        <div>
                                            <span class="px-2 label label-primary">Người dùng</span>
                                            <ol class="m-0">
                                                <li>Sửa đổi thông tin người dùng <i
                                                        class="mx-2 icon icon-check text-success"></i></li>
                                                <li>Lịch sử xem tin <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Chi tiết tin --}}
                                        <div>
                                            <span class="px-2 label label-primary">Chi tiết tin</span>
                                            <ol class="m-0">
                                                <li>Tiêu đề tin hiện trên title của trình duyệt <i
                                                        class="mx-2 icon icon-check text-success"></i></li>
                                                <li>Hiện và đếm số lần xem tin <i
                                                        class="mx-2 icon icon-check text-success"></i></li>
                                                <li>Hiện ý kiến và lưu ý kiến <i
                                                        class="mx-2 icon icon-check text-success"></i></li>
                                                </li>
                                                <li>Hiện tin liên quan <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Hiện breadcrumb <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Hiện ngày, số lần xem<i
                                                        class="mx-2 icon icon-check text-success"></i></li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Tag --}}
                                        <div>
                                            <span class="px-2 label label-primary">Tag</span>
                                            <ol class="m-0">
                                                <li>Quản lý Thẻ tag <i class="mx-2 icon icon-check text-success"></i>
                                                <li>Thêm tag trong thêm tin tức <i
                                                        class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Hiện tag trong tin chi tiết <i
                                                        class="mx-2 icon icon-check text-success"></i></li>
                                                <li>Xem danh sách tin tức chứa Thẻ Tag <i
                                                        class="mx-2 icon icon-check text-success"></i></li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Admin --}}
                                        <div>
                                            <span class="px-2 label label-primary">Admin</span>
                                            <ol class="m-0">
                                                <li>Quản lý User <i class="mx-2 icon icon-check text-success"></i></li>
                                                <li>Quản lý Comment <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="timeline-item" id="timeline-example-1">
                            <div class="timeline-left">
                                <a class="timeline-icon icon-lg" href="">
                                    <i class="icon icon-check"></i>
                                </a>
                            </div>
                            <div class="timeline-content">
                                <div class="tile">
                                    <div class="tile-content">
                                        <h4 class="tile-subtitle">Assignment 2</h4>
                                        <h6 class="mb-2">(Giao diện quản trị)</h6>
                                        {{-- Template --}}
                                        <div>
                                            <span class="px-2 label label-primary">Template</span>
                                            <ol class="m-0">
                                                <li>Sử sụng template responsive <a target="_blank"
                                                        href="https://zuramai.github.io/mazer/demo">Mazer</a>
                                                    trên nền framework <a target="_blank"
                                                        href="https://getbootstrap.com/">Bootstrap 5.0.2</a>,
                                                    custom lại bằng SCSS.</li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>

                                        {{-- Đăng nhập --}}
                                        <div>
                                            <span class="px-2 label label-primary">Đăng nhập</span>
                                            <ol class="m-0">
                                                <li>Đăng nhập bằng tài khoản xã hội
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Kiểm tra đăng nhập
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Kiểm tra quyền Admin
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>

                                            </ol>
                                        </div>
                                        <div class="divider"></div>

                                        {{-- Tin tức --}}
                                        <div>
                                            <span class="px-2 label label-primary">Tin tức</span>
                                            <ol class="m-0">
                                                <li>Thêm <i class="mx-2 icon icon-check text-success"></i>,
                                                    sửa <i class="mx-2 icon icon-check text-success"></i>,
                                                    xóa <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Web editor
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Upload hình
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Thùng rác
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>


                                        {{-- Danh mục --}}
                                        <div>
                                            <span class="px-2 label label-primary">Danh mục</span>
                                            <ol class="m-0">
                                                <li>Tìm, Lọc danh mục
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Thêm <i class="mx-2 icon icon-check text-success"></i>,
                                                    Sửa <i class="mx-2 icon icon-check text-success"></i>,
                                                    Xóa <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Thùng rác
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>


                                        {{-- Dashboard --}}
                                        <div>
                                            <span class="px-2 label label-primary">Dashboard</span>
                                            <ol class="m-0">
                                                <li>Thống kê số thể loại
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Thống kê số tin
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>Thống kê tin xem nhiều
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>

                                        {{-- Định dạng --}}
                                        <div>
                                            <span class="px-2 label label-primary">Định dạng</span>
                                            <ol class="m-0">
                                                <li>Việt hóa toàn bộ
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-item" id="timeline-example-2">
                            <div class="timeline-left">
                                <a class="timeline-icon icon-lg" href="">
                                    <i class="icon icon-check"></i>
                                </a>
                            </div>
                            <div class="timeline-content">
                                <div class="tile">
                                    <div class="tile-content">
                                        <h4 class="tile-subtitle">Assignment 1</h4>
                                        <h6 class="mb-2">(Giao diện người dùng)</h6>
                                        {{-- Template --}}
                                        <div>
                                            <span class="px-2 label label-primary">Template</span>
                                            <ol class="m-0">
                                                <li>Sử sụng template responsive <a target="_blank"
                                                        href="https://coderthemes.com/adminto/layouts/horizontal/index.html">Adminto</a>
                                                    trên nền framework <a target="_blank"
                                                        href="https://getbootstrap.com/docs/4.6/">Bootstrap 4.6</a>,
                                                    custom lại bằng SCSS.</li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Các trang --}}
                                        <div>
                                            <span class="px-2 label label-primary">Các trang</span>
                                            <ol class="m-0">
                                                <li><a target="_blank" href="{{ route('home') }}">Layout</a> <i
                                                        class="mx-2 icon icon-check text-success"></i></li>
                                                <li><a target="_blank" href="{{ route('home') }}">Trang chủ</a><i
                                                        class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li><a target="_blank"
                                                        href="{{ route('post', 'ong-vuong-dinh-hue-tuyen-the-nham-chuc-chu-tich-quoc-hoi-khoa-xv-8520') }}">Chi
                                                        tiết tin</a><i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li><a target="_blank" href="{{ route('category', 'thoi-su') }}">Tin
                                                        trong loại</a><i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li><a target="_blank" href="{{ route('contact') }}">Liên hệ</a><i
                                                        class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Layout --}}
                                        <div>
                                            <a target="_blank" href="{{ route('home') }}"
                                                class="px-2 label label-primary">Layout</a>
                                            <ol class="m-0">
                                                <li>
                                                    Header, Footer, Menu, vùng thông tin sắp sắp hợp lý
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Custom màu sắc
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Menu có 2 cấp
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Header có logo, đồng hồ, thanh tìm kiếm
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Footer có thông tin cá nhân
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Trang chủ --}}
                                        <div>
                                            <a target="_blank" href="{{ route('home') }}"
                                                class="px-2 label label-primary">Trang chủ</a>
                                            <ol class="m-0">
                                                <li>
                                                    Hiện các tin nổi bật
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Tin mới nhất
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Tin xem nhiều.
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Trang chi tiết tin --}}
                                        <div>
                                            <a target="_blank"
                                                href="{{ route('post', 'ong-vuong-dinh-hue-tuyen-the-nham-chuc-chu-tich-quoc-hoi-khoa-xv-8520') }}"
                                                class="px-2 label label-primary">Trang chi tiết tin</a>
                                            <ol class="m-0">
                                                <li>
                                                    Hiện chi tiết nội dung tin
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Tiêu đề trong h1, tóm tắt trong h2.
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Định dạng nội dung <a target="_blank"
                                                        href="{{ route('post', 'ong-vuong-dinh-hue-tuyen-the-nham-chuc-chu-tich-quoc-hoi-khoa-xv-8520') }}">chi
                                                        tiết tin</a> với "font-size","line-height",...
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Hiện các ý kiến của tin
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Hiện form nhập ý kiến và lưu ý kiến
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                    <small>(Hiện form nhưng chưa lưu được!)</small>
                                                </li>
                                                <li>
                                                    Có nút like, share facebook
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                    <small>(Nút chưa thao tác được!)</small>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Trang tin trong loại --}}
                                        <div>
                                            <a target="_blank" href="{{ route('category', 'thoi-su') }}"
                                                class="px-2 label label-primary">Trang tin trong loại</a>
                                            <ol class="m-0">
                                                <li>
                                                    Sắp xếp các tin từ mới tới cũ
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Có phân trang, breadcrumb.
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Các tin phải có hình
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                                <li>
                                                    Các tin phải có hiện ngày đăng, số lần xem, số ý kiến
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="divider"></div>
                                        {{-- Trang tìm kiếm --}}
                                        <div>
                                            <span class="px-2 label label-primary">Trang tìm kiếm</span>
                                            <ol class="m-0">
                                                <li>
                                                    Tìm kiếm theo tiêu đề tin
                                                    <i class="mx-2 icon icon-check text-success"></i>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
