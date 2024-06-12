@extends('admin.layouts.auth')

@section('content')
    <h2>Register</h2>
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        <input type="text" class="form-control" id="role" name="role" required value="admin" style="display: none">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('admin.login') }}">Already have an account? Login</a>
        </div>
    </form>
@endsection
