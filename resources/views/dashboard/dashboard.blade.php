@extends('layouts.app')

@section('home-section')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-6">
                    <div class="search-container">
                        <i class="bi bi-search text-info"></i>
                        <input type="text" placeholder="Search for ideas...">
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($repositories as $repo)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="neon-card">
                            <div class="d-flex align-items-center">
                                <div class="profile-wrap">
                                    <img src="{{ asset($repo->user->profile_image) }}" class="user-img">
                                    <button class="plus-btn">+</button>
                                </div>
                                <span class="ms-3 text-white fw-bold">{{ $repo->user->username }}</span>
                            </div>

                            <a href="{{ route('dashboard.show', $repo->id) }}" class="repo-title-link">
                                {{ $repo->title }}
                            </a>

                            <div class="repo-frame">
                                <img src="{{ asset($repo->thumbnail ?? 'images/repoimg.jpg') }}" class="repo-img">
                            </div>

                            <div class="icon-bar d-flex align-items-center mt-3">
                                <i class="bi bi-heart-fill like-btn {{ ($repo->likes && $repo->likes->contains('user_id', auth()->id())) ? 'text-danger' : 'text-white' }}"
                                    style="cursor: pointer;" data-id="{{ $repo->id }}">
                                </i>
                                <span class="ms-2 text-white-50 like-count-{{ $repo->id }}">{{ $repo->likes->count() }}</span>
                            </div>

                            <div class="mt-3">
                                <p class="text-white-50 small mb-3">{{ Str::limit($repo->description, 80) }}</p>
                                <a href="{{ route('dashboard.show', $repo->id) }}"
                                    class="btn btn-outline-info btn-sm w-100 fw-bold">
                                    View Project Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const likeButtons = document.querySelectorAll('.like-btn');

            likeButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const repoId = this.getAttribute('data-id');
                    const countSpan = document.querySelector('.like-count-' + repoId);

                    fetch("{{ route('like.toggle') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ repository_id: repoId })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'liked') {
                                this.classList.replace('text-white', 'text-danger');
                            } else {
                                this.classList.replace('text-danger', 'text-white');
                            }
                            countSpan.innerText = data.count;
                        })
                        .catch(error => console.error('Hata:', error));
                });
            });
        });
    </script>
@endsection