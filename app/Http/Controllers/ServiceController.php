<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\models\service;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use carbon\carbon;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

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
        'time' => 'required',
        'services_in_week' => 'nullable',
        'time_slots' => 'nullable',
    ]);

    // Check if the user is authenticated
    $user = Auth::user();
    if (!$user) {
        return redirect('login')->withErrors('You must log in to add services to your account.');
    }
    $time_slots = $request->input('time_slots',[]);
    $time = json_encode($time_slots);
    $availableDays = $request->input('services_in_week', []);
    $services_in_weeks = json_encode($availableDays);

    // Create or retrieve the service associated with the user
    $service = Service::create([
        'user_id' => $user->id,
        'name' => $request->input('name'),
        'description' => $request->input('description', ''),
        'rating' => 0,
        'price' => $request->input('price'),
        'time' => $request->input('time'),
        'services_in_week' => $services_in_weeks,
        'time_slots' => $time,
    ]);

    // Save the service
    $service->save();

    // Redirect to the services view with the service data
    return redirect()->route('services')->with('service', $service);

}

public function deleteservice($id)
{
    $user = Auth::user();
    if (!$user) {
        return redirect('login')->withErrors('You must log in to delete a service.');
    }

    $service = Service::find($id);
    if (!$service) {
        return redirect()->back()->with('error', 'Service not found.');
    }

    $service->delete();

    return redirect()->route('services')->with('success', 'Service deleted successfully.');
}

public function edit($id)
{
    $service = Service::find($id);
    if (!$service) {
        return response()->json(['error' => 'Service not found'], 404);
    }
    return view('profile.services', compact('service'));
}

public function booknow($user_id,$id){
    $user = User::find($user_id);
    if(!$user){
        return response()->json(['error' => 'User not found']);
    }
    $service = Service::find($id);
    if(!$service){
        return response()->json(['error' => 'Service not find']);
    }
    // $service->services_in_week = json_decode($service->services_in_week, true);
    $availability_days = $service->services_in_week = json_decode($service->services_in_week, true);
    // $service->time_slots = json_decode($service->time_slots,true);

    $available_time = $service->time_slots = json_decode($service->time_slots);


    $start_date = carbon::now();


    $upcoming_dates = [];

    for ($i = 0; $i < 7; $i++) {
        // Clone the start date and add $i days
        $current_day = $start_date->copy()->addDays($i);
    
        // Get the name of the day (e.g., "friday")
        $day_name = strtolower($current_day->format('l'));

        
    
        // Check if the day name is in the list of available days
        if (in_array($day_name, $availability_days)) {
            $upcoming_dates[] = [
                // 'date' => $current_day->format('Y-m-d'), // Format as '2025-01-19'
                'day' => $current_day->format('l, d M') // Format as 'Friday, 19 Jan'
            ];
        }
    }
    
    $service->services_in_week = $upcoming_dates ;
    


    return view('profile.book', compact('user', 'service','upcoming_dates','available_time'));

}


public function booknowservice(Request $request){
    $request->validate([
        'name' => 'required|string', // Ensures name is required and must be a string
        'mobile' => 'required|numeric', // Ensures mobile is required and numeric
        'email' => 'required|email', // Ensures email is required and in a valid email format
        'date' => 'required|date', // Ensures date is required and in a valid date format
        'time' => 'required', // Ensures time is required
        'price' => 'required|numeric', // Ensures price is required and numeric
    ]);

    // dd($request->all());


    $appointment = Appointment::create([
        'user_id' => $request->input('user_id'),
        'name' => $request->input('name'),
        'mobile' => $request->input('mobile'),
        'email' => $request->input('email'),
        'date' => $request->input('date'),
        'time' => $request->input('time'),
        'price' => $request->input('price'),
        'status' => 'pending', // Set default status
    ]);

    $appointment->save();
    
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $orderData = [
        'receipt'         => 'order_rcptid_' . time(), // Unique receipt ID
        'amount'          => $request->price * 100,   // Amount in paise (convert INR to paise)
        'currency'        => 'INR',
        'payment_capture' => 1                        // Auto capture payment
    ];

    try {
        $razorpayOrder = $api->order->create($orderData);

        // Step 4: Return the Razorpay order details to the view
        return view('profile.checkout', [
            'orderId' => $razorpayOrder['id'],
            'amount'  => $request->price * 100,
            'key'     => env('RAZORPAY_KEY'),
            'request' => $request->all(),
            'appointmentId' => $appointment->id,
        ]);
    } catch (\Exception $e) {
        Log::error("Razorpay Error: " . $e->getMessage());
        return back()->with('error', 'There was an error creating the Razorpay order.');
    }


}


public function handlePayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $payment = $api->payment->fetch($request->razorpay_payment_id);

            if ($payment['status'] === 'captured') {

                $appointment = Appointment::find($request->appointment_id);
                if($appointment){
                    $appointment->update(['status'=>'confirmed']);
                }
                // Payment successful
                return redirect()->route('successpage')->with('success', 'Payment Successful!');
            } else {
                return redirect()->route('failurepage')->with('error', 'Payment Failed!');
            }
        } catch (\Exception $e) {
            Log::error("Razorpay Payment Error: " . $e->getMessage());
            return back()->with('error', 'Error processing Razorpay payment');
        }
    }

    public function successpage(){
        return view('profile.success');
    }

    public function failurepage(){
        return view('profile.failure');
    }

}
