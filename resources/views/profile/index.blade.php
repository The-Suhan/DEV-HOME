@extends('layouts.app')

@section('home-section')
    <div class="container-xl">
        <div class="row mb-5">
            <div class="col-md-4 text-center">
                <img src="{{ asset($user->profile_image) }}" class="user-img mb-3"
                    style="width: 200px; height: 200px; border: 4px solid #00f2fe;">
                <h3 class="text-white">{{ $user->username }}</h3>
                <p class="text-white-50">{{ $user->bio ?? 'No bio available.' }}</p>
                <a href="{{ $user->github_url }}" target="_blank" class="text-info d-block mb-3">
                    <i class="bi bi-github"></i> GitHub Profile
                </a>

                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-warning">Edit Profile</a>
                    <form action="{{ route('profile.delete') }}" method="POST"
                        onsubmit="return confirm('Are you sure? Everything will be deleted!')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete Account</button>
                    </form>
                    <a href="{{ route('profile.createRepo') }}" class="btn btn-outline-info btn-sm">
                        <i class="bi bi-plus-circle"></i> Add New Repository
                    </a>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row text-center mt-5">
                    <div class="col-4">
                        <h2 class="text-info">{{ $user->total_likes }}</h2>
                        <span class="text-white-50">Total Likes</span>
                    </div>
                    <div class="col-4">
                        <h2 class="text-info">{{ $user->followers->count() }}</h2>
                        <span class="text-white-50">Followers</span>
                    </div>
                    <div class="col-4">
                        <h2 class="text-info">{{ $user->followings->count() }}</h2>
                        <span class="text-white-50">Following</span>
                    </div>
                </div>
            </div>
        </div>

        <hr style="border-color: rgba(0, 242, 254, 0.2);">
        <h2 class="text-center my-4" style="color: #00f2fe;">MY REPOSITORIES</h2>

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
                            <div class="mt-3">
                                <a href="{{ route('dashboard.show', $repo->id) }}"
                                    class="btn btn-info fw-bold px-4 py-2 w-100 mb-2"
                                    style="box-shadow: 0 0 15px rgba(0, 242, 254, 0.5); border-radius: 8px;">
                                    <i class="bi bi-code-slash me-2"></i> VIEW PROJECT
                                </a>
                                <form action="{{ route('profile.repo.destroy', $repo->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-link text-danger text-decoration-none btn-sm w-100 fw-bold">
                                        <i class="bi bi-trash3 me-1"></i> Delete Repository
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection