<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SetDefaultLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {



        if(!Session::get('admin_lang')){
            $default_lang = Language::where('is_default', 'yes')->first();

            if(!$default_lang){
                $default_lang = Language::where('id', 1)->first();
            }

            Session::put('admin_lang', $default_lang->lang_code);
            Session::put('lang_dir', $default_lang->lang_direction);

            app()->setLocale($default_lang->lang_code);

        }else{

            $is_exist = Language::where('lang_code', Session::get('admin_lang'))->first();


            if(!$is_exist){
                Session::put('admin_lang', 'en');
                Session::put('lang_dir', 'left_to_right');
            }

            app()->setLocale(Session::get('admin_lang'));
        }



        return $next($request);
    }
}


