@extends ('includes.header')
@section('title', 'Edit Services')
@section('content')
<form method="POST" action="{{ route('update.service', $service->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Service Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" required>{{ $service->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $service->price }}" required>
    </div>
    <div class="mb-3">
        <label for="time" class="form-label">Time (minutes)</label>
        <input type="number" class="form-control" id="time" name="time" value="{{ $service->time }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

@endsection