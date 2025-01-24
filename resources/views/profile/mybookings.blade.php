@extends('includes.header')
@section('title','My booking Page')
@section('content')
<br><br><br>
<div class="container">
<h1>My Bookings</h1>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Price</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    @if ($appointment)
    @foreach ($appointment as $appoint)
    <td>{{ $loop->iteration }}</td>
    <td>{{ $appoint->name }}</td>
    <td>{{ $appoint->email }}</td>
    <td>{{ $appoint->mobile }}</td>
    <td>{{ $appoint->price }}</td>
    <td>{{ $appoint->date }}</td>
    <td>{{ $appoint->time }}</td>
    <td>{{ $appoint->status }}</td>
    @if ($appoint->status=='confirmed')
    <td><button onclick="confirm('Do you want to cancel the booking')" class="btn btn-danger">Cancel</button></td>
    @endif
    </tr>    
    @endforeach
    @endif
  </tbody>
</table>
</div>
@endsection