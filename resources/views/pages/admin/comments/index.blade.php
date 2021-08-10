@extends('layouts.admin')

@section('page-heading', 'Các thẻ tin tức')

@section('page-content')
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="p-4 card-body">
                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.comments.deleted') }}" type="button"
                        class="me-2 btn btn-outline-secondary">
                        <i class='bx bx-trash-alt'></i>
                        Thùng rác
                    </a>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $data->links() }}
                    </div>
                </div>
                <table class="table p-2 table-striped" id="comment" style="width:100%">
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>
                                    <div class="avatar avatar-md">
                                        <img src="{{ $row->user->avatar }}">
                                    </div>
                                </td>
                                <td class="col-auto">
                                    <p class="mb-0">
                                        <span class="font-bold"> {{ $row->user->name }}</span>
                                        <small>{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}</small>
                                    </p>
                                    <figure class="mb-0 ">
                                        <blockquote>
                                            <p>{{ $row->content }}</p>
                                        </blockquote>
                                        <figcaption class="mb-0 blockquote-footer text-muted">
                                            Bài viết:
                                            @if ($row->post->trashed())
                                                <span>Đã bị xóa</span>
                                            @else
                                                <a
                                                    href="{{ route('post', $row->post->slug) }}">{{ $row->post->title }}</a>
                                            @endif
                                        </figcaption>
                                    </figure>
                                </td>
                                {{-- <td class="text-center">
                                    <p class="p-0 m-0">{{ \Carbon\Carbon::parse($row->updated_at) }}</p>
                                    <small>{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}</small>
                                </td> --}}

                                <td class="text-center">
                                    <div class="mb-3 btn-group" role="group" aria-label="Basic example">
                                        <form action="{{ route('admin.comments.destroy', $row->id) }}" method="POST">
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

    });
</script>
@endsection
