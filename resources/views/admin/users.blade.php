@extends('layouts.app')

@section('home-section')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2 class="text-white fw-bold">{{ __("app.ADMIN Management") }}</h2>
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-light">{{ __("app.Back to Panel") }}</a>
        </div>
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-info text-info">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="adminUserSearch" class="form-control bg-dark text-white border-info shadow-none"
                        placeholder="Type to search users instantly...">
                </div>
            </div>
        </div>

        @foreach($users as $user)
            <a href="{{ route('users.show', $user->id) }}" class="text-decoration-none">
                <div class="col-12 mb-3">
                    <div class="neon-card d-flex align-items-center justify-content-between p-3" style="border-color: #ff4757;">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($user->profile_image) }}"
                                style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid #ff4757;">
                            <div class="ms-4">
                                <h5 class="text-white mb-0">{{ $user->username }}</h5>
                                <small class="text-white-50">{{ $user->email }}</small>
                            </div>
                        </div>

                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST"
                            onsubmit="return confirm('Delete User')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm px-4 fw-bold">
                                <i class="bi bi-trash"></i> {{ __("app.delete") }}
                            </button>
                        </form>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <script>
        document.getElementById('adminUserSearch').addEventListener('keyup', function () {
            let searchTerm = this.value.toLowerCase();
            let userCards = document.querySelectorAll('.col-12.mb-3');

            userCards.forEach(card => {
                let username = card.querySelector('h5').innerText.toLowerCase();
                let email = card.querySelector('small').innerText.toLowerCase();

                if (username.includes(searchTerm) || email.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection