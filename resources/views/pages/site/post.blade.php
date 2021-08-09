@extends('layouts.main')

@section('page-title', $post->title . ' - ' . $post->category->name)

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
                <p class="my-2 text-muted">
                    Đăng ngày: {{ \Carbon\Carbon::create($post->date)->format('d-m-Y H:i:s') }}
                    |
                    <i class="mr-1 fa fa-eye" aria-hidden="true"></i> {{ $post->views }}
                </p>
                <h1>
                    {{ $post->title }}
                </h1>
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-danger waves-effect m-b-5"> <i class="fa fa-heart m-r-5"></i>
                            <span> {{ $post->like }}</span> </button>

                        <button class="bg-blue-600 btn btn-primary waves-effect m-b-5"><i class="fa fa-share m-r-5"></i>
                            <span>Facebook </span> </button>
                    </div>
                </div>
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
