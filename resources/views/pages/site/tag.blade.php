@extends('layouts.main')

@section('page-title', $tag->name)

@section('main-content')
<div class="row">
    <div class="mb-2 col-12">
        <h3 class="text-blue-500 d-flex align-items-center">
            <i class='mr-2 bx bxs-star'></i>
            {{ $tag->name }}
        </h3>
    </div>
</div>
<hr>
<div class="mb-3 row row-cols-2 row-cols-md-3 row-cols-lg-4">
    @foreach ($posts as $item)

        <div class="mb-4 col">
            <x-card :props="$item->post" :hasImage="true" imageSize="200x100">

            </x-card>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-12">
        {{ $posts->links() }}
    </div>
</div>
@endsection
