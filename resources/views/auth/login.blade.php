@extends('layouts.app')

@section('home-section')
    <div class="dh-auth-container">
        <div class="dh-form-section">
            <h2>{{ __("app.Login") }}</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="dh-input-group">
                    <input type="text" name="email" required>
                    <label>{{ __("app.Email") }}</label>
                    <span style="position: absolute; right: 5px; color: #fff;">&#128100;</span>
                </div>
                <div class="dh-input-group">
                    <input type="password" name="password" required>
                    <label>{{ __("app.Password") }}</label>
                    <span style="position: absolute; right: 5px; color: #fff;">&#128274;</span>
                </div>
                <button type="submit" class="dh-neon-btn">{{ __("app.Login") }}</button>
                <p style="color: #fff; text-align: center; margin-top: 15px;">
                    {{ __("app.Don`t have an account?") }} <a href="{{ route('register') }}"
                        style="color: #00f2fe;">{{ __("app.Sign Up") }}</a>
                </p>
            </form>
        </div>
        <div class="dh-info-section">
            <h1 style="font-size: 40px;">{{ __("app.WELCOME") }}<br>{{ __("app.BACK!") }}</h1>
            <p>{{ __("app.Welcome back to your digital home. Grab your coffee, fire up your terminal, and see what’s happening with your peers. We missed you!") }}</p>
        </div>
    </div>

@endsection