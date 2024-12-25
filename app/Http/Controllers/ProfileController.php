<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($name, $id)
    {
        // Retrieve the user by name and ID
        $zzz = str_replace('-', ' ', $name);
        $user = User::where('id', $id)->where('name', $zzz)->first();

        // If the user is not found, return a 404 or redirect
        if (!$user) {
            return abort(404, 'User not found');
        }

        // Return the profile view with the user data
        return view('profile.show', compact('user'));
        // return $user;
    }
}
