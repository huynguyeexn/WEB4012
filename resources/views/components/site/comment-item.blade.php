<hr>
<div class="media m-b-20">
    <div class="mr-3 d-flex">
        <a href="#"> <img class="media-object rounded-circle thumb-sm" alt="64x64"
                onerror="this.src='{{ asset('assets/images/unknown-person-icon.jpg') }}'"
                src="{{ $comment->user->avatar }}">
        </a>
    </div>
    <div class="media-body">
        <div class="d-flex justify-content-between">
            <strong class="mt-0">{{ $comment->user->name }}</strong>
            <span class="text-muted">{{ \Carbon\Carbon::parse($comment->date)->diffForHumans() }}</span>
        </div>
        <p class="mb-0 font-13 ">
            {{ $comment->content }}
        </p>
        <a href="" class="mr-2 text-primary font-13"><i class='mr-1 bx bx-like'></i>{{ $comment->like }} Thích</a>
    </div>
</div>
