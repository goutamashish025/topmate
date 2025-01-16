<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\models\service;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getservices(){
        $user = Auth::user();
        if(!$user){
            return redirect('login')->withErrors('You must login to your account to view your services.');
        }

        $services = Service::where('user_id', $user->id)->get();
        

        return view('profile.services',compact('services'));
    }

    public function addservices(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255', // Validates the name
        'description' => 'nullable|string',  // Optional description
        'price' => 'required',       // Validates price as a number
        'time' => 'required',        // Corrected 'number' to 'integer'
    ]);

    // Check if the user is authenticated
    $user = Auth::user();
    if (!$user) {
        return redirect('login')->withErrors('You must log in to add services to your account.');
    }

    // Create or retrieve the service associated with the user
    $service = Service::create([
        'user_id' => $user->id,
        'name' => $request->input('name'),
        'description' => $request->input('description', ''),
        'rating' => 0,
        'price' => $request->input('price'),
        'time' => $request->input('time'),
    ]);

    // Save the service
    $service->save();

    // Redirect to the services view with the service data
    return view('profile.services', compact('service'));
}

}
