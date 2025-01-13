@extends('includes.header')

@section('title', 'Edit Profile')

@section('content')
<h1>Edit Profile</h1>
<p>Name: {{ auth()->user()->name }}</p>
<p>Email: {{ auth()->user()->email }}</p>
<p>About: Hello my name is {{ auth()->user()->name }} and my email id is {{ auth()->user()->email }}</p>

<form method="POST" enctype="multipart/form-data" action="{{ route('updateprofile') }}">
    @csrf
    <div class="mb-3">
        <label for="profile_picture" class="form-label">Profile Picture</label>

        <!-- Display current image if it exists -->
        @if(!empty($about_id->profile_picture))
        <div>
            <img id="imagePreview" src="{{ asset('storage/' . $about_id->profile_picture) }}"
            alt="Profile Picture"
            style="max-width: 350px; max-height: 350px; margin-bottom: 10px;">
        </div>
        @else
        <div>
            <img id="imagePreview"
                src="https://placehold.co/1500x1500/"
                alt="Profile Picture"
                style="max-width: 150px; max-height: 150px; margin-bottom: 10px;">
        </div>
        @endif

        <!-- File input -->
        <input class="form-control" type="file" id="profile_picture" name="profile_picture" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="about" class="form-label">Add your about here</label>
        <textarea class="form-control" id="about" name="about" rows="6">{{ old('about', $about_id->about ?? '') }}</textarea>
    </div>
    <div class="mb-3">
        <label for="linkedin" class="form-label">Linkedin</label>
        <input type="text" value="{{ old('linkedin', $about_id->linkedin ?? '') }}" class="form-control" id="linkedin" name="linkedin">
    </div>
    <div class="mb-3">
        <label for="x" class="form-label">X</label>
        <input value="{{ old('x', $about_id->x ?? '') }}" type="text" class="form-control" id="x" name="x">
    </div>
    <div class="mb-3">
        <label for="instagram" class="form-label">Instagram</label>
        <input value="{{ old('instagram', $about_id->instagram ?? '') }}" type="text" class="form-control" id="instagram" name="instagram">
    </div>
    <div class="mb-3">
        <label for="portfoliowebsite" class="form-label">Portfolio website</label>
        <input value="{{ old('portfolilio_website', $about_id->portfolilio_website ?? '') }}" type="text" class="form-control" id="portfoliowebsite" name="portfolio_website">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection