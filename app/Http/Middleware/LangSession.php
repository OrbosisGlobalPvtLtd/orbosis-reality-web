<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;
use Config, Route;
use Illuminate\Http\Request;
use App\Models\MultiCurrency;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LangSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // check table exist or not
        if (!Schema::hasTable('languages')) {
            return $next($request);
        }

        $default_lang = Language::where('country_code', getDefaultLanguageByApi())
            ->pluck('lang_code')
            ->first();

        if (!Session::get('front_lang') && $default_lang) {
            // Store the retrieved lang_code in the session
            Session::put('front_lang', $default_lang);
        }


        if (!Session::get('currency_code') && !empty(getDefaultCurrencyByApi())) {
            fetchCurrency(getDefaultCurrencyByApi());
        }



        if (!Session::get('front_lang')) {
            $default_lang = Language::where('is_default', 'yes')->first();

            if (!$default_lang) {
                $default_lang = Language::where('id', 1)->first();
            }

            Session::put('front_lang', $default_lang->lang_code);
            Session::put('lang_dir', $default_lang->lang_direction);

            app()->setLocale($default_lang->lang_code);
        } else {
            $is_exist = Language::where('lang_code', Session::get('front_lang'))->first();
            if (!$is_exist) {
                Session::put('front_lang', 'en');
                Session::put('lang_dir', 'left_to_right');
            }

            app()->setLocale(Session::get('front_lang'));
        }


        // for currency
        if (!Session::get('currency_code')) {
            $default_currency = MultiCurrency::where('is_default', 'yes')->first();
            if ($default_currency) {

                if ($default_currency->currency_code !== 'USD') {

                    fetchCurrency($default_currency->currency_code);
                } else {
                    Session::put('currency_name', $default_currency->currency_name);
                    Session::put('currency_code', $default_currency->currency_code);
                    Session::put('currency_icon', $default_currency->currency_icon);
                    Session::put('currency_rate', $default_currency->currency_rate);
                    Session::put('currency_position', $default_currency->currency_position);
                }
            } else {
                $default_currency = MultiCurrency::where('id', 1)->first();
                Session::put('currency_name', $default_currency->currency_name);
                Session::put('currency_code', $default_currency->currency_code);
                Session::put('currency_icon', $default_currency->currency_icon);
                Session::put('currency_rate', $default_currency->currency_rate);
                Session::put('currency_position', $default_currency->currency_position);
            }
        } else {
            $session_currency = MultiCurrency::where('currency_code', Session::get('currency_code'))->first();
            if (!$session_currency) {
                $default_currency = MultiCurrency::where('id', 1)->first();

                Session::put('currency_name', $default_currency->currency_name);
                Session::put('currency_code', $default_currency->currency_code);
                Session::put('currency_icon', $default_currency->currency_icon);
                Session::put('currency_rate', $default_currency->currency_rate);
                Session::put('currency_position', $default_currency->currency_position);
            }
        }


        return $next($request);
    }
}
