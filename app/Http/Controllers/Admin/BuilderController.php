<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Builder;
use App\Models\Property;
use App\Models\Order;
use App\Models\Review;
use App\Models\Wishlist;
use File;

class BuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $type = $request->query('type');
        $query = User::where('login_type', 'builder')->with('builder');

        if ($type === 'pending') {
            $query->whereHas('builder', function ($q) {
                $q->where('status', Builder::STATUS_PENDING);
            });
        } elseif ($type === 'rejected') {
            $query->whereHas('builder', function ($q) {
                $q->where('status', Builder::STATUS_REJECTED);
            });
        } elseif ($type === 'suspended') {
            $query->whereHas('builder', function ($q) {
                $q->where('status', Builder::STATUS_SUSPENDED);
            });
        } else {
            $query->whereHas('builder', function ($q) {
                $q->where('status', Builder::STATUS_APPROVED);
            });
        }

        $builders = $query->orderBy('id', 'desc')->get();

        return view('admin.builder', compact('builders', 'type'));
    }

    public function show($id)
    {
        $builderUser = User::where('id', $id)->where('login_type', 'builder')->with('builder')->first();

        if (!$builderUser) {
            $notification = trans('admin_validation.Builder not found');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('admin.builder')->with($notification);
        }

        $total_property = Property::where('agent_id', $builderUser->id)->count();
        $total_pending_property = Property::where('agent_id', $builderUser->id)->where('status', 'disable')->count();
        $total_active_property = Property::where('agent_id', $builderUser->id)->where('status', 'enable')->count();
        $total_purchase_amount = Order::where('agent_id', $builderUser->id)->where('payment_status', 'success')->sum('plan_price');

        $default_user_avatar = \App\Models\Setting::first()->default_avatar ?? '';

        return view('admin.show_builder', compact(
            'builderUser',
            'total_property',
            'total_pending_property',
            'total_active_property',
            'total_purchase_amount',
            'default_user_avatar'
        ));
    }

    public function changeStatus(Request $request, $id)
    {
        $isDemo = env('APP_MODE');
        if ($isDemo == 'DEMO') {
            return response()->json('This Is Demo Version. You Can Not Change Anything', 400);
        }

        $user = User::where('id', $id)->where('login_type', 'builder')->first();
        if (!$user) {
            return response()->json('Builder not found', 404);
        }

        $builder = $user->builder;
        if (!$builder) {
            return response()->json('Builder profile not found', 404);
        }

        if ($request->has('status')) {
            $status = (int)$request->status;
            if (!in_array($status, [Builder::STATUS_PENDING, Builder::STATUS_APPROVED, Builder::STATUS_REJECTED, Builder::STATUS_SUSPENDED])) {
                return response()->json('Invalid status value', 400);
            }
            $builder->status = $status;
            if ($status === Builder::STATUS_APPROVED) {
                $builder->verified_at = now();
                $builder->verified_by = auth('admin')->user()->id ?? null;
            }
            $builder->save();

            switch ($status) {
                case Builder::STATUS_APPROVED:
                    $message = trans('admin_validation.Approved Successfully');
                    break;
                case Builder::STATUS_REJECTED:
                    $message = trans('admin_validation.Rejected Successfully');
                    break;
                case Builder::STATUS_SUSPENDED:
                    $message = trans('admin_validation.Suspended Successfully');
                    break;
                case Builder::STATUS_PENDING:
                default:
                    $message = trans('admin_validation.Set to Pending Successfully');
                    break;
            }
        } else {
            if ($builder->status == Builder::STATUS_APPROVED) {
                $builder->status = Builder::STATUS_PENDING;
                $builder->save();
                $message = trans('admin_validation.Inactive Successfully');
            } else {
                $builder->status = Builder::STATUS_APPROVED;
                $builder->verified_at = now();
                $builder->verified_by = auth('admin')->user()->id ?? null;
                $builder->save();
                $message = trans('admin_validation.Active Successfully');
            }
        }

        return response()->json($message);
    }

    public function destroy($id)
    {
        $isDemo = env('APP_MODE');
        if ($isDemo == 'DEMO') {
            $notification = 'This Is Demo Version. You Can Not Change Anything';
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $user = User::where('id', $id)->where('login_type', 'builder')->first();
        if (!$user) {
            $notification = trans('admin_validation.Builder not found');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $property_count = Property::where('agent_id', $id)->count();

        if ($property_count == 0) {
            Wishlist::where('user_id', $id)->delete();
            Review::where('user_id', $id)->delete();
            Review::where('agent_id', $id)->delete();
            Order::where('agent_id', $id)->delete();

            $builder = $user->builder;
            if ($builder) {
                $doc = $builder->business_registration_doc;
                $logo = $builder->company_logo;
                if ($doc && File::exists(public_path($doc))) {
                    File::delete(public_path($doc));
                }
                if ($logo && File::exists(public_path($logo))) {
                    File::delete(public_path($logo));
                }
                $builder->delete();
            }

            $user_image = $user->image;
            $user->delete();

            if ($user_image && File::exists(public_path($user_image))) {
                File::delete(public_path($user_image));
            }

            $notification = trans('admin_validation.Delete Successfully');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect()->route('admin.builder')->with($notification);
        } else {
            $notification = trans('admin_validation.In this item multiple property exist, so you can not delete this item');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
