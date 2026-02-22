@extends('layouts.app')

@section('home-section')
    <div class="container-sm py-4">
        <div class="">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h1 class="display-5 fw-bold text-white mb-0">{{ __("app.FOR YOU") }} <span
                            style="color: #00f2fe;">{{ __("app.PAGE") }} </span></h1>
                    <p class="text-white-50">{{ __("app.See what`s happening in the world.") }}</p>
                </div>
                <div class="text-end">
                    <span class="badge rounded-pill bg-dark border border-info px-3 py-2">
                        <i class="bi me-1"></i> {{ $posts->count() }} {{ __("app.Posts Online") }}
                    </span>
                </div>
            </div>
            <div class="row mb-4 justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="input-group shadow-lg">
                        <span class="input-group-text bg-dark border-info text-info">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="postIndexSearch"
                            class="form-control bg-dark text-white border-info shadow-none"
                            placeholder="Search posts by username or content...">
                    </div>
                </div>
            </div>
            <form id="filterForm" action="{{ route('posts.index') }}" method="GET" class="mb-4">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="shadow-lg">
                            <select name="type"
                                class="form-select bg-dark text-info border-secondary shadow-none w-100 py-2"
                                onchange="this.form.submit()"
                                style="border-radius: 15px; border: 1px solid #00f2fe; cursor: pointer;">
                                <option value="" class="text-white">{{ __('app.ALL POSTS') }}</option>
                                <option value="image" {{ request('type') == 'image' ? 'selected' : '' }} class="text-white">
                                    📸 {{ __('app.ONLY PHOTOS') }}
                                </option>
                                <option value="video" {{ request('type') == 'video' ? 'selected' : '' }} class="text-white">
                                    🎥 {{ __('app.ONLY VIDEOS') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @foreach($posts as $post)
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card bg-dark text-white mb-4 border-secondary rounded-4 shadow">
                        <div class="card-header d-flex align-items-center justify-content-between bg-transparent border-0 py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $post->user->profile_image) }}"
                                    class="rounded-circle border border-info" width="45" height="45" style="object-fit: cover;">
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
                                @auth
                                    @if(auth()->user()->id === $post->user_id)
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger ms-5 px-3 py-2">
                                                <i class="fas fa-trash"></i> {{ __("app.Delete") }}
                                            </button>
                                        </form>
                                    @endif
                                @endauth
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
                                <button type="button" class="ms-4 btn btn-sm btn-outline-danger shadow-sm"
                                    data-bs-toggle="modal" data-bs-target="#reportModal" data-type="post"
                                    data-id="{{ $post->id }}">
                                    <i class="fas fa-flag"></i> {{ __("app.Report Post") }}
                                </button>
                            </div>
                            <p class="card-text"><span
                                    class="fw-bold me-2">{{ $post->user->username }}</span>{{ $post->caption }}</p>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    <script>
        document.getElementById('postIndexSearch').addEventListener('keyup', function () {
            let searchTerm = this.value.toLowerCase();
            let postRows = document.querySelectorAll('.row.justify-content-center');

            postRows.forEach(row => {
                let card = row.querySelector('.card');
                if (card) {
                    let username = card.querySelector('h6') ? card.querySelector('h6').innerText.toLowerCase() : '';
                    let cardText = card.innerText.toLowerCase();

                    if (username.includes(searchTerm) || cardText.includes(searchTerm)) {
                        row.style.display = 'flex';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    </script>
@endsection