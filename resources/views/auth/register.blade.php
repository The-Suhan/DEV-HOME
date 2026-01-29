@extends('layouts.app')

@section('home-section')
<div class="dh-register-container">
    <div class="dh-form-section">
        <h2>Sign Up</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="dh-input-group">
                <input type="text" name="username" required>
                <label>Username</label>
                <span style="position: absolute; right: 5px; color: #fff;">&#128100;</span>
            </div>
            <div class="dh-input-group">
                <input type="email" name="email" required>
                <label>Email</label>
                <span style="position: absolute; right: 5px; color: #fff;">&#128231;</span>
            </div>
            <div class="dh-input-group">
                <input type="password" name="password" required>
                <label>Password</label>
                <span style="position: absolute; right: 5px; color: #fff;">&#128274;</span>
            </div>
            <button type="submit" class="dh-neon-btn">Sign Up</button>
            <p style="color: #fff; text-align: center; margin-top: 15px;">
                Already have an account? <a href="{{ route('login') }}" style="color: #00f2fe;">Login</a>
            </p>
        </form>
    </div>
    <div class="dh-info-section">
        <h1 style="font-size: 40px;">JOIN US!</h1>
        <p>Don’t just write code, be a part of it. Join us to connect with thousands of developers, 
            keep your finger on the pulse of the tech world, and share your experiences.</p>
    </div>
</div>
@endsection