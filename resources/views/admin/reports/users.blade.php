@extends('layouts.app')

@section('home-section')
    <div class="container-sm py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white fw-bold">Report Management</h2>
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-light">Back to Panel</a>
        </div>
        <div class="d-flex gap-2 mb-4 text-center">
            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-danger">All Reports</a>
            <a href="{{ route('admin.reports.users') }}" class="btn btn-outline-info">Users</a>
            <a href="{{ route('admin.reports.posts') }}" class="btn btn-outline-success">Posts</a>
            <a href="{{ route('admin.reports.repositories') }}" class="btn btn-outline-warning">Repositories</a>
        </div>
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-info text-info">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="adminreport4" class="form-control bg-dark text-white border-info shadow-none"
                        placeholder="Search report by owner or caption...">
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($reports as $report)
                <div class="col-12 mb-3">
                    <div class="card bg-dark text-white border-secondary">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <strong>Reporter:</strong> {{ $report->reporter->username }} <br>
                                <strong>Target:</strong>
                                <a href="{{ $report->target_url }}"
                                    class="text-info">{{ $report->reportable->username ?? $report->reportable->description }}</a>
                            </div>

                            <div class="px-4 flex-grow-1 text-center">
                                <span class="badge bg-warning text-dark">{{ $report->reason }}</span>
                            </div>

                            <div class="text-end">
                                <span
                                    class="badge bg-secondary me-3">{{ strtoupper(class_basename($report->reportable_type)) }}</span>
                                <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete Content</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.getElementById('adminreport4').addEventListener('keyup', function () {
            let searchTerm = this.value.toLowerCase();
            let postCards = document.querySelectorAll('.col-12.mb-3');

            postCards.forEach(card => {
                let ownerName = card.querySelector('h5') ? card.querySelector('h5').innerText.toLowerCase() : '';
                let postCaption = card.querySelector('p') ? card.querySelector('p').innerText.toLowerCase() : '';

                if (ownerName.includes(searchTerm) || postCaption.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection