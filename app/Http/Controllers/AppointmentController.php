<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function showmybookings(){
        $user = Auth::user();
        if(!$user){
            return redirect('login')->withErrors('You must login to your account to view your bookings');
        }
        $appointment = Appointment::where('user_id',$user->id)->get();
        // echo '<pre>';
        // print_r($appointment);
        return view('profile.mybookings',compact('appointment'));
    }
}
