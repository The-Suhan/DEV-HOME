@extends('layouts.app')

@section('home-section')
    <div class="" style="max-width: 600px;margin: auto;">
        <div class="edit-card">
            <h2 class="text-center mb-4" style="color: #00f2fe; text-transform: uppercase;">{{ __("app.Create New Repo") }}
            </h2>

            <form action="{{ route('profile.storeRepo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label h4" style="color: #00f2fe;">{{ __("app.PROJECT TITLE") }}</label>
                    <input type="text" name="title" class="form-control neon-input" placeholder="e.g. Instagram Clone"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label h4" style="color: #00f2fe;">{{ __("app.PROJECT DESCRIPTION") }}</label>
                    <textarea name="description" class="form-control neon-input" rows="3"
                        placeholder="Tell us about your project..." required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label h4" style="color: #00f2fe;">{{ __('app.PROJECT FILE (.ZIP)') }}</label>
                    <input type="file" name="repo_file" class="form-control neon-input" required>
                </div>

                <div class="mb-4">
                    <label class="form-label h5" style="color: #00f2fe;">{{ __("app.PROJECT THUMBNAIL (IMAGE)") }}</label>
                    <input type="file" name="thumbnail" class="form-control neon-input">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info fw-bold text-dark">{{ __("app.Create Repository") }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection