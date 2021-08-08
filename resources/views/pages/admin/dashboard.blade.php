@extends('layouts.admin')

@section('page-heading', 'Admin Dashboard')

@section('page-content')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="px-3 card-body py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="font-semibold text-muted">Số danh mục</h6>
                                    <h6 class="mb-0 font-extrabold">
                                        {{ DB::table('categories')->count() }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="px-3 card-body py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="bx bx-detail"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="font-semibold text-muted">Số tin tức<h6>
                                            <h6 class="mb-0 font-extrabold">
                                                {{ DB::table('posts')->count() }}
                                            </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="px-3 card-body py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="font-semibold text-muted">Lượt truy cập</h6>
                                    <h6 class="mb-0 font-extrabold">
                                        123
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Visit</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tin tức xem nhiều</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Tiêu đề</th>
                                            <th>Ngày đăng</th>
                                            <th>Lượt xem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (DB::table('posts')->orderBy('views', 'desc')->take(10)->get() as $row)

                                        <tr>
                                            <td class="col-auto">
                                                <div class="d-flex align-items-center">
                                                <div class="avatar avatar-lg">
                                                        <img src="{{ url('resizes/400x200/' . $row->thumb) }}" onerror="this.src=`http://placehold.jp/99ccff/003366/{{ '400x200' }}.png?text={{ $row->title }}`">
                                                    </div>
                                                    <p class="ms-3 mb-0 font-bold">{{ $row->title }}</p>
                                                </div>
                                            </td>
                                            <td class="col-2">
                                                <p class="mb-0 ">{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y'); }}</p>
                                            </td>
                                            <td class="col-2">
                                                <p class="mb-0 ">{{ $row->views }}</p>
                                            </td>
                                        </tr>
                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="px-4 py-4 card-body">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="avatar avatar-xl">
                            <img src="{{ Auth::user()->avatar }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="m-0 font-bold">{{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card">
                <div class="card-header">
                    <h4>Recent Messages</h4>
                </div>
                <div class="pb-4 card-content">
                    <div class="px-4 py-3 recent-message d-flex">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('assets/admin/images/faces/4.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Hank Schrader</h5>
                            <h6 class="mb-0 text-muted">@johnducky</h6>
                        </div>
                    </div>
                    <div class="px-4 py-3 recent-message d-flex">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('assets/admin/images/faces/5.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Dean Winchester</h5>
                            <h6 class="mb-0 text-muted">@imdean</h6>
                        </div>
                    </div>
                    <div class="px-4 py-3 recent-message d-flex">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('assets/admin/images/faces/1.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">John Dodol</h5>
                            <h6 class="mb-0 text-muted">@dodoljohn</h6>
                        </div>
                    </div>
                    <div class="px-4">
                        <button class='mt-3 font-bold btn btn-block btn-xl btn-light-primary'>Start
                            Conversation</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Visitors Profile</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                </div>
            </div> --}}
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script defer src="{{ asset('assets/admin/js/pages/dashboard.js') }}"></script>

    <script defer src="{{ asset('assets/admin/js/main.js') }}"></script>

    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endsection
