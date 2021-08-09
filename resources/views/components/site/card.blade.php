@if ($type === 'horizontal')
    <div class="border-0 shadow-md card h-100 rounded-0">
        <div class="row h-100">
            <div class="col-md-5" style="overflow: hidden">
                <img onerror="this.src=`https://placehold.jp/99ccff/003366/{{ $imageSize }}.png?text={{ $props->title }}`"
                    data-src="{{ url('resizes/200x200/' . $props->thumb) }} }}" alt="{{ $props->title }}"
                    style="object-fit: cover; width: 100%; height: 100%; background-color: #ddd">
            </div>
            <div class="col-md-7">
                <small class="text-muted">
                    <a href="{{ route('category', $props->category->slug ?? '') }}">
                        {{ $props->category->name }}
                    </a>
                    - {{ \Carbon\Carbon::parse($props->date)->diffForHumans() }}
                </small>
                <h5 class="card-title">
                    <a href="{{ route('post', $props->slug) }}">
                        {{ $props->title }}
                    </a>
                </h5>
                @if ($hasDesc === true)
                    <p class="card-text">
                        {{ $props->desc }}
                    </p>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="border-0 shadow-md card h-100 rounded-0">
        @if ($hasImage === true)
            <img class=" rounded-0 card-img-top" data-src="{{ url("resizes/$imageSize/" . $props->thumb) }}"
                onerror="this.src=`https://placehold.jp/99ccff/003366/{{ $imageSize }}.png?text={{ $props->title }}`"
                alt="{{ $props->title }}" style="width: 100%; min-height: 100px; background-color: #ddd">
        @endif
        <div class="card-body">
            <small class="text-muted d-flex justify-content-between">
                <p class="m-0">{{ \Carbon\Carbon::parse($props->date)->diffForHumans() }}</p>
                <p class="m-0">
                    <span class="mr-2"><i class="mr-1 fa fa-eye" aria-hidden="true"></i>{{ $props->views }}</span>
                    <span class="mr-2"><i class="mr-1 fa fa-heart" aria-hidden="true"></i>{{ $props->like }}</span>
                </p>
            </small>

            <a class="my-2 text-primary d-inline-block" href="{{ route('category', $props->category->slug ?? '') }}">
                {{ $props->category->name }}
            </a>

            <h5 class="card-title">
                <a href="{{ route('post', $props->slug ?? '') }}">
                    {{ $props->title }}
                </a>
            </h5>
            @if ($hasDesc === true)
                <p class="card-text">
                    {{ $props->desc }}
                </p>
            @endif
        </div>
    </div>
@endif
