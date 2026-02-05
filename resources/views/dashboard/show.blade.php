@extends('layouts.app')

@section('home-section')
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

        .path-text {
            color: #00f2fe;
            font-size: 1.2rem;
        }

        .like-section i {
            cursor: pointer;
            font-size: 24px;
            transition: 0.3s;
        }

        .like-active {
            color: #ff4d4d !important;
            filter: drop-shadow(0 0 8px #ff4d4d);
        }

        .user-stats {
            background: rgba(0, 242, 254, 0.1);
            border: 1px solid #00f2fe;
            padding: 2px 8px;
            border-radius: 5px;
            font-size: 0.75rem;
            color: #00f2fe;
        }

        .neon-input {
            background-color: rgba(0, 0, 0, 0.3) !important;

            border: 1px solid rgba(0, 242, 254, 0.5) !important;

            color: white !important;

            transition: all 0.3s ease;
        }

        .neon-input:focus {
            background-color: rgba(0, 0, 0, 0.5) !important;
            border-color: #00f2fe !important;
            box-shadow: 0 0 10px rgba(0, 242, 254, 0.5) !important;
            outline: none;
        }


        .neon-input::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
            font-style: italic;
        }
    </style>

    <div class="show-container">
        <div class="repo-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div style="position: relative;">
                    <img src="{{ asset($repo->user->profile_image) }}"
                        style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid #00f2fe; object-fit: cover;">
                </div>
                <div class="ms-4">
                    <h2 style="color: #00f2fe; margin: 0;">{{ $repo->title }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="text-white-50 me-2">by {{ $repo->user->username }}</span>
                        <span class="user-stats">Total Likes: {{ $repo->user->totalLikes->count() }}</span>
                    </div>
                </div>
                <div style="position: relative;" class="ms-4">
                    @if(auth()->id() !== $user->id)
                        <button
                            class="btn {{ auth()->user()->isFollowing($user->id) ? 'btn-outline-danger' : 'btn-info' }} fw-bold px-4"
                            data-id="{{ $user->id }}" id="follow-btn">
                            {{ auth()->user()->isFollowing($user->id) ? 'Unfollow' : 'Follow' }}
                        </button>
                    @endif
                </div>
            </div>
            <div>
                <button class="btn-like border-0 bg-transparent" data-id="{{ $repo->id }}" style="cursor: pointer;">
                    <i class="bi {{ auth()->user() && $repo->isLikedBy(auth()->user()) ? 'bi-heart-fill text-danger' : 'bi-heart text-info' }} fs-4"
                        id="like-icon-{{ $repo->id }}"></i>
                    <span class="text-white ms-1" id="like-count-{{ $repo->id }}">{{ $repo->likes->count() }}</span>
                </button>
            </div>
        </div>



        <div class="path-display">
            <div class="mb-2 text-white-50 small text-uppercase">Project Root Path:</div>
            <div class="path-text">
                <i class="bi bi-folder2-open me-2"></i> {{ asset($repo->repo_path) }}
            </div>
        </div>

        <div class="description-box mb-3">
            <h4 style="color: #00f2fe;">About Project</h4>
            <p class="lead text-white-70" style="line-height: 1.8;">{{ $repo->description }}</p>
        </div>

        <div class="" style="max-width: 300px;">
            <h3 style="color: #00f2fe;">Comments ({{ $repo->comments->count() }})</h3>

            <form action="{{ route('comment.store', $repo->id) }}" method="POST" class="mb-4">
                @csrf
                <textarea name="content" class="form-control neon-input" rows="3" placeholder="Write a comment..."
                    required></textarea>
                <button type="submit" class="btn btn-info btn-sm mt-2 fw-bold">Post Comment</button>
            </form>

            @foreach($repo->comments as $comment)
                <div class="neon-card p-3 mb-3" style="border-left: 3px solid #00f2fe;">
                    <a href="{{ route('users.show', $user->id) }}" class="">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset($comment->user->profile_image) }}"
                                style="width: 30px; height: 30px; border-radius: 50%;">
                            <strong class="ms-2 text-white">{{ $comment->user->username }}</strong>
                            <small class="ms-auto text-white-50">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="text-white mb-0">{{ $comment->content }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection