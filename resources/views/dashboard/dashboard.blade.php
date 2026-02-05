@extends('layouts.app')

@section('home-section')

    <div class="dashboard-wrapper px-4 container-sm mt-2">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h1 class="display-5 fw-bold text-white mb-0">EXPLORE <span style="color: #00f2fe;">REPOS</span></h1>
                <p class="text-white-50">Discover what the community is building today.</p>
            </div>
            <div class="text-end">
                <span class="badge rounded-pill bg-dark border border-info px-3 py-2">
                    <i class="bi bi-cpu me-1"></i> {{ $repositories->count() }} Projects Online
                </span>
            </div>
        </div>

        <div class="row g-4">
            @foreach($repositories as $repo)
                <div class="col-md-4 col-sm-6">
                    <div class="neon-card h-100 d-flex flex-column"
                        style="border-radius: 15px; overflow: hidden; background: rgba(13, 31, 45, 0.8);">
                        <div class="repo-thumb" style="height: 180px; overflow: hidden; position: relative;">
                            <img src="{{ asset($repo->thumbnail ?? 'images/default-repo.png') }}"
                                class="w-100 h-100 object-fit-cover">
                            <div class="repo-overlay d-flex align-items-center justify-content-center">
                                <a href="{{ route('dashboard.show', $repo->id) }}" class="btn btn-info btn-sm fw-bold px-4">VIEW
                                    CODE</a>
                            </div>
                        </div>

                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset($repo->user->profile_image) }}" class="rounded-circle border border-info"
                                    style="width: 25px; height: 25px;">
                                <span class="ms-2 text-white-50 small">{{ $repo->user->username }}</span>
                            </div>
                            <h4 class="text-white fw-bold mb-2">{{ $repo->title }}</h4>
                            <p class="text-white-50 small flex-grow-1">{{ Str::limit($repo->description, 80) }}</p>

                            <div
                                class="mt-3 pt-3 border-top border-secondary d-flex justify-content-between align-items-center">
                                <div class="text-info small">
                                    <button class="btn-like border-0 bg-transparent" data-id="{{ $repo->id }}"
                                        style="cursor: pointer;">
                                        <i class="bi {{ auth()->user() && $repo->isLikedBy(auth()->user()) ? 'bi-heart-fill text-danger' : 'bi-heart text-info' }} fs-4"
                                            id="like-icon-{{ $repo->id }}"></i>
                                        <span class="text-white ms-1"
                                            id="like-count-{{ $repo->id }}">{{ $repo->likes->count() }}</span>
                                    </button>
                                    <i class="bi bi-chat-left-dots-fill ms-3 me-1"></i> {{ $repo->comments->count() }}
                                </div>
                                <small class="text-white-50">{{ $repo->created_at->diffForHumans() }}</small>
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