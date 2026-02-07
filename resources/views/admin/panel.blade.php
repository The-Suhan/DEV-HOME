@extends('layouts.app')

@section('home-section')
    <div class="container mt-5 text-center">
        <h2 class="text-danger mb-5"><i class="bi bi-shield-shaded"></i> ADMIN MANAGEMENT</h2>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('admin.users') }}" class="btn btn-outline-info w-100 py-5 fw-bold fs-4">
                    <i class="bi bi-people fs-1 d-block mb-2"></i> USERS
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin.repositories') }}" class="btn btn-outline-warning w-100 py-5 fw-bold fs-4">
                    <i class="bi bi-folder2-open fs-1 d-block mb-2"></i> REPOSITORIES
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-4 text-center mt-4" style="margin-left: 360px;">
            <a href="{{ route('admin.posts') }}" class="text-decoration-none">
                <div class="card bg-dark border-info h-100 py-4 shadow-lg text-center btn-outline-info">
                    <div class="card-body">
                        <i class="bi bi-collection-play mb-3 text-info" style="font-size: 3rem;"></i>
                        <h3 class="text-info fw-bold">POSTS</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection