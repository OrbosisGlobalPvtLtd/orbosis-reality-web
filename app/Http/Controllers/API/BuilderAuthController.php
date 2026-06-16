<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BuilderAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:api')->except(['profile', 'logout']);
    }

    /**
     * Builder Registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'phone_number'  => 'required|string|max:20',
            'company_name'  => 'required|string|max:255',
            'password'      => 'required|min:8|confirmed',
            'address'       => 'nullable|string|max:500',
            'country_id'    => 'nullable|numeric',
            'state_id'      => 'nullable|numeric',
            'city_id'       => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'login_type' => 'builder',
                'status'     => 1,
                'email_verified' => 1,
                'country_id' => $request->country_id,
                'state_id'   => $request->state_id,
                'city_id'    => $request->city_id,
            ]);

            Builder::create([
                'user_id'      => $user->id,
                'company_name' => $request->company_name,
                'phone_number' => $request->phone_number,
                'address'      => $request->address,
                'country_id'   => $request->country_id,
                'state_id'     => $request->state_id,
                'city_id'      => $request->city_id,
                'status'       => 0,
            ]);

            $token = $user->createToken('builder_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Registration successful',
                'token'   => $token,
                'user'    => $user->load('builder')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Builder registration error: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Builder Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            $user = User::where('email', $request->email)
                        ->where('login_type', 'builder')
                        ->first();

            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User not found'
                ], 401);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid password'
                ], 401);
            }

            if ($user->status != 1) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Account is disabled'
                ], 403);
            }

            $builder = $user->builder;
            if (!$builder) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Builder profile not found'
                ], 404);
            }

            if ($builder->status != 1) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Your builder account is pending admin approval'
                ], 403);
            }

            $token = $user->createToken('builder_token')->plainTextToken;

            return response()->json([
                'status'  => true,
                'message' => 'Login successful',
                'token'   => $token,
                'user'    => $user->load('builder')
            ]);
        } catch (\Exception $e) {
            \Log::error('Builder login error: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Login failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = $request->user();
            
            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $builder = $user->builder;
            if (!$builder) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Builder profile not found'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Profile retrieved successfully',
                'user'   => $user->load('builder', 'country', 'state', 'city')
            ]);
        } catch (\Exception $e) {
            \Log::error('Builder profile error: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Profile fetch failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Logged out successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Builder logout error: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Logout failed: ' . $e->getMessage()
            ], 500);
        }
    }
}