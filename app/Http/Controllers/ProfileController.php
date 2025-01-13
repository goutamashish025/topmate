<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\About;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($name, $id)
    {
        // Retrieve the user by name and ID
        $url = str_replace('-', ' ', $name);
        $user = User::where('id', $id)->where('name', $url)->first();


        // If the user is not found, return a 404 or redirect
        if (!$user) {
            return abort(404, 'User not found');
        }
        $about = About::where('user_id', $user->id)->first();


        // Return the profile view with the user data
        return view('profile.show', compact('user','about'));
        // return $user;
    }

    public function showeditprofile(){
        return view('profile.editprofile');
    }
}
