@extends('layouts.main')

@section('page-title', $post->title . ' - ' . $post->category->name)

@section('title', $post->title)
@section('thumb', $post->thumb ?: '')
@section('desc', $post->desc)

@section('main-content')
<div class="row" id="post-content">
<div class="col-12">

<div class="p-4 shadow-md card w-100">
<div class="card-body">
    <a href="{{ route('category', $post->category->slug) }}">
        <span class="badge badge-primary">
            {{ $post->category->name }}
        </span>
    </a>

    <div class="row">
        <div class="p-0 mt-2 col-12">
            <div style="margin-right: -10px;">
                <div id="fb-root"></div>
                <script crossorigin="anonymous"
                                src="https://connect.facebook.net/vi_VI/sdk.js#xfbml=1&version=v11.0&appId=514561729797082&autoLogAppEvents=1"
                                nonce="ssfJCeQD">
                </script>
                <div class="fb-like" data-href="{{ url()->full() }}" data-width=""
                    data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
            </div>

        </div>
    </div>
    <p class="my-2 text-muted">
        Đăng ngày: {{ \Carbon\Carbon::create($post->date)->format('d-m-Y H:i:s') }}
        |
        <i class="mr-1 fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
    </p>
    {{-- <p>
        <button class="btn btn-danger waves-effect"> <i class="fa fa-heart m-r-5"></i>
            <span> {{ $post->like }}</span> </button>
    </p> --}}
    <h1>
        {{ $post->title }}
    </h1>
    <div class="row">
        <div class="col-12">
            <h2 class="h4">
                {{ $post->desc }}
            </h2>
        </div>
    </div>
    <div class="my-4 row">
        <div class="col-12">
            <img src="{{ fullSizeImage($post->thumb) }}" alt="{{ $post->title }}" class="w-100">
        </div>
    </div>
    <div class="row content">
        <div class="col-12">
            {!! $post->content !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <span>Thẻ: </span>
            @foreach ($post->tagsOfPost as $tag)
                @if ($tag->tag->name !== '')
                    <a href="{{ route('tag', $tag->tag->slug) }}"
                        class="badge badge-primary">#{{ $tag->tag->name }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="my-4 row">
<div class="col-12">
<x-comment-box id="{{ $post->id }}"></x-comment-box>
</div>
</div>
<div class="my-4 row">
<div class="col-12">
<hr>
<div class="row">
<div class="col-12">
    <h3 class="text-primary d-flex align-items-center">
        <i class='mr-2 bx bxs-star'></i> <strong>Tin liên quan</strong>
    </h3>
</div>
</div>
<div class="mb-2 row row-cols-2 row-cols-md-3 row-cols-lg-5">
@foreach ($related as $item)
    <div class="mb-4 col">
        <x-card :props="$item" :hasImage="true" imageSize="200x100">
            <a href="{{ route('category', $item->category->slug) }}">
                <small class="text-muted">{{ $item->category->name }}</small>
            </a>
            <small class="text-muted"> - </small>
            <small class="text-muted">Last updated 3 mins ago</small>
        </x-card>
    </div>
@endforeach
</div>
</div>
</div>
@endsection
