@extends('layouts.main')

@section('page-title', $child->name ?? $parent->name)

@section('main-content')
    <div class="row">
        {{-- Breadcrums --}}
        <div class="mb-2 col-12">
            <h3 class="text-blue-500 d-flex align-items-center">
                <i class='mr-2 bx bxs-star'></i>
                <strong>
                    @if ($child === null)
                        {{ Breadcrumbs::render('catParent', $parent) }}
                    @else
                        {{ Breadcrumbs::render('catChild', $parent, $child) }}
                    @endif
                </strong>
            </h3>
        </div>

        {{-- Other category --}}
        <div class="col-12">
            {{-- <div class="btn-group btn-group-justified m-b-10"> --}}
            @foreach ($otherCat as $cat)
                <a class="btn btn-outline-primary waves-effect waves-primary w-md m-b-5" role="button"
                    href="{{ route('category', $cat->slug) }}">{{ $cat->name }}</a>
            @endforeach
            {{-- </div> --}}
        </div>
    </div>
    <hr>
    <div class="mb-3 row row-cols-2 row-cols-md-3 row-cols-lg-4">
        @foreach ($posts as $item)
            <div class="mb-4 col">
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
@endsection
