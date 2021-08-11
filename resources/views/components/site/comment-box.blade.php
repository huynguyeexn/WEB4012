<div class="p-4 shadow-md card">
    <h4 class="m-t-0 m-b-30">Ý kiến ({{ count($comments) }})</h4>
    <div id="comment-box">
        {{-- @{{ message }} --}}
        @auth
            <div class="media m-b-20">
                <div class="mr-3 d-flex">
                    <a href="#"> <img class="media-object rounded-circle thumb-sm" alt="User avatar"
                            onerror="this.src='{{ asset('assets/images/unknown-person-icon.jpg') }}'"
                            src="{{ Auth::user()->avatar }}"> </a>
                </div>
                <div class="media-body">
                    <form action="" method="POST">
                        @csrf
                        @honeypot
                        <div class="form-group">
                            <label for="content">Ý kiến của bạn:</label>
                            <textarea name="content" class="form-control" rows="5"
                                placeholder="Để lại ý kiến của bạn về bài viết này tại đây..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect w-md waves-light">Gửi ý kiến</button>
                    </form>
                </div>
            </div>
        @else
            <p>Vui lòng <a class="text-primary" href="{{ route('login') }}">đăng nhập</a> để có thể bình luận</p>
        @endauth
        @foreach ($comments as $cmt)
            <x-comment-item :data="$cmt"></x-comment-item>
        @endforeach
    </div>
</div>
