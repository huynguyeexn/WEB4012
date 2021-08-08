@extends('layouts.admin')

@section('page-heading', 'Các tin tức')

@section('page-content')
    <section class="row">
        <div class="col-12">
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('admin.posts.index') }}" type="button" class="me-2 btn btn-outline-secondary">
                    <i class='bx bx-arrow-back'></i>
                    Quay về
                </a>

            </div>
            <div class="row row-cols-3">
                @foreach ($data as $row)
                    <div class="p-2 col">
                        <div class="card">
                            <div class="p-0 card-body">
                                <img class="card-img-top img-fluid" data-src="{{ url('resizes/400x200/' . $row->thumb) }}"
                                    onerror="this.src=`http://placehold.jp/99ccff/003366/{{ '400x200' }}.png?text={{ $row->title }}`"
                                    alt="{{ $row->title }}"
                                    style="width: 100%; min-height: 200px; background-color: #ddd">
                                <div class="card-body">
                                    <a href="{{ route('post', $row->slug) }}">
                                        <h5 class="card-title">{{ $row->title }}</h5>
                                    </a>
                                    <p class="card-text">
                                        {{ $row->desc }}
                                    </p>
                                </div>
                            </div>
                            <div class="border-0 card-footer d-flex justify-content-end">

                                <a href="{{ route('admin.posts.restore', $row->id) }}" type="button"
                                    class="btn icon btn-outline-secondary me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Khôi phục">
                                    <i class='bx bx-archive-out'></i>
                                </a>

                                <form action="{{ route('admin.posts.remove', $row->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn icon btn-outline-danger btn-delete"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa khỏi thùng rác">
                                        <i class='bx bx-trash-alt'></i></button>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="text-center col-12">
                    <p>Đang xem {{ $paginate->perpage * ($paginate->page - 1) }} đến
                        {{ $paginate->perpage * $paginate->page }} trong tổng số
                        {{ $paginate->total }}
                        mục</p>
                </div>
                <div class="col-12">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </section>

    <style>
        thead input {
            width: 100%;
        }

    </style>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'
        integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=='
        crossorigin='anonymous'></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/sb-1.1.0/sp-1.3.0/datatables.min.css" />

    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/sb-1.1.0/sp-1.3.0/datatables.min.js"></script>



    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();

                return Swal.fire({
                    title: 'Bạn chắc chứ?',
                    text: "Thao tác này sẽ không thể hoàn tác!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    cancelButtonText: 'Có, xóa đi!',
                    confirmButtonText: 'Hủy bỏ',
                }).then((result) => {
                    if (result.isDismissed) {
                        return $(this).parent().submit();
                    }
                })
            })

            // Setup - add a text input to each footer cell
            // $('#danhmuc thead tr').clone(true).appendTo('#danhmuc thead');
            // $('#danhmuc thead tr:eq(1) th').each(function(i) {
            //     var title = $(this).text();

            //     if (title) {

            //         $(this).html(
            //             '<input type="text" class="form-control form-control-sm" placeholder="Lọc theo ' +
            //             title + '" />');
            //     }

            //     $('input', this).on('keyup change', function() {
            //         if (table.column(i).search() !== this.value) {
            //             table
            //                 .column(i)
            //                 .search(this.value)
            //                 .draw();
            //         }
            //     });
            // });

            // var table = $('#danhmuc').DataTable({
            //     orderCellsTop: true,
            //     fixedHeader: true,
            //     language: {
            //         url: 'http://cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            //     },
            //     "order": [
            //         [4, "desc"]
            //     ]
            // });
        });
    </script>
@endsection
