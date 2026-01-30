@extends('layouts.app')

@section('content')
<style>
    .show-container {
        margin-left: 240px;
        background: #081b29;
        min-height: 100vh;
        padding: 50px;
        color: white;
    }
    .repo-header {
        border-bottom: 1px solid rgba(0, 242, 254, 0.3);
        padding-bottom: 20px;
        margin-bottom: 30px;
    }
  
    .path-display {
        background: #0d1b2a;
        border: 2px solid #00f2fe;
        border-radius: 15px;
        padding: 25px;
        font-family: 'Courier New', Courier, monospace;
        box-shadow: 0 0 20px rgba(0, 242, 254, 0.1);
        margin-bottom: 30px;
    }
    .path-text { color: #00f2fe; font-size: 1.2rem; }
    
    .like-section i { cursor: pointer; font-size: 24px; transition: 0.3s; }
    .like-active { color: #ff4d4d; filter: drop-shadow(0 0 8px #ff4d4d); }
    
    .comment-list {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 20px;
    }
</style>

<div class="show-container">
    <div class="repo-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div style="position: relative;">
                <img src="{{ asset($repo->user->profile_image) }}" style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid #00f2fe;">
                <button style="position: absolute; bottom: 0; right: 0; background: #00f2fe; border: none; border-radius: 50%; width: 20px; height: 20px; font-weight: bold;">+</button>
            </div>
            <div class="ms-4">
                <h2 style="color: #00f2fe; margin: 0;">{{ $repo->title }}</h2>
                <span class="text-white-50">by {{ $repo->user->username }}</span>
            </div>
        </div>
        
        <div class="like-section d-flex align-items-center">
            @php $liked = $repo->likes->where('user_id', auth()->id())->count() > 0; @endphp
            <i class="bi bi-heart-fill {{ $liked ? 'like-active' : 'text-white' }}" id="mainLikeBtn" onclick="toggleMainLike(this)"></i>
            <span class="ms-2 fs-5" id="likeCount">{{ $repo->likes->count() }}</span>
        </div>
    </div>

    <div class="path-display">
        <div class="mb-2 text-white-50 small text-uppercase">Project Root Path:</div>
        <div class="path-text">
            <i class="bi bi-folder2-open me-2"></i> {{ $repo->repo_path }}
        </div>
    </div>

    <div class="description-box mb-5">
        <h4 style="color: #00f2fe;">About Project</h4>
        <p class="lead text-white-70">{{ $repo->description }}</p>
    </div>

    <div class="comment-list">
        <h5 class="mb-4"><i class="bi bi-chat-left-text me-2"></i> comme>
        @foreach($repo->comments as $comment)
            <div class="mb-3 p-2 border-bottom border-secondary">
                <strong style="color: #00f2fe;">{{ $comment->user->username }}:</strong> 
                <span class="ms-2">{{ $comment->comment_text }}</span>
            </div>
        @endforeach
        
        <div class="mt-4">
            <input type="text" class="form-control bg-dark text-white border-info" placeholder="Write a comment...">
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