@extends('layouts.app')

@section('home-section')
    <style>

    </style>

    <div class="container-fluid about-body">
        <section class="hero-section">
            <img src="{{ asset('images/favicon.png') }}" id="dev-logo" alt="Logo">
            <div id="dev-text">DEV HOME &lt;/&gt;</div>
        </section>

        <section class="container my-5">
            <h2 class="text-center mb-5 text-white-50">{{ __("app.Why DEV HOME?") }}</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 neon-card-about h-100 text-center">
                        <h5 class="text-info">{{ __("app.Why DEV HOME?") }}</h5>
                        <p class="text-white-50 mt-3">
                            {{ __("app.Because here, ideas don't just stay in code; they turn into real projects.") }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 neon-card-about h-100 text-center">
                        <h5 class="text-info">{{ __("app.How can we help you?") }}</h5>
                        <p class="text-white-50 mt-3">{{ __("app.You can get instant support from the entire community while working on your own project.") }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 neon-card-about h-100 text-center">
                        <h5 class="text-info">{{ __("app.How to Development?") }}</h5>
                        <p class="text-white-50 mt-3">{{ __("app.At the heart of the IT world, constantly moving forward with the latest technologies.") }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="container my-5 py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8 neon-card-about p-5">
                    <h1 class="text-info">{{ __("app.About us") }}</h1>
                    <p class="lead text-white fst-italic" style="font-size: 1.5rem; line-height: 1.9;">{{ __("app.DEV HOME - this is a community for IT developers. Here you can work on your own projects or help others with theirs. It`s not just about projects; it1s also a social environments where you can share your knowledge, learn from others, and grow together. Whether you`re a beginner or an experienced developer, DEV HOME is the place to be for anyone passionate about coding and technology.") }}
                    </p>
                </div>
            </div>
        </section>

        <section class="container my-5">
            <h2 class="text-center mb-5 text-info">{{ __("app.Meet The Builders") }}</h2>
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <img src="{{ asset('images/Teachers/me.png') }}" class="founder-img mb-3" alt="Founder">
                    <h4>{{ __("app.Suhanberdi Begenjow") }}</h4>
                    <p class="text-info small">{{ __("app.Lead Architect") }}</p>
                </div>
                <div class="col-md-3">
                    <img src="{{ asset('images/Teachers/Handurdy Teacher.png') }}" class="founder-img mb-3" alt="Founder">
                    <h4>{{ __("app.Handurdy Pirliyew") }}</h4>
                    <p class="text-info small">{{ __("app.Lead Backend") }}</p>
                </div>
                <div class="col-md-3">
                    <img src="{{ asset('images/Teachers/Maisa Teacher.png') }}" class="founder-img mb-3" alt="Founder">
                    <h4>{{ __("app.Maysa Şadurdyýewa") }}</h4>
                    <p class="text-info small">{{ __("app.Lead Front-end") }}</p>
                </div>
                <div class="col-md-3">
                    <img src="{{ asset('images/Teachers/Nurmyrat Teacher.png') }}" class="founder-img mb-3" alt="Founder">
                    <h4>{{ __("app.Nurmyrat Gurbanliyew") }}</h4>
                    <p class="text-info small">{{ __("app.Lead Database") }}</p>
                </div>
            </div>
        </section>
        <footer class="main-footer mt-auto">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <a href="/" class="footer-logo-text mb-3 d-block">
                            DEV HOME &lt;/&gt;
                        </a>
                        <p>{{ __("app.Forging Digital Worlds, Together.") }}</p>
                        <div class="social-icons mt-3">
                            <a href="https://tiktok.com/@suhan_09.06"><i class="bi bi-tiktok"></i></a>
                            <a href="https://www.instagram.com/suhan_09.06?igsh=NmViMDI1ejduamZ2"><i
                                    class="bi bi-instagram"></i></a>
                            <a href="https://github.com/The-Suhan"><i class="bi bi-github"></i></a>
                            <a href="http://suxanoff17@gmail.com/"><i class="bi bi-envelope"></i></a>
                            <a href="https://t.me/B_Suhan"><i class="bi bi-telegram"></i></a>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom text-center">
                    <p>&copy; 2026 <strong>DEV HOME</strong>. All rights reserved.</p>
                </div>
            </div>
        </footer>

    </div>

    <script>
        window.onload = function () {
            const logo = document.getElementById('dev-logo');
            const text = document.getElementById('dev-text');

            setTimeout(() => {
                logo.style.opacity = '1';
                logo.style.transform = 'translateX(-250px)';

                text.style.transform = 'translateX(100px)';

            }, 3000);
        };
    </script>
@endsection