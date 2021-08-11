<header id="topnav">
    <div class="container">
        <div class="topbar-main">

            <!-- Logo container-->
            <div class="d-flex flex-lg-row flex-column align-items-center">
                <!-- Text Logo -->
                <a href="{{ route('home') }}" class=" logo">
                    <span class="logo-large">THE NEWS</span>
                </a>
                <span class="mx-2 d-none d-lg-block">|</span>
                <p class="mb-0 text-uppercase" id="clock">{{ \Carbon\Carbon::now()->translatedFormat('l, d/m/Y') }}
                </p>
            </div>
            <!-- End Logo container-->

            <div class="menu-extras topbar-custom d-flex align-items-center">

                <ul class="mb-0 list-unstyled topbar-right-menu">

                    <li class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                    <li class="hide-phone">
                        <form id="search-form" action="{{ route('search') }}" method="GET">
                            <input name="query" type="search" placeholder="Search">
                        </form>
                    </li>

                    @auth
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <img onerror="this.src='{{ asset('assets/images/unknown-person-icon.jpg') }}'"
                                    src="{{ Auth::user()->avatar }}" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                                @if (Auth::user()->is_admin || Auth::user()->is_root)
                                    <!-- item-->
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item notify-item">
                                        <i class='mr-2 bx bx-customize'></i> Trang quản trị
                                    </a>
                                @endif

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class='mr-2 bx bx-user'></i> Tài khoản
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class='mr-2 bx bx-wrench'></i> Cài đặt
                                </a>

                                <!-- item-->
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                                    <i class='mr-2 bx bx-log-out'></i> Đăng xuất
                                </a>

                            </div>
                        </li>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" type="button"
                            class="mx-2 btn btn-primary btn-rounded waves-effect waves-light" data-html="true"
                            title="Đăng nhập">
                            <i class="fas fa-user-alt "></i>
                        </a>
                    @endguest
                </ul>
            </div>
            <!-- end menu-extras -->


        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu  {{ request()->is('trang-chu') ? 'active' : '' }}">
                        <a href="{{ route('home') }}"><span>Trang chủ</span> </a>
                    </li>
                    @foreach ($menuList as $menu)
                        @if (count($menu->children) > 0)
                            <li
                                class="has-submenu  {{ request()->is('chuyen-muc/' . $menu->slug . '*') ? 'active' : '' }}">
                                <a href="{{ route('category', $menu->slug) }}"><span> {{ $menu->name }} </span> <i
                                        class='bx bx-caret-down'></i> </a>
                                <ul class="submenu megamenu">
                                    @foreach ($menu->children as $children)
                                        <li><a
                                                href="{{ route('category', $children->slug) }}">{{ $children->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="has-submenu">
                                <a href="{{ route('category', $menu->slug) }}"><span>{{ $menu->name }} </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <!-- End navigation menu -->
            </div> <!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>
