@extends('includes.header')

@section('title', 'Dashboard')

@section('content')
<form action="{{ route('login') }}" method="POST" class="mt-4">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>
@if ($errors->any())
    <p>{{ $errors->first('email') }}</p>
@endif
@endsection
