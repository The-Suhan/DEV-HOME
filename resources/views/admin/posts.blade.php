@extends('layouts.app')

@section('home-section')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white fw-bold">{{ __("app.Post Management") }}</h2>
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-light">{{ __("app.Back to Panel") }}</a>
        </div>
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-info text-info">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="adminPostSearch" class="form-control bg-dark text-white border-info shadow-none"
                        placeholder="Search posts by owner or caption...">
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-12 mb-3">
                    <div class="card bg-dark border-secondary shadow">
                        <div class="card-body d-flex align-items-center gap-4 text-white">
                            <img src="{{ asset('storage/' . $post->media_path) }}" class="rounded shadow-sm"
                                style="width: 100px; height: 100px; object-fit: cover;">

                            <div class="flex-grow-1">
                                <h5 class="mb-1 text-info">{{ __("app.By:") }} {{ $post->user->username }}</h5>
                                <p class="small text-white-50 mb-0">{{ Str::limit($post->caption, 100) }}</p>
                                <small class="text-secondary">{{ __("app.Created at:") }} {{ $post->created_at->format('d.m.Y H:i') }}</small>
                            </div>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-info fw-bolder px-2 py-2 ms-3"
                                style="box-shadow: 0 0 15px rgba(0, 242, 254, 0.5); border-radius: 8px;">
                                <i class="bi bi-code-slash me-2"></i> {{ __("app.VIEW POST") }}
                            </a>
                            <form action="{{ route('admin.post.delete', $post->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i>{{ __("app.Delete Post") }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.getElementById('adminPostSearch').addEventListener('keyup', function () {
            let searchTerm = this.value.toLowerCase();
            let postCards = document.querySelectorAll('.col-12.mb-3');

            postCards.forEach(card => {
                let ownerName = card.querySelector('h5') ? card.querySelector('h5').innerText.toLowerCase() : '';
                let postCaption = card.querySelector('p') ? card.querySelector('p').innerText.toLowerCase() : '';

                if (ownerName.includes(searchTerm) || postCaption.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection