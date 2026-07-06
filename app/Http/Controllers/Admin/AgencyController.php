<?php

namespace App\Http\Controllers\Admin;

use Str;
use Hash;
use Mail;
use File;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Setting;

use App\Models\Property;
use App\Models\Wishlist;
use App\Helpers\MailHelper;
use App\Models\PricingPlan;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Intervention\Image\Image;
use App\Models\CompanyProfile;
use App\Mail\SendSingleAgentMail;
use App\Http\Controllers\Controller;

class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        if ($request->type == 'pending') {
            $agencies = User::where('is_agency', 2)->orderBy('id','desc')->get();
        } else {
            $agencies = User::where('login_type', 'agent')->where('is_agency', 1)->orderBy('id','desc')->get();
        }

        return view('admin.agency', compact('agencies'));
    }

    public function show($id){

        $agent = User::where('id', $id)->whereIn('is_agency', [1,2])->first();
        $agents = [];

        if($agent){
            if($agent->is_agency == 0 || $agent->is_agency == 2){

                $total_property = Property::where('agent_id', $agent->id)->count();
                $total_pending_property = Property::where('agent_id', $agent->id)->where('status','disable')->count();
                $total_active_property = Property::where('agent_id', $agent->id)->where('status','enable')->count();
                $total_purchase_amount = Order::where('agent_id', $id)->where('payment_status', 'success')->sum('plan_price');

            }elseif($agent->is_agency == 1){

                $agent_ids = User::where('login_type', 'agent')->where('owner_id', $agent->id)->where('status', 1)->pluck('id')->toArray();
                $agents = User::where('login_type', 'agent')->where('owner_id', $agent->id)->get();
                $agent_ids[] = $agent->id;

                $total_property = Property::whereIn('agent_id', $agent_ids)->count();
                $total_pending_property = Property::whereIn('agent_id', $agent_ids)->where('status','disable')->count();
                $total_active_property = Property::whereIn('agent_id', $agent_ids)->where('status','enable')->count();

                $total_purchase_amount = Order::whereIn('agent_id', $agent_ids)->where('payment_status', 'success')->sum('plan_price');
            }
        }else{
            $notification = trans('admin_validation.Agency not found');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }


        return view('admin.show_agency',compact('agent','total_property','total_pending_property','total_active_property','total_purchase_amount', 'agents'));

    }

    public function agency_approve($id){

        $agency = User::where('id', $id)->where('is_agency', 2)->first();

        if($agency){

            $agency->is_agency = 1;
            $agency->login_type = 'agent';
            $agency->save();

            $notification = trans('admin_validation.Agency Approved Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $notification = trans('admin_validation.Agency not found');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }

    public function update_agency(Request $request, $id){

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

       $companyProfile = CompanyProfile::where('id', $id)->first();

       if ($companyProfile) {

           $companyProfile->company_name = $request->name;
           $companyProfile->tag_line = $request->tag_line;
           $companyProfile->about_us = $request->about_us;
           $companyProfile->phone = $request->phone;
           $companyProfile->facebook = $request->facebook;
           $companyProfile->twitter = $request->twitter;
           $companyProfile->linkedin = $request->linkedin;
           $companyProfile->instagram = $request->instagram;
           $companyProfile->address = $request->address;
           $companyProfile->save();


           $notification = trans('admin_validation.Updated successfully');
           $notification = array('messege' => $notification, 'alert-type' => 'success');
       }else{
           $notification = trans('admin_validation.Not found');
           $notification = array('messege' => $notification, 'alert-type' => 'error');
       }

       return redirect()->back()->with($notification);

   }

   public function destroy($id){

    $property_count = Property::where('agent_id', $id)->count();

    $agents = User::where('login_type', 'agent')->where('owner_id', $id)->count();

    if($agents > 0){
        $notification = trans('admin_validation.In this item multiple agents exist, so you can not delete this item');
        $notification = array('messege'=>$notification,'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }





    if($property_count == 0){
        // Wishlist::where('user_id', $id)->delete();
        // Review::where('user_id', $id)->delete();
        // Review::where('agent_id', $id)->delete();
        // Order::where('agent_id', $id)->delete();

        $companyProfile = CompanyProfile::where('user_id', $id)->firstOrFail();

        $user_image = $companyProfile->image;
        $user_file = $companyProfile->file;
        $companyProfile->delete();
        if($user_image){
            if(File::exists(public_path().'/'.$user_image))unlink(public_path().'/'.$user_image);
        }

        if($user_file){
            if(File::exists(public_path().'/'.$user_file))unlink(public_path().'/'.$user_file);
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

    public function pendingAgentRequests(Request $request)
    {
        $requests = User::where('is_agency', 2)->orderBy('id', 'desc')->get();
        return view('admin.pending_agent_requests', compact('requests'));
    }

    public function showPendingAgentRequest($id)
    {
        $user = User::where('id', $id)->where('is_agency', 2)->firstOrFail();
        $setting = Setting::first();
        $default_avatar = $setting->default_avatar ?? '';
        return view('admin.show_pending_agent_request', compact('user', 'default_avatar'));
    }

    public function approveAgentRequest($id)
    {
        $user = User::where('id', $id)->where('is_agency', 2)->firstOrFail();

        $profile = CompanyProfile::where('user_id', $user->id)->first();
        if ($profile) {
            $profile->is_approved = 1;
            $profile->save();
        }

        $user->is_agency = 1;
        $user->login_type = 'agent';
        $user->save();

        $notification = array(
            'messege' => 'Agent Request Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.pending-agent-requests')->with($notification);
    }

    public function rejectAgentRequest($id)
    {
        $user = User::where('id', $id)->where('is_agency', 2)->firstOrFail();

        $profile = CompanyProfile::where('user_id', $user->id)->first();
        if ($profile) {
            $profile->is_approved = 0;
            $profile->save();
        }

        $user->is_agency = 0;
        $user->login_type = 'user';
        $user->save();

        $notification = array(
            'messege' => 'Agent Request Rejected Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.pending-agent-requests')->with($notification);
    }

    public function viewDocument($id, $type)
    {
        $profile = CompanyProfile::where('user_id', $id)->firstOrFail();
        
        $filePath = null;
        if ($type === 'id_proof') {
            $filePath = $profile->id_proof;
        } elseif ($type === 'business_document') {
            $filePath = $profile->file;
        } elseif ($type === 'logo') {
            $filePath = $profile->image;
        }

        if (!$filePath) {
            abort(404, 'Document not uploaded');
        }

        $path = public_path($filePath);
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->file($path);
    }

    public function downloadDocument($id, $type)
    {
        $profile = CompanyProfile::where('user_id', $id)->firstOrFail();
        
        $filePath = null;
        if ($type === 'id_proof') {
            $filePath = $profile->id_proof;
        } elseif ($type === 'business_document') {
            $filePath = $profile->file;
        } elseif ($type === 'logo') {
            $filePath = $profile->image;
        }

        if (!$filePath) {
            abort(404, 'Document not uploaded');
        }

        $path = public_path($filePath);
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->download($path);
    }
}

