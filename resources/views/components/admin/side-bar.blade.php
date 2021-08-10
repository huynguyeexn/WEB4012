<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('home') }}">THE NEWS</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="fas fa-th-large "></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}" class='sidebar-link'>
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>Danh mục</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/posts*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}" class='sidebar-link'>
                        <i class='bx bx-detail'></i>
                        <span>Tin tức</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/tags*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tags.index') }}" class='sidebar-link'>
                        <i class='bx bx-purchase-tag-alt'></i>
                        <span>Thẻ</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/comments*') ? 'active' : '' }}">
                    <a href="{{ route('admin.comments.index') }}" class='sidebar-link'>
                        <i class='bx bx-comment-dots'></i>
                        <span>Ý kiến</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class='sidebar-link'>
                        <i class='bx bx-user'></i>
                        <span>Tài khoản</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
