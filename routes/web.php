<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/profile/{name}/{id}', [ProfileController::class, 'show'])->name('profile.show');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Route::get('/editprofile', function(){
//     return view('profile.editprofile');
// })->middleware('auth');

Route::get('/editprofile', [AboutController::class,'showeditprofile'])->name('editprofile')->middleware('auth');
Route::post('/updateprofile',[AboutController::class,'updateprofile'])->name('updateprofile')->middleware('auth');

Route::get('/services' ,[ServiceController::class,'getservices'])->name('services')->middleware('auth');
Route::post('addservices',[ServiceController::class,'addservices'])->name('addservices')->middleware('auth');

Route::get('/delete/service/{id}',[ServiceController::class,'deleteservice'])->name('deleteservice')->middleware('auth');
Route::get('book-now/{user_id}/{id}',[ServiceController::class,'booknow'])->name('book-now');
Route::post('book-now/',[ServiceController::class,'booknowservice'])->name('booknowservice');

Route::post('/handle-payment', [ServiceController::class, 'handlePayment'])->name('handle.payment');

Route::get('/success-page',[ServiceController::class,'successpage'])->name('successpage');
Route::get('/failure-page',[ServiceController::class,'failurepage'])->name('failurepage');
