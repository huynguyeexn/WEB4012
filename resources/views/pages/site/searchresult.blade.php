@extends('layouts.main')

@section('main-content')
    <div class="row">
        <div class="col-12 mb-2">
            <h3 class="text-blue-500 d-flex align-items-center">
                <i class='bx bxs-star mr-2'></i>
                <strong>
                    Kết quả tìm kiếm cho: "{{ $query }}"
                </strong>
            </h3>
        </div>

    </div>
    <hr>
    @if (count($posts) < 1)
        <div class="my-4 text-center">
            <h4 class="">Không tìm thấy tin nào.</h4>
            <a class="btn btn-primary" href="{{ route('home') }}">Về trang chủ</a>
        </div>
    @else
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 mb-3">
            @foreach ($posts as $item)
                <div class="col mb-4">
                    <x-card :props="$item" :hasImage="true" imageSize="200x100">

                    </x-card>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                {{ $posts->links() }}
            </div>
        </div>
    @endif
@endsection
