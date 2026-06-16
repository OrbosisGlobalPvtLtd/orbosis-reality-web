<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;
use Image;
use File;
class FaqController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $faqs=Faq::latest()->get();

        $stting = Setting::first();

        $content = (object) array(
            'short_title' => $stting->faq_short_title,
            'long_title' => $stting->faq_long_title,
            'support_image' => $stting->faq_image,
            'support_time' => $stting->faq_support_time,
            'support_title' => $stting->faq_support_title,
        );

        return view('admin.faq', compact('faqs','content'));
    }

    public function update_faq_content(Request $request){

        $rules = [
            'faq_short_title'=>'required',
            'faq_long_title'=>'required',
            'faq_support_time'=>'required',
            'faq_support_title'=>'required',
        ];
        $customMessages = [
            'faq_short_title.required' => trans('admin_validation.Short title is required'),
            'faq_long_title.required' => trans('admin_validation.Long title is required'),
            'faq_support_time.required' => trans('admin_validation.Support time is required'),
            'faq_support_title.required' => trans('admin_validation.Support title is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $stting = Setting::first();

        if($request->lang_code !== 'en'){
            updateOrCreateTransaltion($request, $stting, 'settings');
        }else{
            $stting->faq_short_title = $request->faq_short_title;
            $stting->faq_long_title = $request->faq_long_title;
            $stting->faq_support_time = $request->faq_support_time;
            $stting->faq_support_title = $request->faq_support_title;
            $stting->save();
        }

        

        if($request->support_image){
            $exist_banner = $stting->faq_image;
            $extention = $request->support_image->getClientOriginalExtension();
            $banner_name = 'faq-support'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->support_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$banner_name);
            $stting->faq_image = $banner_name;
            $stting->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function create()
    {
        return view('admin.create_faq');
    }


    public function store(Request $request)
    {
        $rules = [
            'question'=>'required',
            'answer'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'question.required' => trans('admin_validation.Question is required'),
            'question.unique' => trans('admin_validation.Question already exist'),
            'answer.required' => trans('admin_validation.Answer is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = $request->status;
        $faq->save();

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.faq.edit', ['faq' => $faq->id, 'lang_code' => admin_lang()])->with($notification);
    }

    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.edit_faq',compact('faq'));
    }

 
    public function update(Request $request,$id)
    {
        $faq = Faq::find($id);

        if($request->lang_code == 'en'){
            $rules = [
                'question'=>'required',
                'answer'=>'required',
                'status'=>'required',
            ];
        }else{
            $rules = [
                'question'=>'required',
                'answer'=>'required',
            ];
        }
        $customMessages = [
            'question.required' => trans('admin_validation.Question is required'),
            'question.unique' => trans('admin_validation.Question already exist'),
            'answer.required' => trans('admin_validation.Answer is required'),
        ];
        $this->validate($request, $rules,$customMessages);


        if($request->lang_code !== 'en'){
            updateOrCreateTransaltion($request, $faq, 'faqs');
        }else{
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->status = $request->status;
            $faq->save();
        }


       

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->deleteAllTranslations();
        $faq->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.faq.index')->with($notification);
    }

    public function changeStatus($id){
        $faq = Faq::find($id);
        if($faq->status==1){
            $faq->status=0;
            $faq->save();
            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $faq->status=1;
            $faq->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
