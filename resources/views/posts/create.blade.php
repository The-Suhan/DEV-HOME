@extends('layouts.app')

@section('home-section')
    <div class="container py-5 d-flex justify-content-center">
        <div class="card bg-dark border-secondary shadow-lg" style="width: 500px; border-radius: 15px;">
            <div class="card-header border-secondary bg-transparent text-center py-3">
                <h4 class="text-info fw-bold mb-0">{{ __("app.Create New Post") }}</h4>
            </div>
            <div class="card-body p-4 text-white">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="text-white-50 small d-block mb-2">{{ __("app.Post Type:") }}</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="type" id="typeImg" value="image" checked>
                            <label class="btn btn-outline-info" for="typeImg">📸 {{ __("app.Photo") }}</label>

                            <input type="radio" class="btn-check" name="type" id="typeVid" value="video">
                            <label class="btn btn-outline-info" for="typeVid">🎥 {{ __("app.Video") }}</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-white-50 small">{{ __("app.Select File:") }}</label>
                        <input type="file" name="media" class="form-control bg-dark text-white border-secondary" required>
                    </div>

                    <div class="mb-3">
                        <textarea name="caption" class="form-control bg-dark text-white border-secondary"
                            placeholder="Write a caption..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-info w-100 fw-bold">{{ __("app.Share Post") }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection