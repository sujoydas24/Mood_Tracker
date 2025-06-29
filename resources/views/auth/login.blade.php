@extends('auth.layout')

@section('main')

{{-- Main Container --}}
    <main class="container my-5 d-flex justify-content-center">
        <div class="card shadow-sm w-100" style="max-width: 400px;">
            <div class="card-body">
                <h4 class="card-title mb-4 text-center">Login</h4>

                {{-- Error message --}}
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <p class="text-center">
                        Don't have an account? <a href="{{ route('register') }}">Register here</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

@endsection
