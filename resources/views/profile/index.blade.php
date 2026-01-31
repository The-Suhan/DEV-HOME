@extends('layouts.app')

@section('home-section')
<div class="container-xl">
    <div class="row mb-5">
        <div class="col-md-4 text-center">
            <img src="{{ asset($user->profile_image) }}" class="user-img mb-3" style="width: 200px; height: 200px; border: 4px solid #00f2fe;">
            <h3 class="text-white">{{ $user->username }}</h3>
            <p class="text-white-50">{{ $user->bio ?? 'No bio available.' }}</p>
            <a href="{{ $user->github_url }}" target="_blank" class="text-info d-block mb-3">
                <i class="bi bi-github"></i> GitHub Profile
            </a>
            
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-warning">Edit Profile</a>
                <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Are you sure? Everything will be deleted!')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete Account</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row text-center mt-5">
                <div class="col-4">
                    <h2 class="text-info">{{ $user->totalLikes->count() }}</h2>
                    <span class="text-white-50">Total Likes</span>
                </div>
                <div class="col-4">
                    <h2 class="text-info">{{ $user->followers->count() }}</h2>
                    <span class="text-white-50">Followers</span>
                </div>
                <div class="col-4">
                    <h2 class="text-info">{{ $user->followings->count() }}</h2>
                    <span class="text-white-50">Following</span>
                </div>
            </div>
        </div>
    </div>

    <hr style="border-color: rgba(0, 242, 254, 0.2);">
    <h2 class="text-center my-4" style="color: #00f2fe;">MY REPOSITORIES</h2>

    <div class="row">
        @foreach($user->repositories as $repo)
        <div class="col-md-4 mb-4">
            <div class="neon-card">
                <h5 class="text-white">{{ $repo->title }}</h5>
                <div class="repo-frame">
                    <img src="{{ asset($repo->thumbnail ?? 'images/repoimg.jpg') }}" class="repo-img">
                </div>
                <a href="{{ route('dashboard.show', $repo->id) }}" class="btn btn-outline-info btn-sm w-100 mt-3">View Project</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection