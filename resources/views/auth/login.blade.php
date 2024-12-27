@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    /* Reset default styles */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        line-height: 1.6;
        height: 100vh;
        padding: 150px;
    }

    /* Container styles for centering */
    .container {
        display: flex;
        flex-direction: column;
        align-items: center; /* Pusatkan secara horizontal */
        justify-content: center; /* Pusatkan secara vertikal */
        min-height: 100vh; /* Pastikan container memiliki tinggi minimal 100% viewport */
    }

    /* Login form styles */
    .login-container {
        background-color: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px; /* Maximum width for the form */
        text-align: center;
        margin: 20px 0; /* Jarak atas dan bawah untuk form */
    }

    .login-form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 1rem;
        text-align: left;
    }

    .form-group label {
        margin-bottom: 0.5rem;
        font-weight: bold;
        color: #333; /* Darker color for labels */
    }

    .form-group input {
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%; /* Full width for inputs */
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #007bff; /* Change border color on focus */
        outline: none; /* Remove default outline */
    }

    /* Button styles */
    .btn {
        background-color: #007bff;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn:hover {
        background-color: #0056b3;
        transform: translateY(-2px); /* Slight lift effect on hover */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .login-container {
            width: 90%; /* Adjust width for smaller screens */
        }
    }
</style>

<div class="container">
    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</div>
@endsection