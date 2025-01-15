@extends('includes.header')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-center">Welcome to the Dashboard</h1>
    <p class="text-center">Hello, {{ Auth::user()->name }}! You are logged in.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <p class="card-text">Manage your profile information here.</p>
                    <a href="{{ route('editprofile') }}" class="btn btn-primary">Go to Profile</a>
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Notifications</h5>
                    <p class="card-text">Check your latest notifications here.</p>
                    <a href="#" class="btn btn-primary">View Notifications</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Services</h5>
                    <p class="card-text">Update your services and preferences here.</p>
                    <a href="{{ route('services') }}" class="btn btn-primary">Go to Services</a>
                </div>
            </div>
        </div>
    </div>
@endsection
