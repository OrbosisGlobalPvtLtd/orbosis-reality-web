<?php

use App\Models\MultiCurrency;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

function getAllResourceFiles($dir, &$results = array()) {
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = $dir ."/". $value;
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getAllResourceFiles($path, $results);
        }
    }
    return $results;
}

function getRegexBetween($content) {

    preg_match_all("%\{{__\(['|\"](.*?)['\"]\)}}%i", $content, $matches1, PREG_PATTERN_ORDER);
    preg_match_all("%\@lang\(['|\"](.*?)['\"]\)%i", $content, $matches2, PREG_PATTERN_ORDER);
    preg_match_all("%trans\(['|\"](.*?)['\"]\)%i", $content, $matches3, PREG_PATTERN_ORDER);
    $Alldata = [$matches1[1], $matches2[1], $matches3[1]];
    $data = [];
    foreach ($Alldata as  $value) {
        if(!empty($value)){
            foreach ($value as $val) {
                $data[$val] = $val;
            }
        }
    }
    return $data;
}

function generateLang($path = ''){

    // user panel
    $paths = getAllResourceFiles(resource_path('views/user'));
    $paths = array_merge($paths, getAllResourceFiles(resource_path('views/errors')));
    $paths = array_merge($paths, getAllResourceFiles(resource_path('views/test')));
    // end user panel

    // user validation
    $paths = getAllResourceFiles(app_path('Http/Controllers/User'));
    $paths = array_merge($paths, getAllResourceFiles(app_path('Http/Controllers/test')));
    $paths = array_merge($paths, getAllResourceFiles(app_path('Http/Controllers/Auth')));
    // end user validation

    // admin panel
    $paths = getAllResourceFiles(resource_path('views/admin'));
    // end admin panel

    // admin validation
    $paths = getAllResourceFiles(app_path('Http/Controllers/Admin'));
    // end validation
    $AllData= [];
    foreach ($paths as $key => $path) {
    $AllData[] = getRegexBetween(file_get_contents($path));
    }
    $modifiedData = [];
    foreach ($AllData as  $value) {
        if(!empty($value)){
            foreach ($value as $val) {
                $modifiedData[$val] = $val;
            }
        }
    }

    $modifiedData = var_export($modifiedData, true);
    file_put_contents('lang/en/admin_validation.php', "<?php\n return {$modifiedData};\n ?>");

}


function html_decode($text){
  $after_decode =  htmlspecialchars_decode($text, ENT_QUOTES);
  return $after_decode;
}


function num_format($price){

    if(empty($price ?? '')){
        $price = 0;
    }

    $currency_icon = Session::get('currency_icon');
    $currency_code = Session::get('currency_code');
    $currency_rate = Session::get('currency_rate');
    $currency_position = Session::get('currency_position');

    $price = $price * $currency_rate;
    $price = amount($price, 2, '.', ',');

    if($currency_position == 'before_price'){
        $price = $currency_icon.$price;
    }elseif($currency_position == 'before_price_with_space'){
        $price = $currency_icon.' '.$price;
    }elseif($currency_position == 'after_price'){
        $price = $price.$currency_icon;
    }elseif($currency_position == 'after_price_with_space'){
        $price = $price.' '.$currency_icon;
    }else{
        $price = $currency_icon.$price;
    }

    return $price;
}



function amount($amount) {

    if(empty($amount ?? '')){
        $amount = 0;
    }

    $amount = number_format(floatval($amount), 2, '.', ',');

    return $amount;
}


function gTranslate($string, $lang_code) {

    $tr = new Stichoza\GoogleTranslate\GoogleTranslate($lang_code);

    return $tr->translate($string);
}

function admin_lang() {
    if( !empty(request('lang_code') ?? '')){
        return request('lang_code') ?? '';
    }

    return session()->get('admin_lang') ?? config('app.locale');
}


function front_lang() {
    if (!empty(request('lang_code') ?? '')) {
        return request('lang_code') ?? '';
    }
    return session()->get('front_lang') ?? config('app.locale');
}


/* Transaltion Dynamicly Update */
if (!function_exists('updateOrCreateTransaltion')) {
    function updateOrCreateTransaltion($request = null, $modal = null) {
        // Ensure lang_code and modal are provided
        if (empty($request->lang_code) || empty($modal)) {
            return;
        }

        // Load table translations
        $tableTranslations = include(lang_path('tablesTranslation.php'));
        $tableFields = $tableTranslations[$modal->getTable()] ?? [];

        // Iterate through translatable fields and update/create translations
        foreach ($tableFields as $field) {
            if (!empty($request->$field ?? '')) {
                $modal->updateOrCreateTranslation($request->lang_code, $field, $request->$field);
            }
        }
    }
}


function fetchCurrency($currency_code) {

    $request_currency = MultiCurrency::where('currency_code', $currency_code)->first();
    if(!$request_currency){
        return;
    }

    try {
        $url = 'https://cdn.moneyconvert.net/api/latest.json';

        $response = Http::get($url);



        if ($response->successful()) {
            $data = $response->json();
            $rates = $data['rates'] ?? [];

            if(isset($rates[$currency_code])){
                $current_rate = $rates[$currency_code];

                $current_rate = sprintf("%.2f", $current_rate);

                if($request_currency){
                    $request_currency->currency_rate = $current_rate;
                    $request_currency->save();
                }


                Session::put('currency_icon', $request_currency->currency_icon);
                Session::put('currency_code', $request_currency->currency_code);
                Session::put('currency_rate', $request_currency->currency_rate);
                Session::put('currency_position', $request_currency->currency_position);

                return true;

            }else{
                return false;
            }

        }else{
            return false;
        }

    } catch (\Exception $e) {
        Log::info('Money api faild');
        Log::info($e->getMessage());

        return false;

    }
}
    function getDefaultLanguageByApi() {

        $cookieName = 'default_language';
        $cookieDuration = 60 * 24 * 30; // 1 month in minutes

        if (Cookie::has($cookieName)) {
            return Cookie::get($cookieName);
        }

        $response = Http::get('http://ip-api.com/json/?fields=countryCode');

        $jsonData = $response->json();
        $countryCode = $jsonData['countryCode'] ?? '';

        if ($countryCode) {
            Cookie::queue(Cookie::make($cookieName, $countryCode, $cookieDuration));
        }

        return $countryCode;
    }


    function getDefaultCurrencyByApi() {
        $cookieName = 'default_currency';
        $cookieDuration = 60 * 24 * 30; // 1 month in minutes

        if (Cookie::has($cookieName)) {
            return Cookie::get($cookieName);
        }

        $response = Http::get('http://ip-api.com/json?fields=currency');

        $jsonData = $response->json();
        $currency = $jsonData['currency'] ?? '';

        if ($currency) {
            Cookie::queue(Cookie::make($cookieName, $currency, $cookieDuration));
        }

        return $currency;
    }

