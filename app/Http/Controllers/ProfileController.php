<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\About;
use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($name, $id)
    {
        // Retrieve the user by name and ID
        $url = str_replace('-', ' ', $name);
        $user = User::where('id', $id)->where('name', $url)->first();


        // If the user is not found, return a 404 or redirect
        $about = About::where('user_id', $id)->first();

       

        if(!$user){
            return redirect()->route('login')->withErrors('You must login to update the profile');
        }
        $services = Service::where(['user_id' => $user->id])->get();



        // Return the profile view with the user data
        return view('profile.show', compact('user','about','services'));
        // return $user;
    }

    public function showeditprofile(){
        return view('profile.editprofile');
    }
}
