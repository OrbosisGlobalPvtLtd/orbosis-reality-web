<?php

namespace App\Http\Controllers\API\User;

use Auth;
use App\Models\Booking;
use App\Models\Setting;
use App\Models\Homepage;
use App\Models\Property;
use App\Mail\userBooking;
use App\Helpers\MailHelper;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;

class MyBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function store(Request $request){

        $user = Auth::guard('api')->user();

        $rules = [
            'property_id'=>'required',
            'booking_time'=>'required',
            'booking_date'=>'required',
            'guests'=>'required',
            'name'=>'required',
            'city'=>'required',
            'phone'=>'required',
        ];
        $customMessages = [
            'property_id.required' => trans('user_validation.Property id is required'),
            'booking_time.required' => trans('user_validation.Booking Time is required'),
            'booking_date.unique' => trans('user_validation.Bookig date already exist'),
            'guests.required' => trans('user_validation.Guests is required'),
            'name.required' => trans('user_validation.Name is required'),
            'city.required' => trans('user_validation.City is required'),
            'zip_code.required' => trans('user_validation.Zip Code is required'),
            'email.required' => trans('user_validation.Email is required'),
            'phone.required' => trans('user_validation.Phone is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $property = Property::find($request->property_id);
        if (!$property) {
            return response()->json(['message' => trans('user_validation.Property not found')], 404);
        }
        if ($property->availability_status !== 'available') {
            return response()->json(['message' => trans('This property is already ' . $property->availability_status)], 403);
        }

        $duplicate = Booking::where('property_id', $request->property_id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->exists();
        if ($duplicate) {
            return response()->json(['message' => trans('This slot is already booked for this property.')], 403);
        }

        $booking = new Booking();
        $booking->property_id = $request->property_id;
        $booking->agent_id = $property->agent_id;
        $booking->user_id = $user->id;
        $booking->booking_time = $request->booking_time;
        $booking->booking_date = $request->booking_date;
        $booking->guests = $request->guests;
        $booking->name = $request->name;
        $booking->city = $request->city;
        $booking->zip_code = $request->zip_code;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->comment = $request->comment;
        $booking->save();

        $notification = trans('user_validation.Booking Created Successfully');
        return response()->json(['message' => $notification]);

    }


    public function index()
    {
        $user = Auth::guard('api')->user();

        $bookings = Booking::with('property')->where('agent_id', $user->id)->paginate(10);

        return response()->json(['bookings' => $bookings]);

    }


    public function show($id)
    {
        $user = Auth::guard('api')->user();

        $booking = Booking::with('property')->where('agent_id', $user->id)->where('id', $id)->first();

        if(!$booking){
            $notification = trans('Not Found');
            return response()->json(['message' => $notification], 403);
        }

        return response()->json(['booking' => $booking]);

    }

    public function update(Request $request, $id)
    {

        $user = Auth::guard('api')->user();

        $booking = Booking::with('property')->where('agent_id', $user->id)->where('id', $id)->first();

        if(!$booking){
            $notification = trans('Not Found');
            return response()->json(['message' => $notification], 403);
        }

        $booking->status = $request->status;
        $booking->save();

        $property = $booking->property;
        if ($property) {
            if ($booking->status == 1) {
                if ($property->purpose === 'sale') {
                    $property->availability_status = 'sold';
                } elseif ($property->purpose === 'rent') {
                    $property->availability_status = 'rented';
                } else {
                    $property->availability_status = 'booked';
                }
            } else {
                $hasOtherConfirmed = Booking::where('property_id', $property->id)
                    ->where('id', '!=', $booking->id)
                    ->where('status', 1)
                    ->exists();
                if (!$hasOtherConfirmed) {
                    $property->availability_status = 'available';
                }
            }
            $property->save();
        }

        $notification = trans('user_validation.Updated successfully');
        return response()->json(['message' => $notification]);
    }

    public function remove($id)
    {
        $user = Auth::guard('api')->user();
        $Booking = Booking::find($id);
        if (!$Booking) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        if ($Booking->agent_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $property = $Booking->property;
        $Booking->delete();

        if ($property) {
            $hasOtherConfirmed = Booking::where('property_id', $property->id)
                ->where('status', 1)
                ->exists();
            if (!$hasOtherConfirmed) {
                $property->availability_status = 'available';
                $property->save();
            }
        }

        $notification = trans('user_validation.Deleted successfully');
        return response()->json(['message' => $notification]);
    }

    public function myBooking()
    {
        $user = Auth::guard('api')->user();

        $bookings = Booking::with('property')->where('user_id', $user->id)->paginate(10);

        return response()->json(['bookings' => $bookings]);

    }

    public function myBookingRemove($id)
    {
        $user = Auth::guard('api')->user();
        $Booking = Booking::find($id);
        if (!$Booking) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        if ($Booking->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $Booking->delete();

        $notification = trans('user_validation.Deleted successfully');
        return response()->json(['message' => $notification]);
    }
}
