@extends('includes.header')

@section('title', 'Dashboard')

@section('content')
<h1>{{ $user->name }}'s Profile</h1>
<p>Email: {{ $user->email }}</p>
@endsection
