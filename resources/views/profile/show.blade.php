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
            <ul class="social-icons">
        <li>
            @if(!empty($about->linkedin))
            <a href="{{ $about->linkedin}}" target="_blank" title="LinkedIn" class="linkedin">
                <i class="fab fa-linkedin"></i>
            </a>
            @endif
        </li>
        <li>
            @if(!empty($about->instagram))
            <a href="{{ $about->instagram }}" target="_blank" title="Instagram" class="instagram">
                <i class="fab fa-instagram"></i>
            </a>
            @endif
        </li>
        <li>
            @if(!empty($about->x))
            <a href="{{ $about->x }}" target="_blank" title="X (formerly Twitter)" class="x">
                <i class="fab fa-x-twitter"></i>
            </a>
            @endif
        </li>
        <li>
            @if(!empty($about->portfolilio_website))
            <a href="{{ $about->portfolilio_website }}" target="_blank" title="Portfolio Website" class="portfolio">
                <i class="fas fa-globe"></i>
            </a>
            @endif
        </li>
    </ul>
        </div>
        <div class="col-md-6">
        <div class="row">
        @if ($services->isNotEmpty())
            @foreach($services as $service)
            <div class="col-sm-6 mb-3 mb-sm-0">
                <a href="{{ route('book-now',['user_id'=>$user->id,'id' => $service->id ])}}" class="card-link" style="text-decoration: none; color: inherit;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5>
                            <p class="card-text">{{ $service->description }}</p>
                            <button class="btn btn-secondary" disabled>${{ $service->price }}</button>
                            <button class="btn btn-light" disabled><i class="fas fa-clock"></i> {{ $service->time }} Minutes</button>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach
            @endif
        </div>
        <div class="container">
            @if(!empty($about))
            <h1>About me</h1>
            <p>{{$about->about}}</p>
            @endif
        </div>
            
        </div>
    </div>
</div>
@endsection