@extends('includes.header')

@section('title', 'Dashboard')

@section('content')
<form action="{{ route('register') }}" method="POST" class="mt-4">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
        @if ($errors->has('username'))
        <p style="color: red;">{{ $errors->first('username') }}</p>
        @endif
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        @if ($errors->has('email'))
        <p style="color: red;">{{ $errors->first('email') }}</p>
        @endif
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>

@endsection
