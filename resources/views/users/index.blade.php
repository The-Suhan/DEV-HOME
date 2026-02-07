@extends('layouts.app')

@section('home-section')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-6 mx-auto">
                    <div class="input-group shadow-lg">
                        <span class="input-group-text bg-dark border-info text-info">
                            <i class="bi bi-person-search"></i>
                        </span>
                        <input type="text" id="globalUserSearch"
                            class="form-control bg-dark text-white border-info shadow-none"
                            placeholder="Find someone by username or bio...">
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-6 mb-4">
                        <a href="{{ route('users.show', $user->id) }}" class="text-decoration-none">
                            <div class="neon-card d-flex align-items-center">
                                <img src="{{ asset($user->profile_image) }}" class="user-img"
                                    style="width: 80px; height: 80px;">
                                <div class="ms-4">
                                    <h4 class="text-white mb-1">{{ $user->username }}</h4>
                                    <p class="text-white-50 small mb-0">{{ Str::limit($user->bio, 50) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        document.getElementById('globalUserSearch').addEventListener('keyup', function () {
            let searchTerm = this.value.toLowerCase();
            let userColumns = document.querySelectorAll('.col-md-6.mb-4');

            userColumns.forEach(column => {
                let username = column.querySelector('h4') ? column.querySelector('h4').innerText.toLowerCase() : '';
                let bio = column.querySelector('p') ? column.querySelector('p').innerText.toLowerCase() : '';

                if (username.includes(searchTerm) || bio.includes(searchTerm)) {
                    column.style.display = 'block';
                } else {
                    column.style.display = 'none';
                }
            });
        });
    </script>
@endsection