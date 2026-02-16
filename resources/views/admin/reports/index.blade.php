@extends('layouts.app')

@section('home-section')
    <div class="container-sm py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white fw-bold">{{ __("app.Report Management") }}</h2>
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-light">{{ __("app.Back to Panel") }}</a>
        </div>
        <div class="d-flex gap-2 mb-4 text-center">
            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-danger mx-3">{{ __("app.All Reports") }}</a>
            <a href="{{ route('admin.reports.users') }}" class="btn btn-outline-info">{{ __("app.Users") }}</a>
            <a href="{{ route('admin.reports.posts') }}" class="btn btn-outline-success mx-3">{{ __("app.Posts") }}</a>
            <a href="{{ route('admin.reports.repositories') }}" class="btn btn-outline-warning">{{ __("app.Repositories") }}</a>
        </div>
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-info text-info">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="adminreport1" class="form-control bg-dark text-white border-info shadow-none"
                        placeholder="Search report by owner or caption...">
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($reports as $report)
                <div class="col-12 mb-3">
                    <div class="report-card card bg-dark text-white border-secondary">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <strong>{{ __("app.Reporter:") }}</strong> {{ $report->reporter->username }} <br>
                                <strong>{{ __("app.Report :") }}</strong> {{ $report->description }} <br>
                                <strong>{{ __("app.Target:") }}</strong>
                                <a href="{{ $report->target_url }}" class="text-info">
                                    @if($report->reportable)
                                        {{ $report->reportable->username ?? ($report->reportable->title ?? 'View Content') }}
                                    @else
                                        <span class="text-muted italic">{{ __("app.Deleted Content") }} (ID: {{ $report->reportable_id }})</span>
                                    @endif
                                </a>
                            </div>

                            <div class="px-4 flex-grow-1 text-center">
                                <span class="badge bg-warning text-dark">{{ $report->reason }}</span>
                            </div>

                            <div class="text-end">
                                <span
                                    class="badge bg-secondary me-3">{{ strtoupper(class_basename($report->reportable_type)) }}</span>
                                <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">{{ __("app.Delete Content") }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('adminreport1');
            const reportCards = document.querySelectorAll('.report-card');

            searchInput.addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase().trim();

                reportCards.forEach(card => {
                    const text = card.textContent.toLowerCase();

                    if (text.includes(searchTerm)) {
                        card.style.display = "";
                        card.classList.add('animate__animated', 'animate__fadeIn');
                    } else {
                        card.style.display = "none"; 
                    }
                });
            });
        });
    </script>
@endsection