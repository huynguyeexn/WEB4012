@extends('layouts.admin')

@section('page-heading', 'Các thẻ tin tức')

@section('page-content')
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="p-4 card-body">
                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.users.deleted') }}" type="button" class="me-2 btn btn-outline-secondary">
                        <i class='bx bx-trash-alt'></i>
                        Thùng rác
                    </a>

                    <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-primary">
                        <i class='bx bx-plus'></i>
                        Thêm tài khoản mới
                    </a>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $data->links() }}
                    </div>
                </div>
                <table class="table p-2 table-striped" id="comment" style="width:100%">
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
                                        <img src="{{ asset($row->avatar) }}">
                                        <div class="text-start ms-2">
                                            <span class="font-bold"> {{ $row->name }}</span>
                                            @if ($row->is_admin)
                                                <span class="badge bg-primary">Admin</span>
                                            @endif
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
                                            <a href="{{ route('admin.users.edit', $row->id) }}" type="button"
                                                class="border-0 btn icon btn-outline-secondary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Chỉnh sửa">
                                                <i class='bx bx-edit-alt'></i>
                                            </a>
                                        </div>

                                        <form action="{{ route('admin.users.destroy', $row->id) }}" method="POST">
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
                <div class="row">
                    <div class="col-12">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end ">

                <button type="button" class="me-2 btn btn-outline-secondary">
                    <i class='bx bx-trash-alt'></i>
                    Thùng rác
                </button>
                <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-primary">
                    <i class='bx bx-plus'></i>
                    Thêm tài khoản mới
                </a>
            </div>
        </div>
    </div>
</section>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'
integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=='
crossorigin='anonymous'></script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        $('.btn-delete').on('click', function(e) {
            e.preventDefault();

            return Swal.fire({
                title: 'Bạn chắc chứ?',
                text: "Tài khoản của bạn sẽ được đưa vào thùng rác!",
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

    });
</script>
@endsection
