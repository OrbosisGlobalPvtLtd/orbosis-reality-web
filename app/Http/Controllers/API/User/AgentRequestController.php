<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\City;
use App\Models\CountryStateModal;
use Auth;
use Image;
use File;

class AgentRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function status()
    {
        $user = Auth::guard('api')->user();
        $profile = CompanyProfile::with(['city', 'state'])->where('user_id', $user->id)->first();

        $status = $user->agent_request_status;
        $label = $user->agent_request_label;

        $can_apply = in_array($status, ['not_applied', 'rejected']);
        $can_edit = in_array($status, ['pending', 'rejected']);
        $can_access_agent_features = ($status === 'approved');

        return response()->json([
            'status' => true,
            'message' => 'Agent request status fetched successfully.',
            'data' => [
                'login_type' => $user->login_type,
                'is_agency' => (int) $user->is_agency,
                'request_status' => $status,
                'request_label' => $label,
                'can_apply' => $can_apply,
                'can_edit' => $can_edit,
                'can_access_agent_features' => $can_access_agent_features,
                'company_profile' => $this->formatCompanyProfile($profile)
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::guard('api')->user();

        // Role authorization check
        if ($user->login_type !== 'user') {
            if ($user->login_type === 'agent') {
                return response()->json([
                    'status' => false,
                    'message' => 'already approved as agent'
                ], 400);
            }
            return response()->json([
                'status' => false,
                'message' => 'Only customer accounts can apply to become an agent.'
            ], 403);
        }

        // Pending check
        if ($user->is_agency == 2) {
            return response()->json([
                'status' => false,
                'message' => 'request already pending'
            ], 400);
        }

        // Validation rules
        $rules = [
            'company_name' => 'required|string|max:255',
            'agency_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:country_states,id',
            'about_agency' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rera_number' => 'nullable|string|max:100',
            'gst_number' => 'nullable|string|max:100',
            'id_proof' => 'required|file|mimes:pdf,jpeg,png,jpg|max:5120',
            'business_document' => 'required|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:5120',
        ];

        $request->validate($rules);

        $profile = CompanyProfile::where('user_id', $user->id)->first() ?: new CompanyProfile();

        // Upload Logo
        if ($request->hasFile('logo')) {
            $old_logo = $profile->image;
            if ($old_logo && File::exists(public_path($old_logo))) {
                File::delete(public_path($old_logo));
            }
            $logo = $request->file('logo');
            $logo_name = 'company-logo-'.date('YmdHis').'-'.rand(100,999).'.webp';
            $logo_path = 'uploads/custom-images/'.$logo_name;
            Image::make($logo)
                ->encode('webp', 80)
                ->save(public_path($logo_path));
            $profile->image = $logo_path;
        }

        // Upload ID Proof
        if ($request->hasFile('id_proof')) {
            $old_id = $profile->id_proof;
            if ($old_id && File::exists(public_path($old_id))) {
                File::delete(public_path($old_id));
            }
            $id_file = $request->file('id_proof');
            $ext = $id_file->getClientOriginalExtension();
            $id_name = 'id-proof-'.date('YmdHis').'-'.rand(100,999).'.'.$ext;
            $id_path = 'uploads/custom-images/'.$id_name;
            $id_file->move(public_path('uploads/custom-images'), $id_name);
            $profile->id_proof = $id_path;
        }

        // Upload Business Document
        if ($request->hasFile('business_document')) {
            $old_doc = $profile->file;
            if ($old_doc && File::exists(public_path($old_doc))) {
                File::delete(public_path($old_doc));
            }
            $doc_file = $request->file('business_document');
            $ext = $doc_file->getClientOriginalExtension();
            $doc_name = 'business-doc-'.date('YmdHis').'-'.rand(100,999).'.'.$ext;
            $doc_path = 'uploads/custom-images/'.$doc_name;
            $doc_file->move(public_path('uploads/custom-images'), $doc_name);
            $profile->file = $doc_path;
        }

        $profile->user_id = $user->id;
        $profile->company_name = $request->company_name;
        $profile->tag_line = $request->agency_name;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->city_id = $request->city_id;
        $profile->state_id = $request->state_id;
        $profile->about_us = $request->about_agency;
        $profile->rera_number = $request->rera_number;
        $profile->gst_number = $request->gst_number;
        $profile->email = $user->email;
        $profile->is_approved = 2; // pending
        $profile->save();

        $user->is_agency = 2;
        $user->save();

        $updatedProfile = CompanyProfile::with(['city', 'state'])->find($profile->id);

        return response()->json([
            'status' => true,
            'message' => 'Your agent request has been submitted and is pending admin approval.',
            'data' => [
                'request_status' => 'pending',
                'request_label' => 'Pending Admin Approval',
                'can_apply' => false,
                'can_edit' => true,
                'company_profile' => $this->formatCompanyProfile($updatedProfile)
            ]
        ], 200);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('api')->user();
        $status = $user->agent_request_status;

        // Authorization check for edit/resubmit
        if ($user->login_type !== 'user' || !in_array($status, ['pending', 'rejected'])) {
            return response()->json([
                'status' => false,
                'message' => 'You are not eligible to update this request.'
            ], 403);
        }

        // Validation rules (files are optional on update)
        $rules = [
            'company_name' => 'required|string|max:255',
            'agency_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:country_states,id',
            'about_agency' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rera_number' => 'nullable|string|max:100',
            'gst_number' => 'nullable|string|max:100',
            'id_proof' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
            'business_document' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:5120',
        ];

        $request->validate($rules);

        $profile = CompanyProfile::where('user_id', $user->id)->first() ?: new CompanyProfile();

        // Upload Logo if provided
        if ($request->hasFile('logo')) {
            $old_logo = $profile->image;
            if ($old_logo && File::exists(public_path($old_logo))) {
                File::delete(public_path($old_logo));
            }
            $logo = $request->file('logo');
            $logo_name = 'company-logo-'.date('YmdHis').'-'.rand(100,999).'.webp';
            $logo_path = 'uploads/custom-images/'.$logo_name;
            Image::make($logo)
                ->encode('webp', 80)
                ->save(public_path($logo_path));
            $profile->image = $logo_path;
        }

        // Upload ID Proof if provided
        if ($request->hasFile('id_proof')) {
            $old_id = $profile->id_proof;
            if ($old_id && File::exists(public_path($old_id))) {
                File::delete(public_path($old_id));
            }
            $id_file = $request->file('id_proof');
            $ext = $id_file->getClientOriginalExtension();
            $id_name = 'id-proof-'.date('YmdHis').'-'.rand(100,999).'.'.$ext;
            $id_path = 'uploads/custom-images/'.$id_name;
            $id_file->move(public_path('uploads/custom-images'), $id_name);
            $profile->id_proof = $id_path;
        }

        // Upload Business Document if provided
        if ($request->hasFile('business_document')) {
            $old_doc = $profile->file;
            if ($old_doc && File::exists(public_path($old_doc))) {
                File::delete(public_path($old_doc));
            }
            $doc_file = $request->file('business_document');
            $ext = $doc_file->getClientOriginalExtension();
            $doc_name = 'business-doc-'.date('YmdHis').'-'.rand(100,999).'.'.$ext;
            $doc_path = 'uploads/custom-images/'.$doc_name;
            $doc_file->move(public_path('uploads/custom-images'), $doc_name);
            $profile->file = $doc_path;
        }

        $profile->user_id = $user->id;
        $profile->company_name = $request->company_name;
        $profile->tag_line = $request->agency_name;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->city_id = $request->city_id;
        $profile->state_id = $request->state_id;
        $profile->about_us = $request->about_agency;
        $profile->rera_number = $request->rera_number;
        $profile->gst_number = $request->gst_number;
        $profile->email = $user->email;
        $profile->is_approved = 2; // reset status to pending
        $profile->save();

        $user->is_agency = 2; // set user state back to pending
        $user->save();

        $updatedProfile = CompanyProfile::with(['city', 'state'])->find($profile->id);

        return response()->json([
            'status' => true,
            'message' => 'Your agent request has been submitted and is pending admin approval.',
            'data' => [
                'request_status' => 'pending',
                'request_label' => 'Pending Admin Approval',
                'can_apply' => false,
                'can_edit' => true,
                'company_profile' => $this->formatCompanyProfile($updatedProfile)
            ]
        ], 200);
    }

    private function formatCompanyProfile($profile)
    {
        if (!$profile) {
            return null;
        }

        return [
            'company_name' => $profile->company_name,
            'agency_name' => $profile->tag_line,
            'phone' => $profile->phone,
            'address' => $profile->address,
            'city' => $profile->city ? [
                'id' => $profile->city->id,
                'name' => $profile->city->name
            ] : null,
            'state' => $profile->state ? [
                'id' => $profile->state->id,
                'name' => $profile->state->name
            ] : null,
            'logo_url' => $profile->image ? asset($profile->image) : null,
            'id_proof_url' => $profile->id_proof ? asset($profile->id_proof) : null,
            'business_document_url' => $profile->file ? asset($profile->file) : null
        ];
    }
}
