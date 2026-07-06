<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;
use App\Models\GoogleRecaptcha;
class Captcha implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $recaptchaSetting = GoogleRecaptcha::first();
        if ($recaptchaSetting->status == 0) {
            return true;
        }
        $recaptcha=new ReCaptcha($recaptchaSetting->secret_key);
        $remoteAddr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
        $response=$recaptcha->verify($value, $remoteAddr);
        return $response->isSuccess();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('Please complete the recaptcha to submit the form');
    }
}
