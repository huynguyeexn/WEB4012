<div class="accordion w-100" id="cat-side-bar">
    @foreach ($categories as $cat)
        <div class="card bg-white border-primary ">
            <div class="card-header bg-white" id="cat-side-bar-heading-{{ $cat->id }}">
                <h2 class="m-0">
                    <a href="{{ route('category', $cat->slug) }}"
                        class="btn btn-block text-left font-bold p-0 text-primary" type="button" data-toggle="collapse"
                        data-target="#cat-side-bar-{{ $cat->id }}" aria-expanded="false"
                        aria-controls="cat-side-bar-{{ $cat->id }}">
                        {{ $cat->name }}
                        <i class="fa fa-angle-down"></i>
                    </a>
                </h2>
            </div>

            <div id="cat-side-bar-{{ $cat->id }}" class="collapse "
                aria-labelledby="cat-side-bar-heading-{{ $cat->id }}" data-parent="#cat-side-bar">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($cat->children as $child)
                            <li class="list-group-item">
                                <a href="{{ route('category', $child->slug) }}">{{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    @endforeach

</div>
