@extends('layouts.admin')

@section('page-heading', 'Các thẻ tin tức')

@section('page-content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="p-4 card-body">
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="{{ route('admin.tags.deleted') }}" type="button" class="me-2 btn btn-outline-secondary">
                            <i class='bx bx-trash-alt'></i>
                            Thùng rác
                        </a>
                        <a href="{{ route('admin.tags.create') }}" type="button" class="btn btn-primary">
                            <i class='bx bx-plus'></i>
                            Thêm thẻ mới
                        </a>
                    </div>
                    <table class="table p-2 table-striped" id="tag" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Tên thẻ</th>
                                <th class="text-center">Số bài viết</th>
                                <th class="text-center">Cập nhật</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td class="text-center">#{{ $row->id }}</td>

                                    </td>
                                    <td class="text-center">
                                        {{ $row->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $row->countPost() }}
                                    </td>
                                    <td class="text-center">
                                        <p class="p-0 m-0">{{ \Carbon\Carbon::parse($row->updated_at) }}</p>
                                        <small>{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}</small>
                                    </td>

                                    <td class="text-center">
                                        <div class="mb-3 btn-group" role="group" aria-label="Basic example">
                                            <div>

                                                <a href="{{ route('admin.tags.edit', $row->id) }}" type="button"
                                                    class="border-0 btn icon btn-outline-secondary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Chỉnh sửa">
                                                    <i class='bx bx-edit-alt'></i>
                                                </a>
                                            </div>

                                            <form action="{{ route('admin.tags.destroy', $row->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="border-0 btn icon btn-outline-danger btn-delete"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Cho vào thùng rác">
                                                    <i class='bx bx-trash-alt'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end ">

                    <button type="button" class="me-2 btn btn-outline-secondary">
                        <i class='bx bx-trash-alt'></i>
                        Thùng rác
                    </button>

                    <button type="button" class="btn btn-primary">
                        <i class='bx bx-plus'></i>
                        Thêm thẻ mới
                    </button>

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

            $.ajax({
                url: "http://127.0.0.1:8888/api/tags",
            }).done(function(data) {
                console.log(data);
            });


            $('.btn-delete').on('click', function(e) {
                e.preventDefault();

                return Swal.fire({
                    title: 'Bạn chắc chứ?',
                    text: "Các thẻ con và các bài viết cũng sẽ bị đưa vào thùng rác!",
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
            $('#tag thead tr').clone(true).appendTo('#tag thead');
            $('#tag thead tr:eq(1) th').each(function(i) {
                var title = $(this).text();

                if (title) {

                    $(this).html(
                        '<input type="text" class="form-control form-control-sm" placeholder="Lọc theo ' +
                        title + '" />');
                }

                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });

            var table = $('#tag').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                language: {
                    url: 'http://cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
                },
                "order": [
                    [4, "desc"]
                ]
            });
        });
    </script>
@endsection
