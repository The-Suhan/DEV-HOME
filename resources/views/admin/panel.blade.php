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
    </div>
@endsection