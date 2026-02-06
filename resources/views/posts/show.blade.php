@extends('layouts.app')

@section('home-section')
    <div class="container py-5">
        <div class="row g-0 bg-dark rounded-4 shadow-lg overflow-hidden border border-secondary">

            <div class="col-lg-8 bg-black d-flex align-items-center justify-content-center" style="min-height: 500px;">
                @if($post->type == 'image')
                    <img src="{{ asset($post->media_path) }}" class="img-fluid w-100"
                        style="max-height: 89vh; object-fit: contain;">
                @else
                    <video src="{{ asset($post->media_path) }}" class="w-100" controls style="max-height: 80vh;"></video>
                @endif
            </div>

            <div class="col-lg-4 d-flex flex-column bg-dark border-start border-secondary">

                <div class="p-3 border-bottom border-secondary d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($post->user->profile_image) }}" class="rounded-circle border border-info"
                            width="40" height="40" style="object-fit: cover;">
                        <div class="ms-3">
                            <h6 class="mb-0 fw-bold text-white">{{ $post->user->username }}</h6>
                        </div>
                    </div>
                    @if(auth()->id() !== $post->user_id)
                        <button type="button"
                            class="btn btn-sm follow-btn {{ auth()->user()->isFollowing($post->user_id) ? 'btn-outline-danger' : 'btn-info' }}  fw-bold px-4"
                            data-id="{{ $post->user_id }}" id="follow-btn">
                            {{ auth()->user()->isFollowing($post->user_id) ? 'Following' : 'Follow' }}
                        </button>
                    @endif
                </div>

                <div class="p-3 flex-grow-1 overflow-auto" style="max-height: 400px;">
                    <div class="mb-3">
                        <span class="fw-bold text-info me-2">{{ $post->user->username }}</span>
                        <span class="text-white-50">{{ $post->caption }}</span>
                    </div>
                    <hr class="border-secondary">
                </div>

                <div class="p-3 border-top border-secondary bg-black-50">
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

                    <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mt-2">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="content"
                                class="form-control bg-transparent border-secondary text-white small"
                                placeholder="Add a comment..." style="border-radius: 20px 0 0 20px;">
                            <button class="btn btn-info text-dark fw-bold px-3" type="submit"
                                style="border-radius: 0 20px 20px 0;">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection