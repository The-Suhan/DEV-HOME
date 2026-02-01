@extends('layouts.app')

@section('home-section')
<div class="container">
    <h2 class="text-danger mb-5"><i class="bi bi-shield-shaded"></i> ADMIN MANAGEMENT</h2>
    
    @foreach($users as $user)
    <div class="col-12 mb-3">
        <div class="neon-card d-flex align-items-center justify-content-between p-3" style="border-color: #ff4757;">
            <div class="d-flex align-items-center">
                <img src="{{ asset($user->profile_image) }}" style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid #ff4757;">
                <div class="ms-4">
                    <h5 class="text-white mb-0">{{ $user->username }}</h5>
                    <small class="text-white-50">{{ $user->email }}</small>
                </div>
            </div>
            
            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Delete User')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm px-4 fw-bold">
                    <i class="bi bi-trash"></i> DELETE
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection