@extends('layouts.main')

@section('main-content')
    <div class="row">
        <div class="col-12 col-md-8">
            {{-- CAROUSEL --}}
            <div class="row">
                <div class="col">
                    <x-carousel :carousel="$carousel" imageSize="600x350" class="shadow-md" />
                </div>
            </div>

            {{-- POPULAR --}}
            <div class="row row-cols-2 row-cols-lg-3">
                @foreach ($popular as $item)
                    <div class="col mt-4">
                        <x-card :props="$item" :hasImage="true" imageSize="200x100">
                            <a href="{{ route('category', $item->category->slug) }} }}">
                                <small class="text-muted">{{ $item->category->name }}</small>
                            </a>
                            <small class="text-muted"> - </small>
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </x-card>
                    </div>
                @endforeach
            </div>

            @foreach ($list as $catList)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-primary d-flex align-items-center">
                            <i class='bx bxs-star mr-2'></i> <strong>{{ Str::upper($catList['name']) }}</strong>
                        </h3>
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 mb-2">
                    @foreach ($catList['data'] as $item)
                        <div class="col  mb-4">
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
            @endforeach
        </div>

        {{-- RIGHT SIDE TAB --}}
        <div class="col-12 col-md-4 mt-4 mt-md-0">
            <div class="row">

                <nav>
                    <div class="nav nav-tabs" id="right-side-nav-tab" role="tablist">
                        @php
                            $index = 0;
                        @endphp
                        @foreach ($rightSide as $key => $value)
                            <a class="nav-link  {{ $index++ === 0 ? 'active' : '' }}" id="nav-home-tab" data-toggle="tab"
                                href="#right-side-{{ $key }}" role="tab"
                                aria-controls="right-side-{{ $key }}" aria-selected="true">
                                {{ $value['name'] }}
                            </a>
                        @endforeach
                    </div>
                </nav>
                <div class="tab-content p-0 border-0" id="right-side-tab">
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($rightSide as $key => $value)
                        <div class="tab-pane fade show {{ $index++ === 0 ? 'active' : '' }}"
                            id="right-side-{{ $key }}" role="tabpanel"
                            aria-labelledby="right-side-{{ $key }}">
                            @foreach ($value['data'] as $item)
                                <x-card :props="$item" :hasImage="false">
                                </x-card>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <hr class=" my-2">
            <div class="row">
                <div class="card w-100">
                    <div class="card-body">
                        <h3 class="text-primary d-flex align-items-center text-uppercase">
                            <i class="fa fa-bars mr-2" aria-hidden="true"></i> <strong>Chuyên mục khác</strong>
                        </h3>
                        <x-cat-side-bar />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
