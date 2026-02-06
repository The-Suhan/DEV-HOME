@extends('layouts.app')

@section('home-section')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                @foreach($posts as $post)
                    <div class="card bg-dark text-white mb-4 border-secondary rounded-4 shadow">
                        <div class="card-header d-flex align-items-center justify-content-between bg-transparent border-0 py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($post->user->profile_image) }}" class="rounded-circle border border-info"
                                    width="45" height="45" style="object-fit: cover;">
                                <div class="ms-3">
                                    <h6 class="mb-0 fw-bold">{{ $post->user->username }}</h6>
                                    <small class="text-white-50 small text-uppercase"
                                        style="font-size: 10px;">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('posts.show', $post->id) }}"
                                    class="btn btn-outline-info fw-bolder px-3 py-2 ms-3"
                                    style="box-shadow: 0 0 15px rgba(0, 242, 254, 0.5); border-radius: 8px;">
                                    <i class="bi bi-code-slash me-2"></i> VIEW POST
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
                                        src="{{ asset($post->media_path) }}" class="w-100 h-100 post-img-hover"
                                        style="object-fit: cover; transition: transform 0.4s ease;">
                                </div>
                            @else
                                <video src="{{ asset($post->media_path) }}" class="w-100" controls></video>
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
                            </div>
                            <p class="card-text"><span
                                    class="fw-bold me-2">{{ $post->user->username }}</span>{{ $post->caption }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection