@extends('layouts.admin')

@section('page-heading', 'Thùng rác tài khoản')

@section('page-content')
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="p-4 card-body">
                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.users.index') }}" type="button" class="me-2 btn btn-outline-secondary">
                        <i class='bx bx-arrow-back'></i>
                        Quay về
                    </a>
                </div>
                <table class="table p-2 table-striped" id="the" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center"></th>
                            <th class="text-center">Số bình luận</th>
                            <th class="text-center">Tài khoản đã liên kết</th>
                            <th class="text-center">Cập nhật</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td class="text-center">#{{ $row->id }}</td>
                                <td class="col-auto">
                                    <div class="flex avatar avatar-md align-items-center">
                                        <img src="{{ $row->avatar }}">
                                        <div class="text-start ms-2">
                                            <span class="font-bold"> {{ $row->name }}</span>
                                            <p class="mb-0">
                                                {{ $row->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $row->countComments() }}
                                </td>
                                <td class="text-center">
                                    @foreach ($row->socialAccounts()->get() as $socialAcc)
                                        @if ($socialAcc->social_provider == 'google')
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1024px-Google_%22G%22_Logo.svg.png"
                                                alt="" height="24" width="24">
                                        @endif
                                    @endforeach
                                </td>

                                <td class="text-center">
                                    <small>{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}</small>
                                </td>

                                <td class="text-center">
                                    <div class="mb-3 btn-group" role="group" aria-label="Basic example">
                                        <div>
                                            <a href="{{ route('admin.users.restore', $row->id) }}" type="button"
                                                class="border-0 btn icon btn-outline-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Khôi phục">
                                                <i class='bx bx-archive-out'></i>
                                            </a>
                                        </div>

                                        <form action="{{ route('admin.users.remove', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="border-0 btn icon btn-outline-danger btn-delete"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Xóa khỏi thùng rác">
                                                <i class='bx bx-trash-alt'></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end ">
                <a href="{{ route('admin.users.index') }}" type="button" class="me-2 btn btn-outline-secondary">
                    <i class='bx bx-arrow-back'></i>
                    Quay về
                </a>
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
        $('#the thead tr').clone(true).appendTo('#the thead');
        $('#the thead tr:eq(1) th').each(function(i) {
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

        var table = $('#the').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            },
            "order": [
                [4, "desc"]
            ]
        });
    });
</script>

@endsection
