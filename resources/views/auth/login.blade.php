@extends('layouts.app')

@section('home-section')
<div class="dh-auth-container">
    <div class="dh-form-section">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="dh-input-group">
                <input type="text" name="email" required>
                <label>Email</label>
                <span style="position: absolute; right: 5px; color: #fff;">&#128100;</span>
            </div>
            <div class="dh-input-group">
                <input type="password" name="password" required>
                <label>Password</label>
                <span style="position: absolute; right: 5px; color: #fff;">&#128274;</span>
            </div>
            <button type="submit" class="dh-neon-btn">Login</button>
            <p style="color: #fff; text-align: center; margin-top: 15px;">
                Don't have an account? <a href="{{ route('register') }}" style="color: #00f2fe;">Sign Up</a>
            </p>
        </form>
    </div>
    <div class="dh-info-section">
        <h1 style="font-size: 40px;">WELCOME <br> BACK!</h1>
        <p>Welcome back to your digital home. Grab your coffee, fire up your terminal, and see what’s happening with
            your peers. We missed you!</p>
    </div>
</div>

@endsection