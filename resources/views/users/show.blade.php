@extends('layouts.app')

@section('home-section')
    <div class="container-xl">

        <div class="row align-items-center mb-5">
            <div class="col-md-3 text-center">
                <img src="{{ asset($user->profile_image) }}"
                    style="width: 150px; height: 150px; border-radius: 50%; border: 3px solid #00f2fe; object-fit: cover;">

                <div class="mt-3 text-white-50 small d-flex">
                    <div>Total Likes: <span class="text-info">{{ $user->total_likes }}</span></div>
                    <div class="mx-3">Followers: <span class="text-info"
                            id="follower-count">{{ $user->followers->count() }}</span></div>
                    <div>Following: <span class="text-info">{{ $user->followings->count() }}</span></div>
                </div>
            </div>
            <div class="col-md-9">
                <h2 style="color: #00f2fe;">{{ $user->username }}</h2>
                <p class="lead text-white">{{ $user->bio ?? 'No bio available.' }}</p>
            </div>
        </div>
        <div class="mt-3">
            @if(auth()->id() !== $user->id)
                <button
                    class="btn {{ auth()->user()->isFollowing($user->id) ? 'btn-outline-danger' : 'btn-info' }} fw-bold px-4"
                    data-id="{{ $user->id }}" id="follow-btn">
                    {{ auth()->user()->isFollowing($user->id) ? 'Unfollow' : 'Follow' }}
                </button>
            @endif
        </div>

        <hr style="border-color: rgba(0, 242, 254, 0.3);">
        <h3 class="text-center my-5" style="color: #00f2fe; text-transform: uppercase; letter-spacing: 2px;">Repositories
        </h3>

        <div class="row">
            @foreach($user->repositories as $repo)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="neon-card h-100 d-flex flex-column"
                        style="border-radius: 12px; overflow: hidden; background: rgba(13, 31, 45, 0.7); border: 1px solid rgba(0, 242, 254, 0.2);">

                        <div class="repo-thumb position-relative" style="height: 160px; overflow: hidden;">
                            <img src="{{ asset($repo->thumbnail ?? 'images/repoimg.jpg') }}"
                                class="w-100 h-100 object-fit-cover transition-all">

                            <div class="repo-overlay d-flex align-items-center justify-content-center">
                                <a href="{{ route('dashboard.show', $repo->id) }}"
                                    class="btn btn-info btn-sm fw-bold px-4 shadow-sm">
                                    <i class="bi bi-eye-fill me-1"></i> VIEW PROJECT
                                </a>
                            </div>
                        </div>

                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h5 class="text-white fw-bold mb-2">{{ $repo->title }}</h5>
                            <p class="text-white-50 small mb-3 flex-grow-1">
                                {{ Str::limit($repo->description, 60) }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary">
                                <div class="text-info small">
                                    <button class="btn-like border-0 bg-transparent" data-id="{{ $repo->id }}"
                                        style="cursor: pointer;">
                                        <i class="bi {{ auth()->user() && $repo->isLikedBy(auth()->user()) ? 'bi-heart-fill text-danger' : 'bi-heart text-info' }} fs-4"
                                            id="like-icon-{{ $repo->id }}"></i>
                                        <span class="text-white ms-1"
                                            id="like-count-{{ $repo->id }}">{{ $repo->likes->count() }}</span>
                                    </button>
                                    <i class="bi bi-chat-dots-fill ms-2 me-1"></i> {{ $repo->comments->count() }}
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    {{ $repo->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                        <div class="repo-overlay d-flex align-items-center justify-content-center">
                            <a href="{{ route('dashboard.show', $repo->id) }}" class="btn btn-info fw-bold px-4 py-2"
                                style="box-shadow: 0 0 15px rgba(0, 242, 254, 0.5); border-radius: 8px;">
                                <i class="bi bi-code-slash me-2"></i> VIEW PROJECT
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection