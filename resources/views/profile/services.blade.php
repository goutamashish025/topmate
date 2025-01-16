@extends ('includes.header')
@section('title', 'Edit Services')

@section('content')
<br><br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h1>Your Services</h1>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">S.no</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($services))
                @foreach ($services as $service)                            
                <tr>
                <th scope="row">1</th>
                <td>{{ $service->name }}</td>
                <td>{{ $service->description }}</td>
                <td>${{ $service->price }}</td>
                <td>{{ $service->time }} minutes</td>
                <td>
                <a href="#">
                <button type="button" class="btn btn-primary">Edit</button>
                </a>
                <a href="#">
                <button type="button" class="btn btn-danger">Delete</button></td>
                </a>
                </tr>
                @endforeach   
                @endif
            </tbody>
            </table>

        </div>
        <div class="col-md-4">
        <form method="POST" action="{{ route('addservices') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Add your Service</label>
        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="servicename" name="name">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6">{{ old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input value="{{ old('price') }}" type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price">
        @error('price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="time" class="form-label">Time</label>
        <select class="form-select @error('time') is-invalid @enderror" id="time" name="time">
            <option value="" selected>Open this select menu</option>
            <option value="15" {{ old('time') == 15 ? 'selected' : '' }}>15 mins</option>
            <option value="30" {{ old('time') == 30 ? 'selected' : '' }}>30 mins</option>
            <option value="45" {{ old('time') == 45 ? 'selected' : '' }}>45 mins</option>
            <option value="60" {{ old('time') == 60 ? 'selected' : '' }}>60 mins</option>
            <option value="120" {{ old('time') == 120 ? 'selected' : '' }}>120 mins</option>
        </select>
        @error('time')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>

</div>




@endsection