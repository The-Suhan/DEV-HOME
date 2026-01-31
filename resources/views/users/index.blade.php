@extends('layouts.app')

@section('home-section')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            @foreach($users as $user)
            <div class="col-md-6 mb-4">
                <a href="{{ route('users.show', $user->id) }}" class="text-decoration-none">
                    <div class="neon-card d-flex align-items-center">
                        <img src="{{ asset($user->profile_image) }}" class="user-img" style="width: 80px; height: 80px;">
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
@endsection