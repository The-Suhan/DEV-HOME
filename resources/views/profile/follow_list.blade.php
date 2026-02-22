@extends('layouts.app')

@section('home-section')
    <style>
        #followSearch:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 10px rgba(13, 202, 240, 0.5);
        }

        .btn-outline-info:hover {
            box-shadow: 0 0 15px rgba(13, 202, 240, 0.6);
            transform: translateX(-5px);
        }
    </style>

    <div class="container py-5">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ url()->previous() }}"
                class="btn btn-outline-info rounded-circle d-flex align-items-center justify-content-center"
                style="width: 45px; height: 45px; transition: 0.3s;">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>

            <h2 class="text-info fw-bold mb-0">{{ $type }} of {{ $user->username }}</h2>
        </div>
        <div class="row mb-4">
            <div class="col-12 col-md-6 mx-auto">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-dark border-info text-info"><i class="bi bi-search"></i></span>
                    <input type="text" id="followSearch" class="form-control bg-dark text-white border-info shadow-none"
                        placeholder="Search in {{ strtolower($type) }}...">
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($list as $item)
                @php $targetUser = ($type === 'Followers') ? $item->follower : $item->following; @endphp
                <div class="col-12 mb-2">
                    <div class="card bg-dark border-secondary shadow-sm">
                        <div class="card-body d-flex align-items-center text-white">
                            <a href="{{ route('users.show', $targetUser->id) }}"
                                class="d-flex align-items-center gap-3 text-decoration-none text-white">
                                <img src="{{ $targetUser->profile_image ? asset('storage/' . $targetUser->profile_image) : asset('storage/' . 'default-avatar.png') }}"
                                    class="rounded-circle border border-info"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $targetUser->username }}</h6>
                                    <small class="text-white-50">{{ Str::limit($targetUser->bio, 50) }}</small>
                                </div>
                            </a>

                            <div class="ms-auto d-flex gap-2 align-items-center">
                                @if(auth()->id() !== $targetUser->id)
                                    @if(auth()->user()->isFollowing($targetUser->id))
                                        <form action="{{ route('user.unfollow', $targetUser->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-secondary btn-sm rounded-pill px-3"
                                                style="font-size: 12px;">{{ __("app.Following") }}</button>
                                        </form>
                                    @else
                                        <form action="{{ route('user.follow', $targetUser->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm rounded-pill px-3 fw-bold" style="font-size: 12px;">
                                                <i class="bi bi-person-plus-fill"></i> {{ __("app.Follow Back") }}
                                            </button>
                                        </form>
                                    @endif
                                @endif


                                @if(auth()->id() === $user->id)
                                    <form action="{{ route('profile.deleteFollow', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                            style="font-size: 12px;">{{ __("app.Remove") }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-white-50 mt-5">No {{ strtolower($type) }} yet.</div>
            @endforelse
        </div>
    </div>


    <script>
        document.getElementById('followSearch').addEventListener('keyup', function () {
            let searchTerm = this.value.toLowerCase();
            let cards = document.querySelectorAll('.col-12.mb-2');

            cards.forEach(card => {
                let username = card.querySelector('h6').innerText.toLowerCase();

                if (username.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection