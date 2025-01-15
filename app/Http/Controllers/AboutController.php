<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\About;
use App\models\service;
use Illuminate\Support\Facades\Storage;

ini_set('memory_limit', '512M');
ini_set('max_execution_time', 300); // 5 minutes

class AboutController extends Controller
{
    public function showeditprofile(){
        return view('profile.editprofile');
    }

    public function updateprofile(Request $request){
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'about' => 'nullable|string|max:1000',
            'linkedin' => 'nullable|string',
            'x' => 'nullable|string',
            'instagram' => 'nullable|string',
            'portfolio_website' => 'nullable|string',
        ]);

        $user = Auth::user();

        if(!$user){
            return redirect()->route('login')->withErrors('You must login to update the profile');
        }

        $about_id = About::firstOrCreate(['user_id' => $user->id]);

        $services = Service::where(['user_id' => $user->id])->get();
        dd($services);
        die();
        

        if($request->hasFile('profile_picture')){
            if($about_id->profile_picture){
                Storage::delete($about_id->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_picture', 'public');
            $about_id->profile_picture = $path;
        }
        $about_id->about = $request->input('about');
        $about_id->linkedin = $request->input('linkedin');
        $about_id->x = $request->input('x'); // X (formerly Twitter)
        $about_id->instagram = $request->input('instagram');
        $about_id->portfolilio_website = $request->input('portfolio_website');

        $about_id->save();

        return view('profile.editprofile', compact('about_id','services'));


    }
    
}