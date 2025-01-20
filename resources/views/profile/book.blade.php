@extends('includes.header')

@section('title', 'Book Now')

@section('content')
<br><br><br>
<!-- <h1>{{ $user->name }}'s Profile</h1> -->
<h1>Book Now</h1>
<div class="container">
    <form method="POST" action="{{ route('booknowservice')}}">
        @csrf
        <!-- Name -->
         <div class="mb-3">
         <input type="hidden" name="user_id" value="{{ $user->id }}">
         </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" placeholder="Enter your full name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Mobile -->
        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile</label>
            <input type="number" placeholder="Enter your mobile number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" required>
            @error('mobile')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" placeholder="Enter your email id" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Date Selection -->
        <div class="mb-3">
            <label for="date" class="form-label">Day</label>
            <input type="hidden" id="date" name="date">
            <div class="d-flex gap-3 flex-wrap">
                @if (!empty($service->services_in_week))
                @if (is_array($upcoming_dates))
                @foreach ($upcoming_dates as $day)
                <div class="date-card" data-date="2025-01-21">{{ $day['day'] }}</div>
                @endforeach
                @endif
                @endif
            </div>
        </div>

        <!-- Time Slot Selection -->
        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="hidden" id="time" name="time">
            <div class="row row-cols-3 row-cols-md-4 g-2">

                @if (!empty($available_time))
                @foreach ($available_time as $time)
            <div class="col">
                <div class="time-slot" data-time="08:00 AM"> 
                {{ $time }}
                </div>
            </div>
            @endforeach
            @endif
            </div>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" value="{{ $service->price }}" id="price" name="price" readonly>
        </div>

        
        <button type="submit" class="btn btn-primary">Book Now</button>
</div>
</form>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Handle date selection
    document.querySelectorAll('.date-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.date-card').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('date').value = this.getAttribute('data-date');
        });
    });

    // Handle time slot selection
    document.querySelectorAll('.time-slot').forEach(slot => {
        slot.addEventListener('click', function() {
            document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('time').value = this.getAttribute('data-time');
        });
    });

    // Set default values for date and time
    document.getElementById('date').value = document.querySelector('.date-card.active').getAttribute('data-date');
    document.getElementById('time').value = '';
</script>
</div>



@endsection