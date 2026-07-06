<?php

namespace App\Http\Controllers\API;

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
use App\Models\Category;
use App\Models\Aminity;
use App\Models\NearestLocation;
use App\Models\PropertyAminity;
use App\Models\PropertyNearestLocation;
use App\Models\PropertyPlan;
use App\Models\PropertySlider;
use App\Models\AdditionalInformation;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;
use Image;

class BuilderController extends Controller
{
    /**
     * Constructor – Enforce Sanctum Auth and Builder Role
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (!$user || $user->login_type !== 'builder') {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized builder access'
                ], 403);
            }
            return $next($request);
        });
    }

    /**
     * Builder Dashboard Statistics
     */
    public function dashboard()
    {
        $user = auth()->user();

        $total_properties = Property::where('agent_id', $user->id)->count();
        $published = Property::where('agent_id', $user->id)->where('status', 'enable')->where('approve_by_admin', 'approved')->count();
        $pending = Property::where('agent_id', $user->id)->where('approve_by_admin', 'pending')->count();
        $rejected = Property::where('agent_id', $user->id)->where('approve_by_admin', 'reject')->count();
        $sold = Property::where('agent_id', $user->id)->where('availability_status', 'sold')->count();
        $rented = Property::where('agent_id', $user->id)->where('availability_status', 'rented')->count();
        $booked = Property::where('agent_id', $user->id)->where('availability_status', 'booked')->count();
        
        $booking_requests = Booking::where('agent_id', $user->id)->count();
        $approvals = Property::where('agent_id', $user->id)->where('approve_by_admin', 'approved')->count();
        $enquiries = Booking::where('agent_id', $user->id)->count();

        $recent_bookings = Booking::with('property')->where('agent_id', $user->id)->orderBy('id', 'desc')->take(5)->get();

        return response()->json([
            'status' => true,
            'message' => 'Builder dashboard retrieved successfully',
            'data' => [
                'stats' => [
                    'total_properties' => $total_properties,
                    'published' => $published,
                    'pending' => $pending,
                    'rejected' => $rejected,
                    'sold' => $sold,
                    'rented' => $rented,
                    'booked' => $booked,
                    'total_views' => 0,
                    'total_enquiries' => $enquiries,
                    'booking_requests' => $booking_requests,
                    'approvals' => $approvals,
                    'projects' => []
                ],
                'recent_bookings' => $recent_bookings
            ]
        ]);
    }

    /**
     * Get Builder Properties
     */
    public function myProperties()
    {
        $user = auth()->user();
        $properties = Property::with(['city', 'property_type'])->where('agent_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Builder properties list retrieved',
            'data' => $properties
        ]);
    }

    /**
     * Store Builder Property
     */
    public function storeProperty(Request $request)
    {
        $user = auth()->user();

        $agent_id = $user->id;
        if(($user->owner_id == 0 && $user->is_agency ==1) || ($user->owner_id == 0 && $user->is_agency ==0)){
            $agent_order = Order::where('agent_id', $agent_id)->where('order_status','active')->orderBy('id','desc')->first();
        }else{
            $owner_id = $user->owner_id;
            $agent_order = Order::where('agent_id', $owner_id)->where('order_status','active')->orderBy('id','desc')->first();
        }

        if(!$agent_order){
            return response()->json([
                'success' => false,
                'code' => 'NO_ACTIVE_PLAN',
                'message' => "You don't have an active property listing plan.",
                'redirect_to' => '/pricing-plan'
            ], 403);
        }

        $expiration_date = $agent_order->expiration_date;
        if($expiration_date != 'lifetime'){
            if(date('Y-m-d') > $expiration_date){
                return response()->json([
                    'success' => false,
                    'code' => 'NO_ACTIVE_PLAN',
                    'message' => "You don't have an active property listing plan.",
                    'redirect_to' => '/pricing-plan'
                ], 403);
            }
        }

        $live_map = Setting::first()->live_map ?? 'yes';

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:properties',
            'slug' => 'required|unique:properties',
            'property_type_id' => 'required',
            'purpose' => 'required',
            'rent_period' => $request->purpose == 'rent' ? 'required' : 'nullable',
            'price' => 'required',
            'description' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'thumbnail_image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $property = new Property();
            $property->agent_id = $user->id;
            $property->title = $request->title;
            $property->slug = $request->slug;
            $property->property_type_id = $request->property_type_id;
            $property->purpose = $request->purpose;
            $property->rent_period = $request->purpose == 'rent' ? $request->rent_period : '';
            $property->price = $request->price;
            $property->description = $request->description;

            $property->total_area = $request->total_area;
            $property->total_unit = $request->total_unit;
            $property->total_bedroom = $request->total_bedroom;
            $property->total_bathroom = $request->total_bathroom;
            $property->total_garage = $request->total_garage;
            $property->total_kitchen = $request->total_kitchen;

            $property->city_id = $request->city_id;
            $property->country_id = $request->country_id;
            $property->address = $request->address;
            $property->address_description = $request->address_description;
            $property->google_map = $request->google_map;
            $property->lat = $request->lat;
            $property->lon = $request->lng;

            $property->video_id = $request->video_id;
            $property->video_description = $request->video_description;

            if ($request->hasFile('thumbnail_image')) {
                $image_name = 'property-thumb-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($request->thumbnail_image)
                    ->encode('webp', 80)
                    ->save(public_path() . '/' . $image_name);
                $property->thumbnail_image = $image_name;
            }

            if ($request->hasFile('video_thumbnail')) {
                $image_name = 'video-thumb-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($request->video_thumbnail)
                    ->encode('webp', 80)
                    ->save(public_path() . '/' . $image_name);
                $property->video_thumbnail = $image_name;
            }

            $property->status = 'enable';
            $property->approve_by_admin = 'pending';
            $property->save();

            // Save amenities
            if ($request->aminities) {
                foreach ($request->aminities as $aminity) {
                    $item = new PropertyAminity();
                    $item->aminity_id = $aminity;
                    $item->property_id = $property->id;
                    $item->save();
                }
            }

            // Save slider images
            if ($request->slider_images) {
                foreach ($request->slider_images as $image) {
                    $image_name = 'Property-slider-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                    $image_name = 'uploads/custom-images/' . $image_name;
                    Image::make($image)
                        ->encode('webp', 80)
                        ->save(public_path() . '/' . $image_name);

                    $slider = new PropertySlider();
                    $slider->property_id = $property->id;
                    $slider->image = $image_name;
                    $slider->save();
                }
            }

            // Save nearest locations
            if ($request->nearest_locations && $request->distances) {
                foreach ($request->nearest_locations as $index => $nearest_location) {
                    if ($request->nearest_locations[$index] != '' && $request->distances[$index] != '') {
                        $new_loc = new PropertyNearestLocation();
                        $new_loc->property_id = $property->id;
                        $new_loc->nearest_location_id = $request->nearest_locations[$index];
                        $new_loc->distance = $request->distances[$index];
                        $new_loc->save();
                    }
                }
            }

            // Save additional information
            if ($request->add_keys && $request->add_values) {
                foreach ($request->add_keys as $index => $add_key) {
                    if ($request->add_keys[$index] != '' && $request->add_values[$index] != '') {
                        $add_info = new AdditionalInformation();
                        $add_info->property_id = $property->id;
                        $add_info->add_key = $request->add_keys[$index];
                        $add_info->add_value = $request->add_values[$index];
                        $add_info->save();
                    }
                }
            }

            // Save plans
            if ($request->plan_images && $request->plan_titles && $request->plan_descriptions) {
                foreach ($request->plan_images as $index => $image) {
                    if ($request->plan_images[$index] && $request->plan_titles[$index] && $request->plan_descriptions[$index]) {
                        $image_name = 'Property-plan-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                        $image_name = 'uploads/custom-images/' . $image_name;
                        Image::make($image)
                            ->encode('webp', 80)
                            ->save(public_path() . '/' . $image_name);

                        $plan = new PropertyPlan();
                        $plan->property_id = $property->id;
                        $plan->image = $image_name;
                        $plan->title = $request->plan_titles[$index];
                        $plan->description = $request->plan_descriptions[$index];
                        $plan->save();
                    }
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Property created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to store property: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Edit Property Details
     */
    public function editProperty($id)
    {
        $user = auth()->user();

        $agent_id = $user->id;
        if(($user->owner_id == 0 && $user->is_agency ==1) || ($user->owner_id == 0 && $user->is_agency ==0)){
            $agent_order = Order::where('agent_id', $agent_id)->where('order_status','active')->orderBy('id','desc')->first();
        }else{
            $owner_id = $user->owner_id;
            $agent_order = Order::where('agent_id', $owner_id)->where('order_status','active')->orderBy('id','desc')->first();
        }

        if(!$agent_order){
            return response()->json([
                'success' => false,
                'code' => 'NO_ACTIVE_PLAN',
                'message' => "You don't have an active property listing plan.",
                'redirect_to' => '/pricing-plan'
            ], 403);
        }

        $expiration_date = $agent_order->expiration_date;
        if($expiration_date != 'lifetime'){
            if(date('Y-m-d') > $expiration_date){
                return response()->json([
                    'success' => false,
                    'code' => 'NO_ACTIVE_PLAN',
                    'message' => "You don't have an active property listing plan.",
                    'redirect_to' => '/pricing-plan'
                ], 403);
            }
        }

        $property = Property::where('id', $id)->where('agent_id', $user->id)->first();

        if (!$property) {
            return response()->json([
                'status' => false,
                'message' => 'Property not found or unauthorized'
            ], 403);
        }

        $types = Category::where('status', 1)->get();
        $cities = City::all();
        $aminities = Aminity::all();
        $nearest_locations = NearestLocation::orderBy('id', 'desc')->where('status', 1)->get();
        $countries = Country::orderBy('id', 'desc')->get();

        $existing_sliders = PropertySlider::where('property_id', $id)->get();
        $existing_aminities = PropertyAminity::where('property_id', $id)->get();
        $existing_nearest_locations = PropertyNearestLocation::where('property_id', $id)->get();
        $existing_add_informations = AdditionalInformation::where('property_id', $id)->get();
        $existing_plans = PropertyPlan::where('property_id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => 'Property edit details retrieved',
            'data' => [
                'property' => $property,
                'types' => $types,
                'cities' => $cities,
                'countries' => $countries,
                'aminities' => $aminities,
                'nearest_locations' => $nearest_locations,
                'existing_sliders' => $existing_sliders,
                'existing_aminities' => $existing_aminities,
                'existing_nearest_locations' => $existing_nearest_locations,
                'existing_add_informations' => $existing_add_informations,
                'existing_plans' => $existing_plans
            ]
        ]);
    }

    /**
     * Update Builder Property
     */
    public function updateProperty(Request $request, $id)
    {
        $user = auth()->user();

        $agent_id = $user->id;
        if(($user->owner_id == 0 && $user->is_agency ==1) || ($user->owner_id == 0 && $user->is_agency ==0)){
            $agent_order = Order::where('agent_id', $agent_id)->where('order_status','active')->orderBy('id','desc')->first();
        }else{
            $owner_id = $user->owner_id;
            $agent_order = Order::where('agent_id', $owner_id)->where('order_status','active')->orderBy('id','desc')->first();
        }

        if(!$agent_order){
            return response()->json([
                'success' => false,
                'code' => 'NO_ACTIVE_PLAN',
                'message' => "You don't have an active property listing plan.",
                'redirect_to' => '/pricing-plan'
            ], 403);
        }

        $expiration_date = $agent_order->expiration_date;
        if($expiration_date != 'lifetime'){
            if(date('Y-m-d') > $expiration_date){
                return response()->json([
                    'success' => false,
                    'code' => 'NO_ACTIVE_PLAN',
                    'message' => "You don't have an active property listing plan.",
                    'redirect_to' => '/pricing-plan'
                ], 403);
            }
        }

        $property = Property::where('id', $id)->where('agent_id', $user->id)->first();

        if (!$property) {
            return response()->json([
                'status' => false,
                'message' => 'Property not found or unauthorized'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:properties,title,' . $id,
            'slug' => 'required|unique:properties,slug,' . $id,
            'property_type_id' => 'required',
            'purpose' => 'required',
            'rent_period' => $request->purpose == 'rent' ? 'required' : 'nullable',
            'price' => 'required',
            'description' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $property->title = $request->title;
            $property->slug = $request->slug;
            $property->property_type_id = $request->property_type_id;
            $property->purpose = $request->purpose;
            $property->rent_period = $request->purpose == 'rent' ? $request->rent_period : '';
            $property->price = $request->price;
            $property->description = $request->description;

            $property->total_area = $request->total_area;
            $property->total_unit = $request->total_unit;
            $property->total_bedroom = $request->total_bedroom;
            $property->total_bathroom = $request->total_bathroom;
            $property->total_garage = $request->total_garage;
            $property->total_kitchen = $request->total_kitchen;

            $property->city_id = $request->city_id;
            $property->country_id = $request->country_id;
            $property->address = $request->address;
            $property->address_description = $request->address_description;
            $property->google_map = $request->google_map;
            $property->lat = $request->lat;
            $property->lon = $request->lng;

            $property->video_id = $request->video_id;
            $property->video_description = $request->video_description;

            if ($request->hasFile('thumbnail_image')) {
                $old_thumbnail = $property->thumbnail_image;
                $image_name = 'property-thumb-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($request->thumbnail_image)
                    ->encode('webp', 80)
                    ->save(public_path() . '/' . $image_name);
                $property->thumbnail_image = $image_name;

                if ($old_thumbnail && File::exists(public_path() . '/' . $old_thumbnail)) {
                    @unlink(public_path() . '/' . $old_thumbnail);
                }
            }

            if ($request->hasFile('video_thumbnail')) {
                $old_video = $property->video_thumbnail;
                $image_name = 'video-thumb-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($request->video_thumbnail)
                    ->encode('webp', 80)
                    ->save(public_path() . '/' . $image_name);
                $property->video_thumbnail = $image_name;

                if ($old_video && File::exists(public_path() . '/' . $old_video)) {
                    @unlink(public_path() . '/' . $old_video);
                }
            }

            $property->save();

            // Sync amenities
            PropertyAminity::where('property_id', $id)->delete();
            if ($request->aminities) {
                foreach ($request->aminities as $aminity) {
                    $item = new PropertyAminity();
                    $item->aminity_id = $aminity;
                    $item->property_id = $property->id;
                    $item->save();
                }
            }

            // Sync slider images
            if ($request->slider_images) {
                foreach ($request->slider_images as $image) {
                    $image_name = 'Property-slider-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                    $image_name = 'uploads/custom-images/' . $image_name;
                    Image::make($image)
                        ->encode('webp', 80)
                        ->save(public_path() . '/' . $image_name);

                    $slider = new PropertySlider();
                    $slider->property_id = $property->id;
                    $slider->image = $image_name;
                    $slider->save();
                }
            }

            // Update existing nearest locations
            if ($request->existing_nearest_locations && $request->existing_distances) {
                foreach ($request->existing_nearest_locations as $index => $nearest_location) {
                    if ($request->existing_nearest_locations[$index] != '' && $request->existing_distances[$index] != '' && $request->existing_nearest_ids[$index] != '') {
                        $new_loc = PropertyNearestLocation::find($request->existing_nearest_ids[$index]);
                        if ($new_loc) {
                            $new_loc->nearest_location_id = $request->existing_nearest_locations[$index];
                            $new_loc->distance = $request->existing_distances[$index];
                            $new_loc->save();
                        }
                    }
                }
            }

            // Save new nearest locations
            if ($request->nearest_locations && $request->distances) {
                foreach ($request->nearest_locations as $index => $nearest_location) {
                    if ($request->nearest_locations[$index] != '' && $request->distances[$index] != '') {
                        $new_loc = new PropertyNearestLocation();
                        $new_loc->property_id = $property->id;
                        $new_loc->nearest_location_id = $request->nearest_locations[$index];
                        $new_loc->distance = $request->distances[$index];
                        $new_loc->save();
                    }
                }
            }

            // Update existing additional information
            if ($request->existing_add_keys && $request->existing_add_values) {
                foreach ($request->existing_add_keys as $index => $add_key) {
                    if ($request->existing_add_keys[$index] != '' && $request->existing_add_values[$index] != '' && $request->existing_add_ids[$index] != '') {
                        $new_loc = AdditionalInformation::find($request->existing_add_ids[$index]);
                        if ($new_loc) {
                            $new_loc->add_key = $request->existing_add_keys[$index];
                            $new_loc->add_value = $request->existing_add_values[$index];
                            $new_loc->save();
                        }
                    }
                }
            }

            // Save new additional information
            if ($request->add_keys && $request->add_values) {
                foreach ($request->add_keys as $index => $add_key) {
                    if ($request->add_keys[$index] != '' && $request->add_values[$index] != '') {
                        $add_info = new AdditionalInformation();
                        $add_info->property_id = $property->id;
                        $add_info->add_key = $request->add_keys[$index];
                        $add_info->add_value = $request->add_values[$index];
                        $add_info->save();
                    }
                }
            }

            // Update existing plans
            if ($request->existing_plan_ids && $request->existing_plan_titles && $request->existing_plan_descriptions) {
                foreach ($request->existing_plan_ids as $index => $plan_id) {
                    if ($request->existing_plan_ids[$index] && $request->existing_plan_titles[$index] && $request->existing_plan_descriptions[$index]) {
                        $plan = PropertyPlan::find($request->existing_plan_ids[$index]);
                        if ($plan) {
                            $plan->title = $request->existing_plan_titles[$index];
                            $plan->description = $request->existing_plan_descriptions[$index];
                            $plan->save();

                            $ex_name = 'existing_plan_image_' . $plan_id;
                            $request_exist_image = $request->$ex_name;

                            if ($request_exist_image) {
                                $exist_image = $plan->image;
                                $image_name = 'Property-plan-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                                $image_name = 'uploads/custom-images/' . $image_name;
                                Image::make($request_exist_image)
                                    ->encode('webp', 80)
                                    ->save(public_path() . '/' . $image_name);

                                $plan->image = $image_name;
                                $plan->save();

                                if ($exist_image && File::exists(public_path() . '/' . $exist_image)) {
                                    @unlink(public_path() . '/' . $exist_image);
                                }
                            }
                        }
                    }
                }
            }

            // Save new plans
            if ($request->plan_images && $request->plan_titles && $request->plan_descriptions) {
                foreach ($request->plan_images as $index => $image) {
                    if ($request->plan_images[$index] && $request->plan_titles[$index] && $request->plan_descriptions[$index]) {
                        $image_name = 'Property-plan-' . date('Y-m-d-H-i-s-') . rand(999, 9999) . '.webp';
                        $image_name = 'uploads/custom-images/' . $image_name;
                        Image::make($image)
                            ->encode('webp', 80)
                            ->save(public_path() . '/' . $image_name);

                        $plan = new PropertyPlan();
                        $plan->property_id = $property->id;
                        $plan->image = $image_name;
                        $plan->title = $request->plan_titles[$index];
                        $plan->description = $request->plan_descriptions[$index];
                        $plan->save();
                    }
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Property updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update property: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete Property
     */
    public function deleteProperty($id)
    {
        $user = auth()->user();
        $property = Property::where('id', $id)->where('agent_id', $user->id)->first();

        if (!$property) {
            return response()->json([
                'status' => false,
                'message' => 'Property not found or unauthorized'
            ], 403);
        }

        try {
            PropertyAminity::where('property_id', $id)->delete();
            PropertyNearestLocation::where('property_id', $id)->delete();
            AdditionalInformation::where('property_id', $id)->delete();
            Wishlist::where('property_id', $id)->delete();
            Review::where('property_id', $id)->delete();

            $existing_plans = PropertyPlan::where('property_id', $id)->get();
            foreach ($existing_plans as $plan) {
                if ($plan->image && File::exists(public_path() . '/' . $plan->image)) {
                    @unlink(public_path() . '/' . $plan->image);
                }
                $plan->delete();
            }

            $existing_sliders = PropertySlider::where('property_id', $id)->get();
            foreach ($existing_sliders as $slider) {
                if ($slider->image && File::exists(public_path() . '/' . $slider->image)) {
                    @unlink(public_path() . '/' . $slider->image);
                }
                $slider->delete();
            }

            if ($property->thumbnail_image && File::exists(public_path() . '/' . $property->thumbnail_image)) {
                @unlink(public_path() . '/' . $property->thumbnail_image);
            }

            if ($property->video_thumbnail && File::exists(public_path() . '/' . $property->video_thumbnail)) {
                @unlink(public_path() . '/' . $property->video_thumbnail);
            }

            $property->delete();

            return response()->json([
                'status' => true,
                'message' => 'Property deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete property: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Booking Requests
     */
    public function bookings()
    {
        $user = auth()->user();
        $bookings = Booking::with(['property', 'user'])->where('agent_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Builder bookings retrieved successfully',
            'data' => $bookings
        ]);
    }

    /**
     * Update Booking Status & Sync Property
     */
    public function updateBookingStatus(Request $request, $id)
    {
        $user = auth()->user();
        $booking = Booking::with('property')->where('agent_id', $user->id)->where('id', $id)->first();

        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found or unauthorized'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:0,1,2'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
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

            return response()->json([
                'status' => true,
                'message' => 'Booking status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update booking status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete Booking
     */
    public function deleteBooking($id)
    {
        $user = auth()->user();
        $booking = Booking::where('agent_id', $user->id)->where('id', $id)->first();

        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found or unauthorized'
            ], 403);
        }

        try {
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

            return response()->json([
                'status' => true,
                'message' => 'Booking deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete booking: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Builder Profile
     */
    public function profile()
    {
        $user = auth()->user()->load(['builder', 'country', 'state', 'city']);

        return response()->json([
            'status' => true,
            'message' => 'Builder profile retrieved successfully',
            'data' => $user
        ]);
    }

    /**
     * Update Profile
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $builder = $user->builder;

        if (!$builder) {
            return response()->json([
                'status' => false,
                'message' => 'Builder profile not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'business_type' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:country_states,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:500',
            'website' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user->update([
                'name' => $request->name,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
            ]);

            $builder->update([
                'company_name' => $request->company_name,
                'phone_number' => $request->phone_number,
                'business_type' => $request->business_type,
                'address' => $request->address,
                'website' => $request->website,
                'description' => $request->description,
                'gstin' => $request->gstin,
                'pan_number' => $request->pan_number,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => $user->load('builder')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update profile: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reviews on Builder Properties
     */
    public function reviews()
    {
        $user = auth()->user();
        $reviews = Review::with(['property', 'user'])->whereHas('property', function ($q) use ($user) {
            $q->where('agent_id', $user->id);
        })->latest()->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Builder property reviews retrieved',
            'data' => $reviews
        ]);
    }

    /**
     * Orders
     */
    public function orders()
    {
        $user = auth()->user();
        $orders = Order::where('agent_id', $user->id)->latest()->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Builder package orders retrieved',
            'data' => $orders
        ]);
    }

    /**
     * Notifications
     */
    public function notifications()
    {
        return response()->json([
            'status' => true,
            'message' => 'Notifications retrieved',
            'data' => []
        ]);
    }

    /**
     * Settings
     */
    public function settings()
    {
        $setting = Setting::first();
        return response()->json([
            'status' => true,
            'message' => 'Settings retrieved',
            'data' => $setting
        ]);
    }
}
