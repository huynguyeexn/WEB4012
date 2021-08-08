<!DOCTYPE html>
<html lang="vi">

<head>
    <base href="{{ asset('/') }}">

    <meta charset="utf-8" />

    @hasSection('page-title')
        <title>@yield('page-title') | THE NEWS - Made by HUi</title>
    @else
        <title>THE NEWS - Made by HUi</title>
    @endif

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Font awesome -->
    <link rel='stylesheet' rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"
        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css'
        integrity='sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=='
        crossorigin='anonymous' />
    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>


    <!-- Toastr -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">

    {{-- <script src="{{ asset('assets/js/modernizr.min.js') }}"></script> --}}
</head>

<body>
    {{-- <div id="baocao">
        <a href="{{ route('baocao') }}">Báo cáo</a>
    </div> --}}
    <!-- Navigation Bar-->
    <x-top-nav-bar></x-top-nav-bar>
    <!-- End Navigation Bar-->


    <div class="wrapper">
        <div class="container">

            @if (isset($title))
                <!-- Page-Title -->
                <x-page-title :title="$title" />
                <!-- end page title end breadcrumb -->
            @endif

            @yield('main-content')

        </div> <!-- end container -->


        <!-- Right Sidebar -->
        <x-side-bar></x-side-bar>
        <!-- /Right-bar -->

    </div>
    <!-- end wrapper -->


    <!-- Footer -->
    <x-footer></x-footer>
    <!-- End Footer -->

</body>


<!-- jQuery  -->
<script defer src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script defer src="{{ asset('assets/js/popper.min.js') }}"></script>
<script defer src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/vi.min.js"
integrity="sha512-LvYVj/X6QpABcaqJBqgfOkSjuXv81bLz+rpz0BQoEbamtLkUF2xhPNwtI/xrokAuaNEQAMMA1/YhbeykYzNKWg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

{!! Toastr::message() !!}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function startTime() {
            moment.lang('vi');
            document.getElementById('clock').innerHTML = moment().format("dddd, DD/MM/YYYY HH:mm:ss");;
            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
        startTime();

        let list = document.querySelectorAll('img');

        list.forEach(el => {
            if (el.dataset.src !== undefined) {
                el.src = el.dataset.src;
            };
        });
    });
</script>

</html>
