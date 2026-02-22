@extends('layouts.app')

@section('home-section')
    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .tab-item {
            text-align: center;
            transition: 0.3s;
            border-top: 2px solid transparent;
            padding-top: 10px;
            margin-top: -2px;
        }

        .active-tab {
            color: #0dcaf0 !important;
            border-top: 2px solid #0dcaf0;
        }

        .profile-content {
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    <div class="container-xl">
        <div class="row align-items-center mb-5">
            <div class="col-md-3 text-center">
                <img src="{{ asset('storage/' . $user->profile_image) }}"
                    style="width: 150px; height: 150px; border-radius: 50%; border: 3px solid #00f2fe; object-fit: cover;">

                <div class="mt-3 text-white-50 small d-flex">
                    <div>{{ __("app.Following") }} <span class="text-info">{{ $user->total_likes }}</span></div>
                    <a href="{{ route('profile.followers', $user->id) }}" class="mx-3 text-decoration-none">
                        <div class="mx-3 text-white-50">
                            <div class="mx-3">{{ __("app.Followers") }} <span class="text-info"
                                    id="follower-count">{{ $user->followers->count() }}</span></div>
                        </div>
                    </a>

                    <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none">
                        <div class="text-white-50">
                            <div>{{ __("app.Following") }} <span class="text-info">{{ $user->followings->count() }}</span></div>
                        </div>
                    </a>
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
            <button type="button" class="btn btn-danger fw-bold px-3 ms-3" data-bs-toggle="modal"
                data-bs-target="#reportModal" data-type="user" data-id="{{ $user->id }}">
                <i class="fas fa-user-slash"></i> {{ __("app.Report :") }}
            </button>
        </div>

        <div class="d-flex justify-content-center border-top border-secondary mt-5">
            <div class="d-flex gap-5 py-3">
                <div id="tab-repos" class="tab-item active-tab text-white cursor-pointer" onclick="switchTab('repos')">
                    <i class="bi bi-grid-3x3-gap fs-4"></i>
                    <span class="d-block small fw-bold">{{ __("app.REPOS") }}</span>
                </div>
                <div id="tab-posts" class="tab-item text-secondary cursor-pointer" onclick="switchTab('posts')">
                    <i class="bi bi-collection-play fs-4"></i>
                    <span class="d-block small fw-bold">{{ __("app.POSTS") }}</span>
                </div>
            </div>
        </div>

        <div id="content-repos" class="profile-content">
            <h3 class="text-center text-info mb-4">{{ __("app.REPOSITORIES") }}</h3>
            <div class="row">
                @foreach($repositories as $repo)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="neon-card h-100 d-flex flex-column"
                            style="border-radius: 12px; overflow: hidden; background: rgba(13, 31, 45, 0.7); border: 1px solid rgba(0, 242, 254, 0.2);">

                            <div class="repo-thumb position-relative" style="height: 160px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $repo->thumbnail) }}"
                                    class="w-100 h-100 object-fit-cover transition-all">

                                <div class="repo-overlay d-flex align-items-center justify-content-center">
                                    <a href="{{ route('dashboard.show', $repo->id) }}"
                                        class="btn btn-info btn-sm fw-bold px-4 shadow-sm">
                                        <i class="bi bi-eye-fill me-1"></i> {{ __("app.VIEW PROJECT") }}
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
                                <div class="mt-3">
                                    <a href="{{ route('dashboard.show', $repo->id) }}"
                                        class="btn btn-info fw-bold px-4 py-2 w-100 mb-2"
                                        style="box-shadow: 0 0 15px rgba(0, 242, 254, 0.5); border-radius: 8px;">
                                        <i class="bi bi-code-slash me-2"></i> {{ __("app.VIEW PROJECT") }}
                                    </a>
                                    <form action="{{ route('admin.repo.delete', $repo->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-link text-danger text-decoration-none btn-sm w-100 fw-bold">
                                            <i class="bi bi-trash3 me-1"></i> {{ __("app.Delete Repository") }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="content-posts" class="profile-content d-none">
            <h3 class="text-center text-info mb-4">{{ __("app.POSTS") }}</h3>
            <div class="row">
                @foreach($posts as $post)

                    <div class="col-md-8 col-lg-6">
                        <div class="card bg-dark text-white mb-4 border-secondary rounded-4 shadow">
                            <div
                                class="card-header d-flex align-items-center justify-content-between bg-transparent border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $post->user->profile_image) }}" class="rounded-circle border border-info"
                                        width="45" height="45" style="object-fit: cover;">
                                    <div class="ms-3">
                                        <h6 class="mb-0 fw-bold">{{ $post->user->username }}</h6>
                                        <small class="text-white-50 small text-uppercase"
                                            style="font-size: 10px;">{{ $post->created_at->diffForHumans() }}</small>
                                    </div>
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="btn btn-outline-info fw-bolder px-3 py-2 ms-3"
                                        style="box-shadow: 0 0 15px rgba(0, 242, 254, 0.5); border-radius: 8px;">
                                        <i class="bi bi-code-slash me-2"></i> {{ __("app.VIEW POST") }}
                                    </a>
                                </div>

                                @if(auth()->id() !== $post->user_id)
                                    <button type="button"
                                        class="btn btn-sm follow-btn {{ auth()->user()->isFollowing($post->user_id) ? 'btn-outline-danger' : 'btn-info' }}  fw-bold px-4"
                                        data-id="{{ $post->user_id }}" id="follow-btn">
                                        {{ auth()->user()->isFollowing($post->user_id) ? 'Following' : 'Follow' }}
                                    </button>
                                @endif
                            </div>

                            <div class="post-media bg-black">
                                @if($post->type == 'image')
                                    <div class="post-media bg-black overflow-hidden" style="height: 500px;"> <img
                                            src="{{ asset('storage/' . $post->media_path) }}" class="w-100 h-100 post-img-hover"
                                            style="object-fit: cover; transition: transform 0.4s ease;">
                                    </div>
                                @else
                                    <video src="{{ asset('storage/' . $post->media_path) }}" class="w-100" controls
                                        style="max-height: 80vh;"></video>
                                @endif
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <button type="button" class="btn btn-link p-0 me-2 post-like-btn" data-id="{{ $post->id }}"
                                        style="text-decoration: none; border: none; background: none;">
                                        <i class="bi {{ $post->likes()->where('user_id', auth()->id())->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-white' }} fs-4"
                                            id="like-icon-{{ $post->id }}"></i>
                                    </button>
                                    <span class="text-white fw-bold" id="like-count-{{ $post->id }}">
                                        {{ $post->likes()->count() }}
                                    </span>
                                    <i class="bi bi-chat-left-dots-fill ms-3 me-1"></i> {{ $post->comments->count() }}
                                </div>
                                <p class="card-text"><span
                                        class="fw-bold me-2">{{ $post->user->username }}</span>{{ $post->caption }}</p>
                            </div>
                        </div>

                    </div>

                @endforeach
            </div>
        </div>
        <script>
            function switchTab(type) {

                document.querySelectorAll('.profile-content').forEach(el => el.classList.add('d-none'));

                document.querySelectorAll('.tab-item').forEach(el => {
                    el.classList.remove('active-tab', 'text-white');
                    el.classList.add('text-secondary');
                });


                if (type === 'repos') {
                    document.getElementById('content-repos').classList.remove('d-none');
                    document.getElementById('tab-repos').classList.add('active-tab', 'text-white');
                } else {
                    document.getElementById('content-posts').classList.remove('d-none');
                    document.getElementById('tab-posts').classList.add('active-tab', 'text-white');
                }
            }
        </script>
    </div>
@endsection