<div id="carousel" class="carousel slide {{ $class }}" data-ride="carousel" data-interval="7000">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($list); $i++)
            <li data-target="#carousel" data-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}">
            </li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @php
            $index = 0;
        @endphp
        @foreach ($list as $item)
            <div class="carousel-item {{ $index++ === 0 ? 'active' : '' }}">
                <img onerror="this.src=`https://placehold.jp/99ccff/003366/{{ $imageSize }}.png?text={{ $item->title }}`"
                    src="{{ url("resizes/$imageSize/" . $item->thumb) }}" class="d-block w-100"
                    alt="{{ $item->slug }}">
                <div class="carousel-caption d-none d-md-block">
                    <h4>
                        <a href="{{ route('post', $item->slug) }}">{{ $item->title }}</a>
                    </h4>
                    <p>{{ $item->desc }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
