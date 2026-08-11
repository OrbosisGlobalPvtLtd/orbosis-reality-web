<?php

namespace App\Http\Controllers\API\User;

use Str;
use Auth;
use File;
use Image;
use App\Models\City;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Aminity;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Homepage;
use App\Models\Property;
use App\Models\Wishlist;
use App\Models\PropertyPlan;
use Illuminate\Http\Request;
use App\Models\PropertySlider;

use App\Models\NearestLocation;
use App\Models\PropertyAminity;
use App\Http\Controllers\Controller;
use App\Models\AdditionalInformation;
use App\Models\PropertyNearestLocation;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){

        $setting = Setting::first();

        $user = Auth::guard('api')->user();

        $user = User::select('id','name','email','image','phone','address','status')->where('id', $user->id)->first();

        $properties = Property::with(['agent', 'city', 'property_type'])->where('agent_id', $user->id)->orderBy('id','desc')->paginate(10);

        return response()->json(['properties' => $properties]);
    }


    public function checkUserPropertyEntitlement($user)
    {
        $agent_id = $user->id;
        $target_user = $user;
        if ($user->owner_id != 0) {
            $target_user = User::find($user->owner_id) ?? $user;
            $agent_id = $target_user->id;
        }

        // 1. Check lifetime free listings slot (5 maximum)
        $free_used = (int) ($target_user->free_listings_used ?? 0);
        if ($free_used < 5) {
            return [
                'allowed' => true,
                'is_free_slot' => true,
                'free_used' => $free_used,
                'free_remaining' => 5 - $free_used,
            ];
        }

        // 2. Check active paid membership plan order
        $agent_order = Order::where(function($q) use ($agent_id) {
            $q->where('user_id', $agent_id)->orWhere('agent_id', $agent_id);
        })->where('order_status', 'active')->where('payment_status', 'success')->orderBy('id', 'desc')->first();

        if ($agent_order) {
            $expiration_date = $agent_order->expiration_date;
            if ($expiration_date != 'lifetime' && !empty($expiration_date)) {
                if (date('Y-m-d') > $expiration_date) {
                    return [
                        'allowed' => false,
                        'reason' => 'expired_plan',
                        'message' => trans('user_validation.Pricing plan date is expired')
                    ];
                }
            }

            $number_of_property = (int) $agent_order->number_of_property;
            if ($number_of_property == -1) {
                return [
                    'allowed' => true,
                    'is_free_slot' => false,
                    'order' => $agent_order
                ];
            }

            // Count properties created under this active plan
            $paid_count = Property::where('agent_id', $agent_id)
                ->where('created_at', '>=', $agent_order->created_at)
                ->count();

            if ($paid_count < $number_of_property) {
                return [
                    'allowed' => true,
                    'is_free_slot' => false,
                    'order' => $agent_order,
                    'paid_used' => $paid_count,
                    'paid_limit' => $number_of_property
                ];
            }

            return [
                'allowed' => false,
                'reason' => 'limit_exceeded',
                'message' => trans('user_validation.You can not add property more than limit quantity')
            ];
        }

        return [
            'allowed' => false,
            'reason' => 'no_plan',
            'message' => "Your 5 lifetime free listings are finished. Please purchase a membership plan to post more properties."
        ];
    }

    public function choose_property_type(){
        $setting = Setting::first();
        $user = Auth::guard('api')->user();
        $entitlement = $this->checkUserPropertyEntitlement($user);

        if (!$entitlement['allowed']) {
            return response()->json([
                'success' => false,
                'code' => ($entitlement['reason'] ?? '') === 'no_plan' ? 'NO_ACTIVE_PLAN' : 'PLAN_LIMIT_EXCEEDED',
                'message' => $entitlement['message'],
                'redirect_to' => '/pricing-plan'
            ], 403);
        }

        $property_content = (object) array(
            'rent_logo' => $setting->rent_logo,
            'rent_title' => $setting->rent_title,
            'rent_description' => $setting->rent_description,
            'rent_btn_text' => $setting->rent_btn_text,
            'sale_logo' => $setting->sale_logo,
            'sale_title' => $setting->sale_title,
            'sale_description' => $setting->sale_description,
            'sale_btn_text' => $setting->sale_btn_text,
        );

        return response()->json(['property_content' => $property_content]);
    }

    public function create(Request $request){
        $user = Auth::guard('api')->user();
        $entitlement = $this->checkUserPropertyEntitlement($user);

        if (!$entitlement['allowed']) {
            return response()->json([
                'success' => false,
                'code' => ($entitlement['reason'] ?? '') === 'no_plan' ? 'NO_ACTIVE_PLAN' : 'PLAN_LIMIT_EXCEEDED',
                'message' => $entitlement['message'],
                'redirect_to' => '/pricing-plan'
            ], 403);
        }

        if(!$request->purpose){
            $notification = trans('user_validation.Please select property purpose');
            return response()->json(['message' => $notification],403);
        }

        if($request->purpose != 'rent' && $request->purpose != 'sale' && $request->purpose != 'buy'){
            $notification = trans('user_validation.Please select valid property purpose');
            return response()->json(['message' => $notification],403);
        }

        $setting = Setting::first();
        $types = Category::where('status', 1)->get();
        $cities = City::all();
        $aminities = Aminity::all();
        $nearest_locations = NearestLocation::orderBy('id', 'desc')->where('status', 1)->get();
        $countries = Country::orderBy('id', 'desc')->get();

        return response()->json([
            'types' => $types,
            'cities' => $cities,
            'aminities' => $aminities,
            'nearest_locations' => $nearest_locations,
            'request_purpose' => $request->purpose,
            'countries' => $countries
        ]);
    }

    public function store(Request $request){
        $user = Auth::guard('api')->user();
        if (!$user->can_add_property) {
            return response()->json(['message' => 'Unauthorized role'], 403);
        }

        $entitlement = $this->checkUserPropertyEntitlement($user);
        if (!$entitlement['allowed']) {
            return response()->json([
                'success' => false,
                'code' => ($entitlement['reason'] ?? '') === 'no_plan' ? 'NO_ACTIVE_PLAN' : 'PLAN_LIMIT_EXCEEDED',
                'message' => $entitlement['message'],
                'redirect_to' => '/pricing-plan'
            ], 403);
        }


        $live_map = Setting::first()->live_map;

        $rules = [
            'title'=>'required|unique:properties',
            'slug'=>'required|unique:properties',
            'property_type_id'=>'required',
            'purpose'=> 'required',
            'rent_period'=> $request->purpose == 'rent' ? 'required' : '',
            'price'=>'required',
            'description'=>'required',
            'city_id'=>'required',
            'country_id'=>'nullable',
            'address'=>'required',
            'address_description'=>'nullable',
            'google_map'=> $live_map == 'no' ? 'nullable' : '',
            'lat' => $live_map == 'yes' ? 'nullable' : '',
            'lng' => $live_map == 'yes' ? 'nullable' : '',
            'total_area'=>'nullable',
            'total_unit'=>'nullable',
            'total_bedroom'=>'nullable',
            'total_bathroom'=>'nullable',
            'total_garage'=>'nullable',
            'total_kitchen'=>'nullable',
            'thumbnail_image'=>'required',
        ];
        $customMessages = [
            'title.required' => trans('user_validation.Title is required'),
            'title.unique' => trans('user_validation.Title already exist'),
            'slug.required' => trans('user_validation.Slug is required'),
            'slug.unique' => trans('user_validation.Slug already exist'),
            'property_type_id.required' => trans('user_validation.Property type is required'),
            'purpose.required' => trans('user_validation.Purpose is required'),
            'rent_period.required' => trans('user_validation.Rent period is required'),
            'price.required' => trans('user_validation.Price is required'),
            'description.required' => trans('user_validation.Description is required'),
            'city_id.required' => trans('user_validation.City is required'),
            'address.required' => trans('user_validation.Address is required'),
            'address_description.required' => trans('user_validation.Address details is required'),
            'google_map.required' => trans('user_validation.Google map is required'),
            'total_area.required' => trans('user_validation.Total area is required'),
            'total_unit.required' => trans('user_validation.Total unit is required'),
            'total_bedroom.required' => trans('user_validation.Total bedroom is required'),
            'total_bathroom.required' => trans('user_validation.Total bathroom is required'),
            'total_garage.required' => trans('user_validation.Total garage is required'),
            'total_kitchen.required' => trans('user_validation.Total kitchen is required'),
            'thumbnail_image.required' => trans('user_validation.Thumbnail image is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $property = new Property();
        $property->agent_id = $agent_id;
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
        $property->total_bathroom = $request->total_bathroom;

        $property->city_id = $request->city_id;
        $property->country_id = $request->country_id;
        $property->address = $request->address;
        $property->address_description = $request->address_description;
        $property->google_map = $request->google_map;
        $property->lat = $request->lat;
        $property->lon = $request->lng;

        $property->video_id = $request->video_id;
        $property->video_description = $request->video_description;

        if($request->thumbnail_image){
            $extention = $request->thumbnail_image->getClientOriginalExtension();
            $image_name = 'property-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->thumbnail_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $property->thumbnail_image = $image_name;
        }

        if($request->video_thumbnail){
            $extention = $request->video_thumbnail->getClientOriginalExtension();
            $image_name = 'video-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->video_thumbnail)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $property->video_thumbnail = $image_name;
        }

        $property->seo_title = $request->seo_title ? $request->seo_title : $request->title;
        $property->seo_meta_description = $request->seo_meta_description ? $request->seo_meta_description : $request->title;
        $property->status = 'enable';

        $setting = Setting::first();
        if($setting->property_auto_approval == 'yes'){
            $property->approve_by_admin = 'approved';
        }

        if($agent_order->expiration_date == 'lifetime'){
            $property->expired_date = null;
        }else{
            $property->expired_date = $agent_order->expiration_date;
        }
        $property->save();

        if($request->aminities){
            foreach($request->aminities as $aminity){
                $item = new PropertyAminity();
                $item->aminity_id = $aminity;
                $item->property_id = $property->id;
                $item->save();
            }
        }

        if($request->slider_images){
            foreach($request->slider_images as $index => $image){
                $extention = $image->getClientOriginalExtension();
                $image_name = 'Property-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                $image_name = 'uploads/custom-images/'.$image_name;
                Image::make($image)
                    ->encode('webp', 80)
                    ->save(public_path().'/'.$image_name);

                $slider = new PropertySlider();
                $slider->property_id = $property->id;
                $slider->image = $image_name;
                $slider->save();
            }
        }

        if($request->nearest_locations && $request->distances){
            foreach($request->nearest_locations as $index => $nearest_location){
                if($request->nearest_locations[$index] != '' && $request->distances[$index] != ''){
                    $new_loc = new PropertyNearestLocation();
                    $new_loc->property_id = $property->id;
                    $new_loc->nearest_location_id = $request->nearest_locations[$index];
                    $new_loc->distance = $request->distances[$index];
                    $new_loc->save();
                }
            }
        }


        if($request->add_keys && $request->add_values){
            foreach($request->add_keys as $index => $add_key){
                if($request->add_keys[$index] != '' && $request->add_values[$index] != ''){
                    $new_loc = new AdditionalInformation();
                    $new_loc->property_id = $property->id;
                    $new_loc->add_key = $request->add_keys[$index];
                    $new_loc->add_value = $request->add_values[$index];
                    $new_loc->save();
                }
            }
        }

        if($request->plan_images && $request->plan_titles && $request->plan_descriptions){
            foreach($request->plan_images as $index => $image){
                if($request->plan_images[$index] && $request->plan_titles[$index] && $request->plan_descriptions[$index]){
                    $extention = $image->getClientOriginalExtension();
                    $image_name = 'Property-plan'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                    $image_name = 'uploads/custom-images/'.$image_name;
                    Image::make($image)
                        ->encode('webp', 80)
                        ->save(public_path().'/'.$image_name);

                    $plan = new PropertyPlan();
                    $plan->property_id = $property->id;
                    $plan->image = $image_name;
                    $plan->title = $request->plan_titles[$index];
                    $plan->description = $request->plan_descriptions[$index];
                    $plan->save();
                }
            }
        }

        if ($entitlement['is_free_slot'] ?? false) {
            $target_user = ($user->owner_id != 0) ? (User::find($user->owner_id) ?? $user) : $user;
            $target_user->increment('free_listings_used');
        }

        $notification = trans('user_validation.Created succssfully');
        return response()->json(['message' => $notification]);
    }

    public function edit($id){

        $setting = Setting::first();

        $user = Auth::guard('api')->user();
        if (!$user->can_add_property) {
            return response()->json(['message' => 'Unauthorized role'], 403);
        }

        $types = Category::where('status', 1)->get();
        $cities = City::all();
        $aminities = Aminity::all();
        $nearest_locations = NearestLocation::orderBy('id', 'desc')->where('status', 1)->get();

        $property = Property::where('id', $id)->where('agent_id', $user->id)->first();
        if (!$property) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $existing_sliders = PropertySlider::where('property_id', $id)->get();
        $existing_properties = PropertyAminity::where('property_id', $id)->get();
        $existing_nearest_locations = PropertyNearestLocation::where('property_id', $id)->get();
        $existing_add_informations = AdditionalInformation::where('property_id', $id)->get();
        $existing_plans = PropertyPlan::where('property_id', $id)->get();

        $featured_property = 'disable';
        $top_property = 'disable';
        $urgent_property = 'disable';

        $agent_id = $user->id;
        $agent_order = Order::where('agent_id', $agent_id)->orderBy('id','desc')->first();

        if($agent_order){
            $is_featured = $agent_order->featured_property;
            $featured_property_qty = $agent_order->featured_property_qty;

            $is_top = $agent_order->top_property;
            $top_property_qty = $agent_order->top_property_qty;

            $is_urgent = $agent_order->urgent_property;
            $urgent_property_qty = $agent_order->urgent_property_qty;


            if($top_property_qty == -1){
                $top_property = 'enable';
            }else{
                $top_property_count = Property::where('agent_id', $agent_id)->where('is_top', 'enable')->count();
                if($top_property_count < $top_property_qty){
                    $top_property = 'enable';
                }
            }

            if($urgent_property_qty == -1){
                $urgent_property = 'enable';
            }else{
                $urgent_property_count = Property::where('agent_id', $agent_id)->where('is_urgent', 'enable')->count();
                if($urgent_property_count < $urgent_property_qty){
                    $urgent_property = 'enable';
                }
            }

            if($featured_property_qty == -1){
                $featured_property = 'enable';
            }else{
                $featured_property_count = Property::where('agent_id', $agent_id)->where('is_featured', 'enable')->count();
                if($featured_property_count < $featured_property_qty){
                    $featured_property = 'enable';
                }
            }
        }else{
            return response()->json([
                'success' => false,
                'code' => 'NO_ACTIVE_PLAN',
                'message' => "You don't have an active property listing plan.",
                'redirect_to' => '/pricing-plan'
            ], 403);
        }

        $countries = Country::orderBy('id', 'desc')->get();

        $cities = City::where('country_id', $property->country_id)->orderBY('name', 'asc')->get();

        return response()->json([
            'property' => $property,
            'types' => $types,
            'aminities' => $aminities,
            'nearest_locations' => $nearest_locations,
            'existing_sliders' => $existing_sliders,
            'existing_aminities' => $existing_properties,
            'existing_nearest_locations' => $existing_nearest_locations,
            'existing_add_informations' => $existing_add_informations,
            'existing_plans' => $existing_plans,
            'featured_property' => $featured_property,
            'top_property' => $top_property,
            'urgent_property' => $top_property,
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }

    public function update(Request $request, $id){

        $user = Auth::guard('api')->user();
        if (!$user->can_add_property) {
            return response()->json(['message' => 'Unauthorized role'], 403);
        }
        $property = Property::where('id', $id)->where('agent_id', $user->id)->first();
        if (!$property) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $live_map = Setting::first()->live_map;

        $rules = [
            'title'=>'required|unique:properties,title,'.$id,
            'slug'=>'required|unique:properties,slug,'.$id,
            'property_type_id'=>'required',
            'purpose'=> 'required',
            'rent_period'=> $request->purpose == 'rent' ? 'required' : '',
            'price'=>'required',
            'description'=>'required',
            'city_id'=>'required',
            'country_id'=>'nullable',
            'address'=>'required',
            'address_description'=>'nullable',
            'google_map'=> $live_map == 'no' ? 'nullable' : '',
            'lat' => $live_map == 'yes' ? 'nullable' : '',
            'lng' => $live_map == 'yes' ? 'nullable' : '',
            'total_area'=>'nullable',
            'total_unit'=>'nullable',
            'total_bedroom'=>'nullable',
            'total_bathroom'=>'nullable',
            'total_garage'=>'nullable',
            'total_kitchen'=>'nullable',
            'lang_code'=>'nullable',
        ];

        if ($request->lang_code !== 'en') {
            $rules = [
                'title' => 'required|unique:properties,title,' . $id,
                'description' => 'required',
                'address' => 'required',
                'address_description' => 'required',
                'lang_code'=>'nullable',
            ];
        }

        $customMessages = [
            'title.required' => trans('user_validation.Title is required'),
            'title.unique' => trans('user_validation.Title already exist'),
            'slug.required' => trans('user_validation.Slug is required'),
            'slug.unique' => trans('user_validation.Slug already exist'),
            'property_type_id.required' => trans('user_validation.Property type is required'),
            'purpose.required' => trans('user_validation.Purpose is required'),
            'rent_period.required' => trans('user_validation.Rent period is required'),
            'price.required' => trans('user_validation.Price is required'),
            'description.required' => trans('user_validation.Description is required'),
            'city_id.required' => trans('user_validation.City is required'),
            'address.required' => trans('user_validation.Address is required'),
            'address_description.required' => trans('user_validation.Address details is required'),
            'google_map.required' => trans('user_validation.Google map is required'),
            'total_area.required' => trans('user_validation.Total area is required'),
            'total_unit.required' => trans('user_validation.Total unit is required'),
            'total_bedroom.required' => trans('user_validation.Total bedroom is required'),
            'total_bathroom.required' => trans('user_validation.Total bathroom is required'),
            'total_garage.required' => trans('user_validation.Total garage is required'),
            'total_kitchen.required' => trans('user_validation.Total kitchen is required')
        ];

        $this->validate($request, $rules,$customMessages);

         /* -------Dynamicly Update------*/


         if ($request->lang_code !== 'en') {
            updateOrCreateTransaltion($request, $property);
        }

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
        $property->total_bathroom = $request->total_bathroom;

        $property->city_id = $request->city_id;
        $property->country_id = $request->country_id;
        $property->address = $request->address;
        $property->address_description = $request->address_description;
        $property->google_map = $request->google_map;
        $property->lat = $request->lat;
        $property->lon = $request->lng;

        $property->video_id = $request->video_id;
        $property->video_description = $request->video_description;

        if($request->thumbnail_image){
            $old_thumbnail_image = $property->thumbnail_image;
            $extention = $request->thumbnail_image->getClientOriginalExtension();
            $image_name = 'property-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->thumbnail_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $property->thumbnail_image = $image_name;
            $property->save();

            if($old_thumbnail_image){
                if(File::exists(public_path().'/'.$old_thumbnail_image))unlink(public_path().'/'.$old_thumbnail_image);
            }
        }

        if($request->video_thumbnail){
            $old_video_thumbnail = $property->video_thumbnail;
            $extention = $request->video_thumbnail->getClientOriginalExtension();
            $image_name = 'video-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->video_thumbnail)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $property->video_thumbnail = $image_name;

            if($old_video_thumbnail){
                if(File::exists(public_path().'/'.$old_video_thumbnail))unlink(public_path().'/'.$old_video_thumbnail);
            }
        }

        $property->seo_title = $request->seo_title ? $request->seo_title : $request->title;
        $property->seo_meta_description = $request->seo_meta_description ? $request->seo_meta_description : $request->title;
        $property->status = $request->status ? 'enable' : 'disable';
        $property->is_featured = $request->is_featured ? 'enable' : 'disable';
        $property->is_top = $request->is_top ? 'enable' : 'disable';
        $property->is_urgent = $request->is_urgent ? 'enable' : 'disable';
        $property->save();

        PropertyAminity::where('property_id', $id)->delete();

        if($request->aminities){
            foreach($request->aminities as $aminity){
                $item = new PropertyAminity();
                $item->aminity_id = $aminity;
                $item->property_id = $property->id;
                $item->save();
            }
        }

        if($request->slider_images){
            foreach($request->slider_images as $index => $image){
                $extention = $image->getClientOriginalExtension();
                $image_name = 'Property-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                $image_name = 'uploads/custom-images/'.$image_name;
                Image::make($image)
                    ->encode('webp', 80)
                    ->save(public_path().'/'.$image_name);

                $slider = new PropertySlider();
                $slider->property_id = $property->id;
                $slider->image = $image_name;
                $slider->save();
            }
        }

        if($request->existing_nearest_locations && $request->existing_distances){
            foreach($request->existing_nearest_locations as $index => $nearest_location){
                if($request->existing_nearest_locations[$index] != '' && $request->existing_distances[$index] != '' && $request->existing_nearest_ids[$index] != ''){
                    $new_loc = PropertyNearestLocation::find($request->existing_nearest_ids[$index]);
                    $new_loc->nearest_location_id = $request->existing_nearest_locations[$index];
                    $new_loc->distance = $request->existing_distances[$index];
                    $new_loc->save();
                }
            }
        }

        if($request->nearest_locations && $request->distances){
            foreach($request->nearest_locations as $index => $nearest_location){
                if($request->nearest_locations[$index] != '' && $request->distances[$index] != ''){
                    $new_loc = new PropertyNearestLocation();
                    $new_loc->property_id = $property->id;
                    $new_loc->nearest_location_id = $request->nearest_locations[$index];
                    $new_loc->distance = $request->distances[$index];
                    $new_loc->save();
                }
            }
        }

        if($request->existing_add_keys && $request->existing_add_values){
            foreach($request->existing_add_keys as $index => $add_key){
                if($request->existing_add_keys[$index] != '' && $request->existing_add_values[$index] != '' && $request->existing_add_ids[$index] != ''){
                    $new_loc = AdditionalInformation::find($request->existing_add_ids[$index]);

                    if ($request->lang_code !== 'en') {
                        $new_loc->updateOrCreateTranslation($request->lang_code, 'add_key', $request->existing_add_keys[$index]);

                        $new_loc->updateOrCreateTranslation($request->lang_code, 'add_value', $request->existing_add_values[$index]);
                    } else {
                        $new_loc->add_key = $request->existing_add_keys[$index];
                        $new_loc->add_value = $request->existing_add_values[$index];
                        $new_loc->save();
                    }
                }
            }
        }




        if($request->add_keys && $request->add_values){
            foreach($request->add_keys as $index => $add_key){
                if($request->add_keys[$index] != '' && $request->add_values[$index] != ''){
                    $new_loc = new AdditionalInformation();
                    $new_loc->property_id = $property->id;

                    if ($request->lang_code !== 'en') {
                        $new_loc->updateOrCreateTranslation($request->lang_code, 'add_key', $request->add_keys[$index]);

                        $new_loc->updateOrCreateTranslation($request->lang_code, 'add_value', $request->add_values[$index]);
                    } else {
                        $new_loc->add_key = $request->add_keys[$index];
                        $new_loc->add_value = $request->add_values[$index];
                        $new_loc->save();
                    }

                }
            }
        }

        if($request->existing_plan_ids && $request->existing_plan_titles && $request->existing_plan_descriptions){
            foreach($request->existing_plan_ids as $index => $plan_id){

                if($request->existing_plan_ids[$index] && $request->existing_plan_titles[$index] && $request->existing_plan_descriptions[$index]){

                    $plan = PropertyPlan::find($request->existing_plan_ids[$index]);

                    if ($request->lang_code !== 'en') {

                        $plan->updateOrCreateTranslation($request->lang_code, 'title', $request->existing_plan_titles[$index]);

                        $plan->updateOrCreateTranslation($request->lang_code, 'description', $request->existing_plan_descriptions[$index]);
                    } else {
                        $plan->title = $request->existing_plan_titles[$index];
                        $plan->description = $request->existing_plan_descriptions[$index];
                        $plan->save();
                    }


                    $ex_name = 'existing_plan_image_'.$plan_id;
                    $request_exist_image = $request->$ex_name;

                    if($request_exist_image){
                        $exist_image = $plan->image;
                        $extention = $request_exist_image->getClientOriginalExtension();
                        $image_name = 'Property-plan'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                        $image_name = 'uploads/custom-images/'.$image_name;
                        Image::make($request_exist_image)
                            ->encode('webp', 80)
                            ->save(public_path().'/'.$image_name);

                        $plan->image = $image_name;
                        $plan->save();
                        if($exist_image){
                            if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
                        }
                    }

                }
            }
        }

        if($request->plan_images && $request->plan_titles && $request->plan_descriptions){
            foreach($request->plan_images as $index => $image){
                if($request->plan_images[$index] && $request->plan_titles[$index] && $request->plan_descriptions[$index]){
                    $extention = $image->getClientOriginalExtension();
                    $image_name = 'Property-plan'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                    $image_name = 'uploads/custom-images/'.$image_name;
                    Image::make($image)
                        ->encode('webp', 80)
                        ->save(public_path().'/'.$image_name);

                    $plan = new PropertyPlan();
                    $plan->property_id = $property->id;
                    $plan->image = $image_name;

                    if ($request->lang_code !== 'en') {

                        $plan->updateOrCreateTranslation($request->lang_code, 'title', $request->plan_titles[$index]);

                        $plan->updateOrCreateTranslation($request->lang_code, 'description', $request->plan_descriptions[$index]);
                    } else {
                        $plan->title = $request->plan_titles[$index];
                        $plan->description = $request->plan_descriptions[$index];
                        $plan->save();
                    }

                }
            }
        }

        $notification = trans('user_validation.Update succssfully');
        return response()->json(['message' => $notification]);
        

    }

    public function destroy($id){

        $user = Auth::guard('api')->user();
        if (!$user->can_add_property) {
            return response()->json(['message' => 'Unauthorized role'], 403);
        }
        $property = Property::where('id', $id)->where('agent_id', $user->id)->first();
        if (!$property) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        PropertyAminity::where('property_id', $id)->delete();
        PropertyNearestLocation::where('property_id', $id)->delete();
        AdditionalInformation::where('property_id', $id)->delete();
        Wishlist::where('property_id', $id)->delete();
        Review::where('property_id', $id)->delete();

        $existing_plans = PropertyPlan::where('property_id', $id)->get();

        foreach($existing_plans as $existing_plan){
            $old_image = $existing_plan->image;
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
            $existing_plan->delete();
        }

        $existing_sliders = PropertySlider::where('property_id', $id)->get();

        foreach($existing_sliders as $existing_slider){
            $old_slider = $existing_slider->image;
            if($old_slider){
                if(File::exists(public_path().'/'.$old_slider))unlink(public_path().'/'.$old_slider);
            }
            $existing_slider->delete();
        }


        $old_thumbnail_image = $property->thumbnail_image;
        if($old_thumbnail_image){
            if(File::exists(public_path().'/'.$old_thumbnail_image))unlink(public_path().'/'.$old_thumbnail_image);
        }

        $old_video_thumbnail = $property->video_thumbnail;
        if($old_video_thumbnail){
            if(File::exists(public_path().'/'.$old_video_thumbnail))unlink(public_path().'/'.$old_video_thumbnail);
        }

        $property->delete();

        $notification = trans('user_validation.Deleted successfully');
        return response()->json(['message' => $notification]);
    }

    public function remove_nearest_location($id){
        $user = Auth::guard('api')->user();
        if (!$user->can_add_property) {
            return response()->json(['message' => 'Unauthorized role'], 403);
        }
        $item = PropertyNearestLocation::find($id);
        if ($item) {
            $property = Property::where('id', $item->property_id)->where('agent_id', $user->id)->first();
            if (!$property) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $item->delete();
        }

        return response()->json(['message' => 'success']);
    }

    public function remove_add_info($id){
        $user = Auth::guard('api')->user();
        if (!$user->can_add_property) {
            return response()->json(['message' => 'Unauthorized role'], 403);
        }
        $item = AdditionalInformation::find($id);
        if ($item) {
            $property = Property::where('id', $item->property_id)->where('agent_id', $user->id)->first();
            if (!$property) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $item->delete();
        }

        return response()->json(['message' => 'success']);
    }

    public function remove_plan($id){
        $user = Auth::guard('api')->user();
        if (!$user->can_add_property) {
            return response()->json(['message' => 'Unauthorized role'], 403);
        }
        $plan = PropertyPlan::find($id);
        if ($plan) {
            $property = Property::where('id', $plan->property_id)->where('agent_id', $user->id)->first();
            if (!$property) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $old_image = $plan->image;
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
            $plan->delete();
        }

        return response()->json(['message' => 'success']);
    }

    public function remove_property_slider($id){
        $user = Auth::guard('api')->user();
        if (!$user->can_add_property) {
            return response()->json(['message' => 'Unauthorized role'], 403);
        }
        $slider = PropertySlider::find($id);
        if ($slider) {
            $property = Property::where('id', $slider->property_id)->where('agent_id', $user->id)->first();
            if (!$property) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $old_slider = $slider->image;
            if($old_slider){
                if(File::exists(public_path().'/'.$old_slider))unlink(public_path().'/'.$old_slider);
            }
            $slider->delete();
        }

        return response()->json(['message' => 'success']);
    }



}
