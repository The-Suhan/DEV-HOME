@extends('layouts.app')

@section('home-section')
    <style>
    
        .neon-input::placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .neon-input::-webkit-input-placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .neon-input::-moz-placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .neon-input:-ms-input-placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .edit-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .edit-card {
            background: #0d1b2a;
            border: 2px solid #00f2fe;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 0 30px rgba(0, 242, 254, 0.15);
            width: 100%;
            max-width: 600px;
        }

        .form-label {
            color: #00f2fe;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .neon-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 242, 254, 0.3);
            border-radius: 10px;
            color: white;
            padding: 12px;
            transition: 0.3s;
        }

        .neon-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #00f2fe;
            box-shadow: 0 0 10px rgba(0, 242, 254, 0.3);
            color: white;
            outline: none;
        }
    </style>

    <div class="edit-wrapper">
        <div class="edit-card">
            <h2 class="text-center mb-4" style="color: #00f2fe; text-transform: uppercase; letter-spacing: 2px;">{{ __("app.Edit Profile") }}</h2>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="text-center mb-4">
                    <div style="position: relative; display: inline-block;">
                        <img src="{{ asset($user->profile_image) }}" id="preview"
                            style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #00f2fe; object-fit: cover;">
                        <label for="profile_image"
                            style="position: absolute; bottom: 0; right: 0; background: #00f2fe; color: #000; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                    </div>
                    <input type="file" name="profile_image" id="profile_image" class="d-none" onchange="previewImage(this)">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __("app.USERNAME") }}</label>
                    <input type="text" name="username" class="form-control neon-input" value="{{ $user->username }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __("app.BIO") }}</label>
                    <textarea name="bio" class="form-control neon-input" rows="3">{{ $user->bio }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ __("app.GITHUB URL") }}</label>
                    <input type="text" name="github_url" class="form-control neon-input" value="{{ $user->github_url }}"
                        placeholder="https://github.com/yourusername">
                </div>
 
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-info fw-bold text-dark"
                        style="box-shadow: 0 0 15px rgba(0, 242, 254, 0.4);">{{ __("app.SAVE CHANGES") }}</button>
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary btn-sm border-0 mt-2">{{ __("app.Cancel") }}</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection