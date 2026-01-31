@extends('layouts.app')

@section('home-section')
<div class="container-xl">
    
    <div class="row align-items-center mb-5">
        <div class="col-md-3 text-center">
            <img src="{{ asset($user->profile_image) }}" style="width: 150px; height: 150px; border-radius: 50%; border: 3px solid #00f2fe; object-fit: cover;">
          
            <div class="mt-3 text-white-50 small d-flex">
                <div >Total Likes: <span class="text-info">{{ $user->totalLikes->count() }}</span></div>
                <div class="mx-3">Followers: <span class="text-info">{{ $user->followers->count() }}</span></div>
                <div>Following: <span class="text-info">{{ $user->followings->count() }}</span></div>
            </div>
        </div>
        <div class="col-md-9">
            <h2 style="color: #00f2fe;">{{ $user->username }}</h2>
            <p class="lead text-white-70">{{ $user->bio ?? 'No bio available.' }}</p>
        </div>
    </div>

    <hr style="border-color: rgba(0, 242, 254, 0.3);">
    <h3 class="text-center my-5" style="color: #00f2fe; text-transform: uppercase; letter-spacing: 2px;">Repositories</h3>

    <div class="row">
        @foreach($user->repositories as $repo)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="neon-card">
                <h5 class="repo-title-link text-white">{{ $repo->title }}</h5>
                <div class="repo-frame">
                    <img src="{{ asset($repo->thumbnail ?? 'images/repoimg.jpg') }}" class="repo-img">
                </div>
                <div class="mt-3">
                    <a href="{{ route('dashboard.show', $repo->id) }}" class="btn btn-outline-info btn-sm w-100 fw-bold">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection