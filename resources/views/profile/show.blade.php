@extends('includes.header')

@section('title', 'Dashboard')
@section('content')
<h1>{{ $user->name }}'s Profile</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            @if(!empty($about->profile_picture))
            <div>
                <img id="image" src="{{ asset('storage/' . $about->profile_picture) }}"
                    alt="Profile Picture"
                    style="width: 350px; height: 350px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            </div>
            @else
            <div>
                <img id="image"
                    src="https://placehold.co/1500x1500/"
                    alt="Profile Picture"
                    style="width: 350px; height: 350px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            </div>
            @endif
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="col-md-6">
            <p>@if(!empty($about->about)){{ $about->about }}@endif</p>
        </div>
    </div>
</div>
@endsection