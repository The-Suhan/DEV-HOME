@extends('layouts.app')

@section('home-section')
<style>
    .about-body { background-color: #0d1117; color: white; overflow-x: hidden; }
    
    .hero-section { height: 400px; display: flex; justify-content: center; align-items: center; position: relative; }
    #dev-logo { width: 370px; position: absolute; opacity: 0; transition: all 1s ease-in-out; }
    #dev-text { font-size: 4rem; font-weight: bold; color: #00f2fe; text-shadow: 0 0 20px rgba(0,242,254,0.5); z-index: 2; transition: all 1s ease-in-out; }

    .neon-card-about { background: #161b22; border: 1px solid #30363d; transition: 0.3s; cursor: pointer; border-radius: 15px; }
    .neon-card-about:hover { border-color: #00f2fe; box-shadow: 0 0 20px rgba(0,242,254,0.2); transform: translateY(-5px); }

    .founder-img { width: 100%; height: 300px; object-fit: cover; border-radius: 15px; border: 2px solid #30363d; transition: 0.5s; }
    .founder-img:hover { border-color: #ff4757; transform: scale(1.02); }
    .life-text { font-size: 5rem; font-weight: 900; letter-spacing: 15px; color: #0d1117; -webkit-text-stroke: 1px #00f2fe; text-shadow: 0 0 30px #00f2fe; }
</style>

<div class="container-fluid about-body">
    <section class="hero-section">
        <img src="{{ asset('images/favicon.png') }}" id="dev-logo" alt="Logo">
        <div id="dev-text">DEV HOME &lt;/&gt;</div>
    </section>

    <section class="container my-5">
        <h2 class="text-center mb-5 text-white-50">Why DEV HOME?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 neon-card-about h-100 text-center">
                    <h5 class="text-info">Why DEV HOME?</h5>
                    <p class="text-white-50 mt-3">Because here, ideas don't just stay in code; they turn into real projects.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 neon-card-about h-100 text-center">
                    <h5 class="text-info">How can we help you?</h5>
                    <p class="text-white-50 mt-3">You can get instant support from the entire community while working on your own project.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 neon-card-about h-100 text-center">
                    <h5 class="text-info">How to Development?</h5>
                    <p class="text-white-50 mt-3">At the heart of the IT world, constantly moving forward with the latest technologies.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5 py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead text-white" style="font-size: 1.5rem; line-height: 1.8;">
                    DEV HOME - this is a community for IT developers. Here you can work on your own projects or help others with theirs. It's not just about projects; it's also a social environments
                    where you can share your knowledge, learn from others, and grow together. Whether you're a beginner or an experienced developer, DEV HOME is the place to be for anyone passionate about coding and technology.
                </p>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="text-center mb-5 text-info">Meet The Builders</h2>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x500" class="founder-img mb-3" alt="Founder">
                <h4>Founder Name</h4>
                <p class="text-info small">Lead Architect</p>
            </div>
            </div>
        <div class="text-center mt-5">
            <p class="text-white-50 mb-0">We are all one</p>
            <h1 class="life-text">LIFE</h1>
        </div>
    </section>
</div>

<script>
    window.onload = function() {
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