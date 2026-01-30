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
    </style>

    <div class="show-container">
        <div class="repo-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div style="position: relative;">
                    <img src="{{ asset($repo->user->profile_image) }}"
                        style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid #00f2fe; object-fit: cover;">
                    <button class="plus-btn sub-btn {{ auth()->user()->isFollowing($repo->user_id) ? 'following' : '' }}"
                        data-user-id="{{ $repo->user_id }}">
                        {{ auth()->user()->isFollowing($repo->user_id) ? '✓' : '+' }}
                    </button>
                </div>
                <div class="ms-4">
                    <h2 style="color: #00f2fe; margin: 0;">{{ $repo->title }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="text-white-50 me-2">by {{ $repo->user->username }}</span>
                        <span class="user-stats">Total Likes: {{ $repo->user->totalLikes->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="like-section d-flex align-items-center">
                @php $liked = $repo->likes->where('user_id', auth()->id())->count() > 0; @endphp
                <i class="bi bi-heart-fill {{ $liked ? 'like-active' : 'text-white' }}" id="mainLikeBtn"
                    style="cursor: pointer;"></i>
                <span class="ms-2 fs-5" id="likeCount">{{ $repo->likes->count() }}</span>
            </div>
        </div>

        <div class="path-display">
            <div class="mb-2 text-white-50 small text-uppercase">Project Root Path:</div>
            <div class="path-text">
                <i class="bi bi-folder2-open me-2"></i> {{ $repo->repo_path }}
            </div>
        </div>

        <div class="description-box mb-5">
            <h4 style="color: #00f2fe;">About Project</h4>
            <p class="lead text-white-70" style="line-height: 1.8;">{{ $repo->description }}</p>
        </div>
    </div>

    <script>
        document.querySelectorAll('.sub-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const userId = this.getAttribute('data-user-id');

                fetch("{{ route('subscribe.toggle') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ user_id: userId })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'subscribed') {
                            this.innerText = '✓';
                            this.style.background = '#ff4d4d'; // Takip edince kırmızı olsun
                            this.style.boxShadow = '0 0 10px #ff4d4d';
                        } else {
                            this.innerText = '+';
                            this.style.background = '#00f2fe'; // Geri maviye dönsün
                            this.style.boxShadow = 'none';
                        }
                    });
            });
        });
    </script>
@endsection