<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEV HOME </>
    </title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/fancybox.umd.js') }}"></script>
    <script src="{{ asset('js/splide.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/fonts/bootstrap-icons.woff') }}">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
</head>

<body style="background-color: #0C2935;">

    @auth
        @include('app.sidebar')
    @endauth


    <main class="{{ Auth::check() ? 'content-with-sidebar' : 'content-full-center' }}">
        @yield('home-section')
    </main>

    <div class="modal fade text-white" id="reportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark border-secondary">
                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="reportable_id" id="modal-reportable-id">
                    <input type="hidden" name="reportable_type" id="modal-reportable-type">

                    <div class="modal-header border-secondary">
                        <h5 class="modal-title text-warning"><i
                                class="fas fa-exclamation-triangle"></i>{{ __("app.Submit a Report") }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="small text-muted text-white">
                            {{ __("app.Please select the reason for reporting this") }} <span
                                id="report-type-text">{{ __("app.content") }}</span>:</p>
                        <select name="reason" class="form-select bg-secondary text-white border-0 mb-3" required>
                            <option value="">{{ __("app.Choose a reason") }}...</option>
                            <option value="Spam">{{ __("app.Spam") }}</option>
                            <option value="Inappropriate Content">{{ __("app.Inappropriate Content") }}</option>
                            <option value="Harassment">{{ __("app.Harassment") }}</option>
                            <option value="Copyright Violation">{{ __("app.Copyright Violation") }}</option>
                            <option value="Other">{{ __("app.Other") }}</option>
                        </select>
                        <textarea name="description" class="form-control bg-secondary text-white border-0"
                            placeholder="Optional details..." rows="3"></textarea>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light"
                            data-bs-dismiss="modal">{{ __("app.Cancel") }}</button>
                        <button type="submit"
                            class="btn btn-warning text-dark fw-bold">{{ __("app.Send Report") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <script>
        $(document).ready(function () {
            $('#follow-btn').on('click', function (e) {
                e.preventDefault();

                let userId = $(this).data('id');
                let btn = $(this);
                let countSpan = $('#follower-count');

                $.ajax({
                    url: '/subscribe/toggle',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId
                    },
                    success: function (response) {
                        if (response.status == 'followed') {
                            btn.text('Unfollow').removeClass('btn-info').addClass('btn-outline-danger');
                        } else {
                            btn.text('Follow').removeClass('btn-outline-danger').addClass('btn-info');
                        }
                        countSpan.text(response.followers_count);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $('.btn-like').click(function () {
            let repoId = $(this).data('id');
            let icon = $('#like-icon-' + repoId);
            let countSpan = $('#like-count-' + repoId);

            $.ajax({
                url: '/like/' + repoId,
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function (response) {
                    if (response.status == 'liked') {
                        icon.removeClass('bi-heart text-info').addClass('bi-heart-fill text-danger');
                    } else {
                        icon.removeClass('bi-heart-fill text-danger').addClass('bi-heart text-info');
                    }
                    countSpan.text(response.count);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.post-like-btn', function (e) {
                e.preventDefault();

                let postId = $(this).data('id');
                let icon = $('#like-icon-' + postId);
                let countSpan = $('#like-count-' + postId);

                $.ajax({
                    url: '/like-post/' + postId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 'liked') {
                            icon.removeClass('bi-heart text-white').addClass('bi-heart-fill text-danger');
                        } else {
                            icon.removeClass('bi-heart-fill text-danger').addClass('bi-heart text-white');
                        }
                        countSpan.text(response.like_count);
                    }
                });
            });
        });
    </script>
</body>


</html>