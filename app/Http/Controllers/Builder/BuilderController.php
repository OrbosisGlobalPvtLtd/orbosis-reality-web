<?php

namespace App\Http\Controllers\Builder;

use App\Http\Controllers\Controller;
use App\Models\Builder;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryStateModal;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;


class BuilderController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth:web')->except(['showRegisterForm', 'register', 'showLoginForm', 'login', 'getStates', 'getCities']);
        $this->middleware(function ($request, $next) {
            if (auth()->user()->login_type !== 'builder') {
                Auth::logout();
                return redirect()->route('builder.login')->with([
                    'messege' => 'Unauthorized access',
                    'alert-type' => 'error'
                ]);
            }
            return $next($request);
        })->except(['showRegisterForm', 'register', 'showLoginForm', 'login', 'getStates', 'getCities']);
    }

       public function showRegisterForm()
    {
        $countries = Country::all();
        $states = CountryStateModal::all();
        $cities = City::all();

        return view('builder.register', compact('countries','states','cities'));
    }

    /*
    |--------------------------------------------------------------------------
    | Register Builder
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'phone_number' => 'nullable|string|max:20',
            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|exists:country_states,id',
            'city_id' => 'nullable|exists:cities,id',
            'address' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
            'company_name' => 'nullable|string|max:255',
        ]);

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'login_type' => 'builder',
        ]);

        // Create Builder Profile
        Builder::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'status' => Builder::STATUS_PENDING
        ]);

        return redirect()->route('builder.login')
            ->with(['messege' => 'Your builder account is pending admin approval.', 'alert-type' => 'info']);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Login Form
    |--------------------------------------------------------------------------
    */
    public function showLoginForm()
    {
        return view('builder.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Builder
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)
                    ->where('login_type', 'builder')
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Invalid credentials'
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'Invalid credentials'
            ]);
        }

        if ($user->status == 0) {
            return back()->withErrors([
                'email' => 'Disabled Account'
            ]);
        }

        $builder = $user->builder;
        if (!$builder) {
            return back()->withErrors([
                'email' => 'Builder profile not found'
            ]);
        }

        if ($builder->status == Builder::STATUS_PENDING) {
            return back()->withErrors([
                'email' => 'Your builder account is pending admin approval.'
            ]);
        }

        if ($builder->status == Builder::STATUS_REJECTED) {
            return back()->withErrors([
                'email' => 'Your builder account has been rejected by admin.'
            ]);
        }

        if ($builder->status == Builder::STATUS_SUSPENDED) {
            return back()->withErrors([
                'email' => 'Your builder account is suspended.'
            ]);
        }

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'login_type' => 'builder'
        ])) {

            return redirect()->route('builder.dashboard')
                ->with(['messege' => 'Login Successful', 'alert-type' => 'success']);
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }

    /**
     * Show builder dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $builder = $user->builder;

        if (!$builder) {
            return redirect()->route('builder.profile-setup');
        }

        // Get builder statistics
        $stats = [
            'total_projects' => 0,
            'active_projects' => 0,
            'completed_projects' => 0,
            'total_revenue' => 0
        ];

        return view('builder.dashboard', [
            'builder' => $builder,
            'stats' => $stats,
            'user' => $user
        ]);
    }

    /**
     * Show builder profile
     */
    public function profile()
    {
        $user = Auth::user();
        $builder = $user->builder;
        $countries = Country::all();
        $cities = City::all();
        $states = CountryStateModal::all();

        return view('builder.profile', [
            'builder' => $builder,
            'user' => $user,
            'countries' => $countries,
            'cities' => $cities,
            'states' => $states
        ]);
    }

    /**
     * Update builder profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $builder = $user->builder;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'business_type' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:country_states,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:500',
            'website' => 'nullable|url',
            'description' => 'nullable|string|max:1000',
            'gstin' => 'nullable|string|max:20',
            'pan_number' => 'nullable|string|max:20',
        ]);

        // Update user
        $user->update([
            'name' => $validated['name'],
            'country_id' => $validated['country_id'],
            'state_id' => $validated['state_id'],
            'city_id' => $validated['city_id'],
        ]);

        // Update builder profile
        $builder->update([
            'company_name' => $validated['company_name'],
            'phone_number' => $validated['phone_number'],
            'business_type' => $validated['business_type'],
            'address' => $validated['address'],
            'website' => $validated['website'],
            'description' => $validated['description'],
            'gstin' => $validated['gstin'],
            'pan_number' => $validated['pan_number'],
            'country_id' => $validated['country_id'],
            'state_id' => $validated['state_id'],
            'city_id' => $validated['city_id'],
        ]);

        $notification = [
            'messege' => 'Profile updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Change password
     */
    public function changePassword()
    {
        return view('builder.change-password');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        $notification = [
            'messege' => 'Password changed successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Logout builder
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        
        $notification = [
            'messege' => 'Logged out successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('login')->with($notification);
    }


      public function bilderregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'phone_number'  => 'required|string|max:20',
            'company_name'  => 'required|string|max:255',
            'password'      => 'required|min:8',
            'address'       => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'login_type' => 'builder',
        ]);

        $builder = Builder::create([
            'user_id'      => $user->id,
            'company_name' => $request->company_name,
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
            'status'       => 'pending',
        ]);

        $token = $user->createToken('builder_token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'Builder registered successfully',
            'token'   => $token,
            'data'    => [
                'user'    => $user,
                'builder' => $builder
            ]
        ], 201);
    }

    /* ================= LOGIN ================= */
    public function bilderlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)
                    ->where('login_type', 'builder')
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('builder_token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'Login successful',
            'token'   => $token,
            'data'    => [
                'user'    => $user,
                'builder' => $user->builder
            ]
        ]);
    }

    /* ================= PROFILE ================= */
    public function bilderprofile(Request $request)
    {
        $user = $request->user()->load('builder');

        return response()->json([
            'status' => true,
            'data'   => $user
        ]);
    }

    /* ================= LOGOUT ================= */
    public function bilderlogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Logged out successfully'
        ]);
    }

    public function myTeam()
    {
        return view('dashboard.my-team');
    }

    public function myProperties()
    {
        $properties = Property::where('agent_id', Auth::id())->latest()->paginate(10);
        return view('builder.my-properties', compact('properties'));
    }

    public function create()
    {
        $propertyTypes = Setting::all();
        $cities = City::all();
        $countries = Country::all();
        $properties = Property::where('agent_id', Auth::id())->latest()->get();

        return view('builder.create', compact(
            'propertyTypes',
            'cities',
            'countries',
            'properties'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:properties,title',
            'slug' => 'required|unique:properties,slug',
            'description' => 'required',
            'price' => 'required|numeric',
            'property_type_id' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'thumbnail_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $property = new Property();
        $property->agent_id = Auth::id();
        $property->title = $request->title;
        $property->slug = Str::slug($request->slug);
        $property->property_type_id = $request->property_type_id;
        $property->purpose = $request->purpose ?? 'sale';
        $property->rent_period = $request->rent_period ?? '';
        $property->price = $request->price;
        $property->description = $request->description;
        $property->total_area = $request->total_area ?? 0;
        $property->total_bedroom = $request->total_bedroom ?? 0;
        $property->total_bathroom = $request->total_bathroom ?? 0;
        $property->city_id = $request->city_id;
        $property->country_id = $request->country_id;
        $property->address = $request->address ?? '';
        $property->google_map = $request->google_map ?? '';
        $property->lat = $request->lat ?? '';
        $property->lon = $request->lng ?? '';
        $property->status = 'enable';

        $property->save();

        if ($request->hasFile('thumbnail_image')) {
            $property->thumbnail_image = ImageHelper::savePropertyMedia($request->file('thumbnail_image'), $property->id, 'thumbnail');
            $property->save();
        }

        return redirect()->route('builder.my-properties')
            ->with('success', 'Property Added Successfully');
    }

    public function edit($id)
    {
        $property = Property::where('agent_id', auth()->id())
                        ->findOrFail($id);

        $cities = City::all();
        $countries = Country::all();
        $propertyTypes = Setting::all();

        return view('builder.edit', compact(
            'property',
            'cities',
            'countries',
            'propertyTypes'
        ));
    }

    public function update(Request $request, $id)
    {
        $property = Property::where('agent_id', auth()->id())
                    ->findOrFail($id);

        $request->validate([
            'title' => 'required|unique:properties,title,' . $id,
            'slug' => 'required|unique:properties,slug,' . $id,
            'price' => 'required|numeric',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $property->title = $request->title;
        $property->slug = Str::slug($request->slug);
        $property->price = $request->price;
        $property->description = $request->description;
        $property->purpose = $request->purpose;
        $property->status = $request->status ?? 'enable';

        if ($request->hasFile('thumbnail_image')) {
            if ($property->thumbnail_image && file_exists(public_path($property->thumbnail_image))) {
                @unlink(public_path($property->thumbnail_image));
            }
            $property->thumbnail_image = ImageHelper::savePropertyMedia($request->file('thumbnail_image'), $property->id, 'thumbnail');
        }

        $property->save();

        return redirect()->route('builder.my-properties')
            ->with('success', 'Property update Successfully');
    }

    public function bookingRequest()
    {
        $bookings = Booking::with(['property', 'user'])
            ->whereHas('property', function ($q) {
                $q->where('agent_id', Auth::id());
            })
            ->latest()
            ->paginate(10);

        return view('builder.my-booking', compact('bookings'));
    }

    public function delete($id)
    {
        $property = Property::where('agent_id', auth()->id())
                    ->findOrFail($id);

        if (!empty($property->thumbnail_image)) {
            $imagePath = public_path($property->thumbnail_image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                @unlink($imagePath);
            }
        }

        $property->delete();

        return redirect()->route('builder.my-properties')
            ->with('success', 'Property deleted successfully');
    }

    public function updateApprovalStatus(Request $request, $id)
    {
        $request->validate([
            'approve_by_admin' => 'required|in:pending,approved'
        ]);

        $property = Property::findOrFail($id);
        $property->approve_by_admin = $request->approve_by_admin;
        $property->save();

        return back()->with('success','Approval Status Updated Successfully');
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
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
                $property->availability_status = 'available';
            }
            $property->save();
        }

        return back()->with('success', 'Booking status updated successfully');
    }

    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $property = $booking->property;
        $booking->delete();

        if ($property) {
            $hasOtherConfirmed = Booking::where('property_id', $property->id)
                ->where('status', 1)
                ->exists();
            if (!$hasOtherConfirmed) {
                $property->availability_status = 'available';
                $property->save();
            }
        }

        return back()->with('success', 'Booking deleted successfully');
    }

    public function purchaseHistory()
    {
        return view('builder.my-booking.purchase-history');
    }

    public function wishlist()
    {
        return view('builder.my-booking.wishlist');
    }

    public function compare()
    {
        return view('builder.my-booking.compare');
    }

    public function myReviews()
    {
        return view('builder.my-booking.my-reviews');
    }

    public function myBooking()
    {
        $bookings = Booking::where('user_id', Auth::id())->latest()->paginate(10);
        return view('builder.my-booking', compact('bookings'));
    }

    public function kycVerification()
    {
        return view('builder.kyc-verification');
    }

    public function getStates($country_id)
    {
        return CountryStateModal::where('country_id', $country_id)->get();
    }

    public function getCities($state_id)
    {
        return City::where('state_id', $state_id)->get();
    }
}

