@extends ('includes.header')
@section('title', 'Edit Services')

@section('content')
<br><br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h1>Your Services</h1>
            <div class="custom-scroll">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Time</th>
                            <th scope="col">Avalibilty(Week)</th>
                            <th scope="col">Avalibilty(Hour)</th>
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
                            <td>{{ !empty($service->services_in_week) ? $service->services_in_week : 'Not Available' }}</td>

                            <td>{{ !empty($service->time_slots) ? $service->time_slots : 'Not Available'}}</td>
                            <td>
                                <a href="#">
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </a>
                                <a href="{{ route('deleteservice', ['id' => $service->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>

                                </a>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

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
                    <select class="form-select @error('time') is-invalid @enderror" id="time" name="time" onchange="generateTimeSlots()">
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

                <!-- Dynamic Time Slots Field -->
                <div id="time-slots" class="mb-3">
                    <!-- This will be populated by JS based on the time selected -->
                </div>

                <div class="mb-3">
                    <label class="form-label">Available in weeks</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services_in_week[]" value="sunday" {{ in_array('sunday', old('services_in_week', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Sunday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services_in_week[]" value="monday" {{ in_array('monday', old('services_in_week', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Monday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services_in_week[]" value="tuesday" {{ in_array('tuesday', old('services_in_week', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Tuesday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services_in_week[]" value="wednesday" {{ in_array('wednesday', old('services_in_week', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Wednesday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services_in_week[]" value="thursday" {{ in_array('thursday', old('services_in_week', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Thursday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services_in_week[]" value="friday" {{ in_array('friday', old('services_in_week', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Friday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services_in_week[]" value="saturday" {{ in_array('saturday', old('services_in_week', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Saturday
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <script>
                function generateTimeSlots() {
                    const timeSelect = document.getElementById("time");
                    const timeSlotsDiv = document.getElementById("time-slots");
                    const selectedTime = parseInt(timeSelect.value);

                    // Clear the previous time slots
                    timeSlotsDiv.innerHTML = '';

                    if (selectedTime) {
                        // Starting time: 3:00 PM (in minutes: 15:00 = 15 * 60 = 900)
                        let startTime = 15 * 60; // 3:00 PM in minutes
                        let endTime = 24 * 59; // 12:00 AM in minutes (next day)

                        // Generate time slots
                        let timeSlotCount = Math.floor((endTime - startTime) / selectedTime); // Total time slots in the given range

                        for (let i = 0; i < timeSlotCount; i++) {
                            let start = formatTime(startTime);
                            let end = formatTime(startTime + selectedTime);

                            // Append the generated time slot
                            let timeSlotHTML = `
                    <div class="mb-2">
                        <label class="form-label">${start} to ${end}</label>
                        <input type="checkbox" name="time_slots[]" value="${start} to ${end}" class="form-check-input">
                    </div>
                `;
                            timeSlotsDiv.innerHTML += timeSlotHTML;

                            // Update the start time for the next slot
                            startTime += selectedTime;
                        }
                    }
                }

                // Convert time from minutes to 12-hour format with AM/PM
                function formatTime(minutes) {
                    let hours = Math.floor(minutes / 60); // Get hour part
                    let mins = minutes % 60; // Get minute part
                    let ampm = hours >= 12 ? 'PM' : 'AM'; // Determine AM/PM

                    hours = hours % 12; // Convert to 12-hour format
                    if (hours === 0) hours = 12; // Handle 12:00 case

                    mins = mins < 10 ? '0' + mins : mins; // Ensure two digits for minutes

                    return `${hours}:${mins} ${ampm}`;
                }
            </script>

        </div>
    </div>

</div>




@endsection