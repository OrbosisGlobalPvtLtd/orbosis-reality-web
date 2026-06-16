<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;

use Illuminate\Http\Request;
use App\Events\LanguageObserver;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Event;
use Modules\Subscription\Entities\SubscriptionPlan;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $languages = Language::all();

        return view('admin.language_list', compact('languages'));
    }

    public function create()
    {
        return view('admin.create_language');
    }

    public function store(Request $request)
    {
        $rules = [
            'lang_name' => 'required|unique:languages',
            'country_code' => 'required|unique:languages',
            'lang_code' => 'required|unique:languages',
        ];

        $customMessages = [
            'lang_name.required' => trans('admin_validation.Name is required'),
            'country_code.required' => trans('admin_validation.Code is required'),
            'country_code.unique' => trans('admin_validation.Code already exists'),
            'lang_name.unique' => trans('admin_validation.Name already exists'),
            'lang_code.required' => trans('admin_validation.Code is required'),
            'lang_code.unique' => trans('admin_validation.Code already exists'),
        ];

        $this->validate($request, $rules, $customMessages);

        $language = new Language();

        if ($request->is_default == 'yes') {
            DB::table('languages')->update(['is_default' => 'no']);
        }

        $language->lang_name = $request->lang_name;
        $language->country_code = $request->country_code;
        $language->lang_code = $request->lang_code;
        $language->is_default = $request->is_default;
        $language->lang_direction = $request->lang_direction;
        $language->status = $request->status;


        if ($language->save()) {
            // Trigger the language creation event
            $languageData = [
                'lang_code' => $language->lang_code,
                'operation' => 'insert',
            ];
            Event::dispatch(new LanguageObserver($languageData));
        }



        // Create a language directory
        $path = base_path('lang/' . $request->lang_code);

        if (!File::exists($path)) {
            File::makeDirectory($path);
            // Copy default English files into the new language folder
            $sourcePath = base_path('lang/en');
            $files = File::allFiles($sourcePath);


            foreach ($files as $file) {
                $destinationFile = $path . '/' . $file->getRelativePathname();
                File::copy($file->getRealPath(), $destinationFile);
            }


            // dynamically generate
            /* $directory = base_path('lang/' . $request->lang_code);
            $phpFiles = glob($directory . '/*.php');

            // Check if any .php files were found
            if (!empty($phpFiles)) {
                foreach ($phpFiles as $filePath) {
                    if(file_exists($filePath)) {
                        $fileLangDatas = File::getRequire($filePath);
                        if( !empty($fileLangDatas) && is_array($fileLangDatas)){
                            $allLangVals = [];
                            foreach($fileLangDatas as $key=>$langVal){
                                $allLangVals[$key] = gTranslate($langVal,$request->lang_code);
                               $content = '<?php return ' . var_export($allLangVals, true) . ';';
                                File::put($filePath, $content);
                            }
                        }
                    }
                }
            } */
        }



        $notification = trans('admin_validation.Created Successfully');
        return redirect()->route('admin.language')->with(['messege' => $notification, 'alert-type' => 'success']);
    }

    public function edit($id)
    {

        $language = Language::findOrFail($id);
        $lang_firstId = Language::first()->id;
        return view('admin.edit_language', compact('language', 'lang_firstId'));
    }

    public function update(Request $request, $id)
    {

        if (Language::findOrFail($id)->lang_code !== 'en') {
            $rules = [
                'lang_name' => 'required|unique:languages,id,' . $id,
                'country_code' => 'required|unique:languages,id,' . $id,
                // 'lang_code' => 'required|unique:languages,id,' . $id,
            ];

            $customMessages = [
                'lang_name.required' => trans('admin_validation.Name is required'),
                'lang_name.unique' => trans('admin_validation.Name already exist'),
                'country_code.required' => trans('admin_validation.Code is required'),
                'country_code.unique' => trans('admin_validation.Code already exist'),
                'lang_code.required' => trans('admin_validation.Code is required'),
                'lang_code.unique' => trans('admin_validation.Code already exist'),
            ];
            $request->validate($rules, $customMessages);
        }




        $language = Language::findOrFail($id);

        if ($language->id != Language::first()->id) {
            $old_path = base_path() . '/lang' . '/' . $language->lang_code;
            $update_path = base_path() . '/lang' . '/' . $request->lang_code;

            if (File::exists($old_path) && $old_path != $update_path) {
                File::move($old_path, $update_path);
            }
        }
        if ($request->is_default == 'yes') {
            DB::table('languages')->where('id', '!=', $language->id)->update(['is_default' => 'no']);
        } else {
            $defaultLanguageExists = DB::table('languages')->where('is_default', 'yes')->exists();

            if (!$defaultLanguageExists) {
                $fallbackLanguage = DB::table('languages')->first();
                if ($fallbackLanguage) {
                    DB::table('languages')->where('id', $fallbackLanguage->id)->update(['is_default' => 'yes']);
                }
            }
        }



        if ($language->id != Language::first()->id) {
            $language->lang_name = $request->lang_name;
            $language->country_code = $request->country_code;
        }

        if ($language->id != Language::first()->id) {
            // $language->lang_code = $request->lang_code;
        }


        $language->is_default = $request->is_default;

        $language->lang_direction = $request->lang_direction;

        if ($language->id != Language::first()->id) {
            $language->status = $request->status;
        }

        if ($language->save()) {
            // Language update successful
            $languageData = [
                'lang_code' => $language->lang_code,
                'operation' => 'update',
            ];

            Event::dispatch(new LanguageObserver($languageData));
        }




        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('admin.language')->with($notification);
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $path = lang_path($language->lang_code);

        if (File::exists($path)) {
            File::deleteDirectory($path);
        }

        if ($language->delete()) {
            // Trigger the language creation event
            $languageData = [
                'lang_code' => $language->lang_code,
                'operation' => 'delete',
            ];

            Event::dispatch(new LanguageObserver($languageData));
        }


        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('admin.language')->with($notification);
    }

    public function adminLnagugae(Request $request)
    {
        $data = include(lang_path($request->lang_code . '/admin.php'));


        return view('admin.admin_language', compact('data'));
    }

    public function updateAdminLanguage(Request $request)
    {

        $dataArray = [];
        foreach ($request->values as $index => $value) {
            $dataArray[$index] = $value;
        }

        $langPath = lang_path($request->lang_code . '/admin.php');

        File::put($langPath, "");
        $dataArray = var_export($dataArray, true);
        File::put($langPath, "<?php\n return {$dataArray};\n ?>");

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function adminValidationLnagugae(Request $request)
    {
        $data = include(lang_path($request->lang_code . '/admin_validation.php'));

        return view('admin.admin_validation_language', compact('data'));
    }

    public function updateAdminValidationLnagugae(Request $request)
    {
        $dataArray = [];
        foreach ($request->values as $index => $value) {
            $dataArray[$index] = $value;
        }

        $langPath = lang_path($request->lang_code . '/admin_validation.php');
        file_put_contents($langPath, "");
        $dataArray = var_export($dataArray, true);
        file_put_contents($langPath, "<?php\n return {$dataArray};\n ?>");

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function websiteLanguage(Request $request)
    {
        $data = include(lang_path($request->lang_code . '/user.php'));


        return view('admin.language', compact('data'));
    }

    public function updateLanguage(Request $request)
    {
        $dataArray = [];
        foreach ($request->values as $index => $value) {
            $dataArray[$index] = $value;
        }
        $langPath = lang_path($request->lang_code . '/user.php');
        file_put_contents($langPath, "");
        $dataArray = var_export($dataArray, true);
        file_put_contents($langPath, "<?php\n return {$dataArray};\n ?>");

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    public function websiteValidationLanguage(Request $request)
    {
        $data = include(lang_path($request->lang_code . '/user_validation.php'));

        return view('admin.website_validation_language', compact('data'));
    }

    public function updateValidationLanguage(Request $request)
    {
        $dataArray = [];
        foreach ($request->values as $index => $value) {
            $dataArray[$index] = $value;
        }
        $langPath = lang_path($request->lang_code . '/user_validation.php');
        file_put_contents($langPath, "");
        $dataArray = var_export($dataArray, true);
        file_put_contents($langPath, "<?php\n return {$dataArray};\n ?>");

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
