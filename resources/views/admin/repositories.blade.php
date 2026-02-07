@extends('layouts.app')

@section('home-section')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white fw-bold">ADMIN Management</h2>
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-light">Back to Panel</a>
        </div>
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-info text-info">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="adminRepoSearch" class="form-control bg-dark text-white border-info shadow-none"
                        placeholder="Search by repo title or owner username...">
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($repos as $repo)
                <div class="col-12 mb-3">
                    <div class="card bg-dark border-secondary shadow">
                        <div class="card-body d-flex align-items-center gap-4 text-white">
                            <a href="{{ asset($repo->repo_path) }}" class="rounded shadow-sm"
                                style="width: 100px; height: 100px; object-fit: cover;">
                            </a>
                            <div class="flex-grow-1">
                                <h5 class="mb-1 text-info">By: {{ $repo->user->username }}</h5>
                                <p class="small text-white-50 mb-0">{{ Str::limit($repo->title, 100) }}</p>
                                <small class="text-secondary">Created at: {{ $repo->created_at->format('d.m.Y H:i') }}</small>
                            </div>
                            <a href="{{ route('dashboard.show', $repo->id) }}" class="btn btn-info fw-bold px-2 py-2"
                                style="box-shadow: 0 0 15px rgba(0, 242, 254, 0.5); border-radius: 8px;">
                                <i class="bi bi-code-slash me-2"></i> VIEW PROJECT
                            </a>
                            <form action="{{ route('admin.repo.delete', $repo->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.getElementById('adminRepoSearch').addEventListener('keyup', function () {
            let searchTerm = this.value.toLowerCase();
            let repoCards = document.querySelectorAll('.col-12.mb-3');

            repoCards.forEach(card => {
                let ownerName = card.querySelector('h5').innerText.toLowerCase();
                let repoTitle = card.querySelector('p').innerText.toLowerCase();

                if (ownerName.includes(searchTerm) || repoTitle.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection