<?php

namespace App\Http\Controllers\Builder;

use App\Http\Controllers\Controller;
use App\Models\Builder;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryStateModal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BuilderController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth:web');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->login_type !== 'builder') {
                return redirect()->route('login')->with([
                    'messege' => 'Unauthorized access',
                    'alert-type' => 'error'
                ]);
            }
            return $next($request);
        });
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
            'status' => 0
        ]);

        Auth::login($user);

        return redirect()->route('builder.dashboard')
            ->with(['messege' => 'Registration Successful', 'alert-type' => 'success']);
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
}
