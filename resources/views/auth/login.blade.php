@extends('layouts.auth')
@section('title', 'Login')

@section('content')

<style>
.password-wrapper {
    position: relative;
}

#passwordEye {
    font-size: 1.5rem; /* Ukuran ikon mata */
    cursor: pointer; /* Pointer untuk menandakan bisa diklik */
    position: absolute;
    top: 70%; /* Vertically center the eye icon */
    right: 1rem;
    transform: translateY(-50%);
}

/* General Styling */
body {
    font-family: 'Figtree', sans-serif;
    background: linear-gradient(to right, #FF6F61, #FF3D39); /* Gradient background */
    color: #333;
    margin: 0;
    padding: 0;
    overflow: hidden; /* Hide overflow to prevent scrolling */
}

/* Auth Wrapper */
.auth-wrapper {
    width: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: relative;
}

/* Decorative Circles */
.circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s ease-in-out infinite;
}

.circle.small {
    width: 100px;
    height: 100px;
    top: 10%;
    left: 15%;
    animation-duration: 7s;
}

.circle.medium {
    width: 200px;
    height: 200px;
    top: 30%;
    right: 15%;
}

.circle.large {
    width: 300px;
    height: 300px;
    bottom: 10%;
    left: 50%;
    animation-duration: 9s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* Card Styling */
.card {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    background-color: white;
    padding: 2rem;
    max-width: 700px; /* Increased max-width for wider form */
    width: 100%;
    z-index: 1; /* Ensure the card is above the decorative circles */
}

.card-body {
    padding: 2rem;
    background: #fff;
    border-radius: 8px;
}

/* Button Styling */
.btn-primary {
    background-color: #4A90E2;
    border: none;
    font-weight: 600;
    padding: 15px 20px;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

.btn-primary:hover {
    background-color: #357ABD;
    transform: translateY(-3px);
}

/* Form Styling */
.form-control {
    width: 100%; /* Full width of the card */
    padding: 0.75rem;
    font-size: 1.1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 1.5rem;
}

/* Form Label Styling */
.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem; /* Spacing between label and input */
    display: block; /* Make sure label is on a new line */
}

/* Invalid Feedback */
.invalid-feedback {
    color: #e3342f;
}

/* Title Styling */
.card-header {
    background-color: #FF6F61;
    padding: 1rem;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
}

/* Welcome Back Title Styling */
.card-body h3 {
    font-size: 1.75rem;
    font-weight: bold;
    color: #4A90E2;
    text-align: center;
    margin-bottom: 1.5rem;
}

/* Background Pattern */
.auth-wrapper::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('https://www.transparenttextures.com/patterns/diagmonds-light.png');
    opacity: 0.3;
}
</style>

<div class="auth-wrapper">
    <div class="circle small"></div>
    <div class="circle medium"></div>
    <div class="circle large"></div>
    <div class="card">
        <div class="card-header">
            {{ __('Login') }}
        </div>
        <div class="card-body">
            <h3 class="text-center mb-4">{{ __('Welcome Back!') }}</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">{{ __('Username') }}</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 password-wrapper">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    <i id="passwordEye" class="bi bi-eye"></i>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>                               

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const password = document.querySelector('#password');
    const passwordEye = document.querySelector('#passwordEye');

    if (!password || !passwordEye) {
        console.error('Password input or password eye icon not found');
        return;
    }

    passwordEye.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        passwordEye.classList.toggle('bi-eye');
        passwordEye.classList.toggle('bi-eye-slash');
    });

    @if(session('success'))
        Swal.fire({
            title: 'Welcome!',
            text: `Hello, {{ session('username') }}`,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endsection