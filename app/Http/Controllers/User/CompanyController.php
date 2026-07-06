<?php

namespace App\Http\Controllers\User;

use Image;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Property;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CountryStateModal;
use App\Models\CompanyProfile;
use Modules\Kyc\Entities\KycType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }


    public function index(){

        $user = Auth::guard('web')->user();
        $kycType = KycType::orderBy('id', 'desc')->where('status', 1)->get();

        return view('user.company', compact('user', 'kycType'));
    }

    public function my_team(){

        $user = Auth::guard('web')->user();
        $agents = User::where('owner_id', $user->id)->get();
        return view('user.my_team', compact('user', 'agents'));
    }


    public function create_company(){

        $user = Auth::guard('web')->user();
        $kycType = KycType::orderBy('id', 'desc')->get();

        return view('user.company_create', compact('user', 'kycType'));
    }

    public function edit_agency_information($id){

        $user = Auth::guard('web')->user();
        $kycType = KycType::orderBy('id', 'desc')->get();

        return view('user.company_edit', compact('user', 'kycType'));
    }

    public function create_agent(){

        $user = Auth::guard('web')->user();

        $agent_id = $user->id;

        if(($user->owner_id == 0 && $user->is_agency ==1) || ($user->owner_id == 0 && $user->is_agency ==0)){
            $agent_order = Order::where('agent_id', $agent_id)->where('order_status','active')->orderBy('id','desc')->first();
        }else{
            $owner_id = $user->owner_id;
            $agent_order = Order::where('agent_id', $owner_id)->where('order_status','active')->orderBy('id','desc')->first();
        }

        if($agent_order){

            $available = 'disable';

            $expiration_date = $agent_order->expiration_date;

            if($expiration_date != 'lifetime'){
                if(date('Y-m-d') > $expiration_date){
                    $notification = trans('user_validation.Pricing plan date is expired');
                    $notification = array('messege'=>$notification,'alert-type'=>'error');
                    return redirect()->back()->with($notification);
                }
            }

            $max_agent_add = $agent_order->max_agent_add;



            if($max_agent_add > 0){
                $available = 'enable';
            }else{

                $agent_count = User::where('owner_id', $user->id)->count();

                if($agent_count < $max_agent_add){
                    $available = 'enable';
                }
            }

            if($available == 'disable'){
                $notification = trans('user_validation.You can not add agent more than limit quantity');
                $notification = array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }

        }else{
            $notification = trans('user_validation.Agent does not have any pricing plan');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }


        return view('user.agent_create', compact('user'));
    }

    public function agency_agent_edit($id){

        $user = Auth::guard('web')->user();

        $agent = User::where('id', $id)->firstOrFail();

        return view('user.agency_agent_edit', compact('user', 'agent'));

    }

    public function apply_company(Request $request){
         $rules = [
            'name'=>'required',
            'email'=>'required|unique:company_profiles',
            'phone'=>'required|unique:company_profiles',
            'tag_line'=>'required',
            'address'=>'required',
            'about_us'=>'required',
            'kyc_id'=>'required',
            'file'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'tag_line.required' => trans('admin_validation.Desgination is required'),
            'address.required' => trans('admin_validation.Address is required'),
            'about_us.required' => trans('admin_validation.About is required'),
            'kyc_id.required' => trans('admin_validation.Type of is required'),
            'file' => trans('admin_validation.File is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();

        if($user->is_agency == 2){
            $notification=trans('admin_validation.you already applied for agency');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        if($user->is_agency == 1){
            $notification=trans('admin_validation.Your agency application has already been approved.');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        if($user->owner_id != 0){
            $notification=trans('admin_validation.You are not eligible');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $companyProfile = $user?->profile;


        if ($companyProfile) {

            $old_image=$companyProfile->image;

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }

            $companyProfile->delete();
        }

        $companyProfile = new CompanyProfile();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $image_name = 'company-logo'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $companyProfile->image = $image_name;
        }

        if($request->file){
            $extention = $request->file->getClientOriginalExtension();
            $img_name = 'document'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $img_name = 'uploads/custom-images/'.$img_name;
            $request->file->move(public_path('uploads/custom-images/'),$img_name);
            $companyProfile->file = $img_name;
        }

        $companyProfile->user_id = $user->id;
        $companyProfile->company_name = $request->name;
        $companyProfile->tag_line = $request->tag_line;
        $companyProfile->about_us = $request->about_us;
        $companyProfile->email = $request->email;
        $companyProfile->phone = $request->phone;
        $companyProfile->facebook = $request->facebook;
        $companyProfile->twitter = $request->twitter;
        $companyProfile->linkedin = $request->linkedin;
        $companyProfile->instagram = $request->instagram;
        $companyProfile->address = $request->address;
        $companyProfile->is_approved = 2;
        $companyProfile->kyc_id = $request->kyc_id;
        $companyProfile->message = $request->message;
        $companyProfile->save();

        $user->is_agency = 2;
        $user->save();

        $notification = trans('admin_validation.Agency application success. Admin will verify your application.');
        $notification = array('messege' => $notification, 'alert-type' => 'success');

        return redirect()->route('user.dashboard')->with($notification);

    }

    public function update_agency_information(Request $request, $id){
        $rules = [
           'name'=>'required',
           'email'=>'required|unique:company_profiles,email,'.$id,
           'phone'=>'required|unique:company_profiles,phone,'.$id,
           'tag_line'=>'required',
           'address'=>'required',
           'about_us'=>'required',
       ];
       $customMessages = [
           'name.required' => trans('admin_validation.Name is required'),
           'email.required' => trans('admin_validation.Email is required'),
           'email.unique' => trans('admin_validation.Email already exist'),
           'phone.required' => trans('admin_validation.Phone is required'),
           'tag_line.required' => trans('admin_validation.Desgination is required'),
           'address.required' => trans('admin_validation.Address is required'),
           'about_us.required' => trans('admin_validation.About is required'),
       ];
       $this->validate($request, $rules,$customMessages);

       $user = Auth::guard('web')->user();

       if($user->is_agency == 2){
           $notification=trans('admin_validation.you already applied for agency');
           $notification=array('messege'=>$notification,'alert-type'=>'error');
           return redirect()->back()->with($notification);
       }

       $companyProfile = $user->profile;


       if ($companyProfile) {

           if($request->image){

               $old_image=$companyProfile->image;

               $extention = $request->image->getClientOriginalExtension();
               $image_name = 'company-logo'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
               $image_name = 'uploads/custom-images/'.$image_name;

               Image::make($request->image)
                   ->encode('webp', 80)
                   ->save(public_path().'/'.$image_name);
               $companyProfile->image = $image_name;

               if($old_image){
                   if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
               }

           }

           if($request->file){

                $old_document=$companyProfile->file;

                $extention = $request->file->getClientOriginalExtension();
                $img_name = 'document'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                $img_name = 'uploads/custom-images/'.$img_name;
                $request->file->move(public_path('uploads/custom-images/'),$img_name);
                $companyProfile->file = $img_name;

                if($old_document){
                    if(File::exists(public_path().'/'.$old_document))unlink(public_path().'/'.$old_document);
                }
            }

           $companyProfile->user_id = $user->id;
           $companyProfile->company_name = $request->name;
           $companyProfile->tag_line = $request->tag_line;
           $companyProfile->about_us = $request->about_us;
           $companyProfile->email = $request->email;
           $companyProfile->phone = $request->phone;
           $companyProfile->facebook = $request->facebook;
           $companyProfile->twitter = $request->twitter;
           $companyProfile->linkedin = $request->linkedin;
           $companyProfile->instagram = $request->instagram;
           $companyProfile->address = $request->address;
           $companyProfile->kyc_id = $request->has('kyc_id') ? $request->kyc_id : $companyProfile->kyc_id;
           $companyProfile->message = $request->has('message') ? $request->message : $companyProfile->message;
           $companyProfile->save();


           $notification = trans('admin_validation.Updated successfully');
           $notification = array('messege' => $notification, 'alert-type' => 'success');
       }else{
           $notification = trans('admin_validation.Not found');
           $notification = array('messege' => $notification, 'alert-type' => 'error');
       }

       return redirect()->back()->with($notification);

   }

    public function store_agent(Request $request){



        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users',
            'phone'=>'required|unique:users',
            'designation'=>'required',
            'address'=>'required',
            'about_me'=>'required',
            'password'=>'required|confirmed',
        ];

        $customMessages = [
            'password.required' => trans('admin_validation.Password is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'designation.required' => trans('admin_validation.Desgination is required'),
            'address.required' => trans('admin_validation.Address is required'),
            'about_me.required' => trans('admin_validation.About is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $agent = new User();

        $user = Auth::guard('web')->user();

        if($user->is_agency != 1){
            $notification=trans('user.To create agent first you need to be an agency');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $image_name = 'agent'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $agent->image = $image_name;
        }

        $agent->password = Hash::make($request->password);
        $agent->user_name = Str::slug($request->name).'-'.date('Ymdhis');
        $agent->name = $request->name;
        $agent->phone = $request->phone;
        $agent->email = $request->email;
        $agent->designation = $request->designation;
        $agent->address = $request->address;
        $agent->about_me = $request->about_me;
        $agent->facebook = $request->facebook;
        $agent->twitter = $request->twitter;
        $agent->linkedin = $request->linkedin;
        $agent->instagram = $request->instagram;
        $agent->status = $request->has('status') ? 1 : 0;
        $agent->owner_id = $user->id;
        $agent->save();

        $notification=trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function agency_agent_update(Request $request, $id){

        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id,
            'phone'=>'required|unique:users,phone,'.$id,
            'designation'=>'required',
            'address'=>'required',
            'about_me'=>'required',
        ];

        $customMessages = [
            'password.required' => trans('admin_validation.Password is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'designation.required' => trans('admin_validation.Desgination is required'),
            'address.required' => trans('admin_validation.Address is required'),
            'about_me.required' => trans('admin_validation.About is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $agent = User::where('id', $id)->firstOrFail();

        $user = Auth::guard('web')->user();

        if($user->is_agency != 1){
            $notification=trans('user.To create agent first you need to be an agency');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $image_name = 'agent'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $agent->image = $image_name;
        }

        $agent->user_name = Str::slug($request->name).'-'.date('Ymdhis');
        $agent->name = $request->name;
        $agent->phone = $request->phone;
        $agent->email = $request->email;
        $agent->designation = $request->designation;
        $agent->address = $request->address;
        $agent->about_me = $request->about_me;
        $agent->facebook = $request->facebook;
        $agent->twitter = $request->twitter;
        $agent->linkedin = $request->linkedin;
        $agent->instagram = $request->instagram;
        $agent->status = $request->has('status') ? 1 : 0;
        $agent->owner_id = $user->id;
        $agent->save();

        $notification=trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id){

        $property_count = Property::where('agent_id', $id)->count();

        if($property_count == 0){
            Wishlist::where('user_id', $id)->delete();
            Review::where('user_id', $id)->delete();
            Review::where('agent_id', $id)->delete();
            Order::where('agent_id', $id)->delete();

            $user = User::find($id);
            $user_image = $user?->image;
            $user->delete();
            if($user_image){
                if(File::exists(public_path().'/'.$user_image))unlink(public_path().'/'.$user_image);
            }

            $notification = trans('admin_validation.Delete Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $notification = trans('admin_validation.In this item multiple property exist, so you can not delete this item');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }

    public function becomeAgentForm()
    {
        $user = Auth::guard('web')->user();
        if ($user->login_type !== 'user' || ($user->is_agency != 0 && $user->is_agency != 2)) {
            return redirect()->route('user.dashboard');
        }
        $cities = City::all();
        $states = CountryStateModal::all();

        // Get setting for breadcrumb
        $setting = \App\Models\Setting::first();
        $breadcrumb = $setting->breadcrumb ?? '';

        return view('user.become_agent', compact('user', 'cities', 'states', 'breadcrumb'));
    }

    public function becomeAgentSubmit(Request $request)
    {
        $rules = [
            'company_name'=>'required|string|max:255',
            'agency_name'=>'required|string|max:255',
            'phone'=>'required|string|max:20',
            'address'=>'required|string|max:500',
            'city_id'=>'required|exists:cities,id',
            'state_id'=>'required|exists:country_states,id',
            'about_agency'=>'required|string',
            'logo'=>'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'rera_number'=>'nullable|string|max:100',
            'gst_number'=>'nullable|string|max:100',
            'id_proof'=>'required|file|mimes:pdf,jpeg,png,jpg|max:5120',
            'business_documents'=>'required|file|mimes:pdf,jpeg,png,jpg,doc,docx,zip|max:10240',
        ];

        $request->validate($rules);

        $user = Auth::guard('web')->user();

        if ($user->login_type !== 'user' || $user->is_agency != 0) {
            $notification = array('messege' => 'You are not eligible to apply.', 'alert-type' => 'error');
            return redirect()->route('user.dashboard')->with($notification);
        }

        $companyProfile = CompanyProfile::where('user_id', $user->id)->first() ?: new CompanyProfile();

        // Upload Logo
        if($request->hasFile('logo')){
            $old_logo = $companyProfile->image;
            if($old_logo && File::exists(public_path($old_logo))){
                File::delete(public_path($old_logo));
            }
            $ext = $request->file('logo')->getClientOriginalExtension();
            $logo_name = 'company-logo-'.date('YmdHis').'-'.rand(100,999).'.webp';
            $logo_path = 'uploads/custom-images/'.$logo_name;
            Image::make($request->file('logo'))
                ->encode('webp', 80)
                ->save(public_path($logo_path));
            $companyProfile->image = $logo_path;
        }

        // Upload ID Proof
        if($request->hasFile('id_proof')){
            $old_id = $companyProfile->id_proof;
            if($old_id && File::exists(public_path($old_id))){
                File::delete(public_path($old_id));
            }
            $ext = $request->file('id_proof')->getClientOriginalExtension();
            $id_name = 'id-proof-'.date('YmdHis').'-'.rand(100,999).'.'.$ext;
            $id_path = 'uploads/custom-images/'.$id_name;
            $request->file('id_proof')->move(public_path('uploads/custom-images'), $id_name);
            $companyProfile->id_proof = $id_path;
        }

        // Upload Business Documents
        if($request->hasFile('business_documents')){
            $old_doc = $companyProfile->file;
            if($old_doc && File::exists(public_path($old_doc))){
                File::delete(public_path($old_doc));
            }
            $ext = $request->file('business_documents')->getClientOriginalExtension();
            $doc_name = 'business-doc-'.date('YmdHis').'-'.rand(100,999).'.'.$ext;
            $doc_path = 'uploads/custom-images/'.$doc_name;
            $request->file('business_documents')->move(public_path('uploads/custom-images'), $doc_name);
            $companyProfile->file = $doc_path;
        }

        $companyProfile->user_id = $user->id;
        $companyProfile->company_name = $request->company_name;
        $companyProfile->tag_line = $request->agency_name;
        $companyProfile->phone = $request->phone;
        $companyProfile->address = $request->address;
        $companyProfile->city_id = $request->city_id;
        $companyProfile->state_id = $request->state_id;
        $companyProfile->about_us = $request->about_agency;
        $companyProfile->rera_number = $request->rera_number;
        $companyProfile->gst_number = $request->gst_number;
        $companyProfile->email = $user->email;
        $companyProfile->is_approved = 2; // pending
        $companyProfile->save();

        $user->is_agency = 2;
        $user->save();

        $notification = array(
            'messege' => 'Your agent request has been submitted and is pending admin approval.',
            'alert-type' => 'success'
        );

        return redirect()->route('user.dashboard')->with($notification);
    }

}
