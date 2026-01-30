@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-6">
                    <div class="search-container">
                        <i class="bi bi-search text-info"></i>
                        <input type="text" placeholder="Search for ideas...">
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($repositories as $repo)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="neon-card">
                            <div class="d-flex align-items-center">
                                <div class="profile-wrap">
                                    <img src="{{ asset($repo->user->profile_image) }}" class="user-img">
                                    <button class="plus-btn">+</button>
                                </div>
                                <span class="ms-3 text-white fw-bold">{{ $repo->user->username }}</span>
                            </div>

                            <a href="{{ route('dashboard.show', $repo->id) }}" class="repo-title-link">
                                {{ $repo->title }}
                            </a>

                            <div class="repo-frame">
                                <img src="{{ asset($repo->thumbnail ?? 'images/repoimg.jpg') }}" class="repo-img">
                            </div>

                            <div class="like-section d-flex align-items-center">
                                <div class="like-section d-flex align-items-center">
                                    @php $liked = $repo->likes->where('user_id', auth()->id())->count() > 0; @endphp
                                    <i class="bi bi-heart-fill {{ $liked ? 'like-active' : 'text-white' }}" id="mainLikeBtn"
                                        onclick="toggleMainLike(this)"></i>
                                    <span class="ms-2 fs-5" id="likeCount">{{ $repo->likes->count() }}</span>
                                </div>    
                                <i class="bi bi-chat-dots"></i>
                            </div>

                            <div class="comments-box">
                                @foreach($repo->comments->where('parent_id', null)->take(2) as $comment)
                                    <div class="mb-2">
                                        <span class="c-user">{{ $comment->user->username }}:</span>
                                        <span class="text-white-50">{{ $comment->comment_text }}</span>
                                    </div>

                                    @foreach($repo->comments->where('parent_id', $comment->id) as $reply)
                                        <div class="reply-line mb-1">
                                            <span class="c-user">{{ $reply->user->username }}:</span>
                                            <span class="text-white-50">{{ $reply->comment_text }}</span>
                                        </div>
                                    @endforeach
                                @endforeach
                                <button class="btn btn-link btn-sm text-info p-0 mt-1"
                                    style="text-decoration:none; font-size:11px;">
                                    Show more comments...
                                </button>
                            </div>

                            <div class="mt-3">
                                <p class="text-white-50 small mb-3">{{ Str::limit($repo->description, 80) }}</p>
                                <a href="{{ route('dashboard.show', $repo->id) }}"
                                    class="btn btn-outline-info btn-sm w-100 fw-bold">
                                    View Project Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <script>
        function toggleMainLike(el) {
            let countEl = document.getElementById('likeCount');
            let currentCount = parseInt(countEl.innerText);

            if (el.classList.contains('text-white')) {
                el.classList.remove('text-white');
                el.classList.add('like-active');
                countEl.innerText = currentCount + 1;
            } else {
                el.classList.remove('like-active');
                el.classList.add('text-white');
                countEl.innerText = currentCount - 1;
            }
        }
    </script>
@endsection