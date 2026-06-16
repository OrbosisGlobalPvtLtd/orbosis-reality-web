<?php

namespace App\Providers;
use Laravel\Sanctum\Sanctum;
use App\Models\PersonalAccessTokenModal;
use App\Models\Footer;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Language;
use App\Models\TawkChat;
use App\Models\CustomPage;
use App\Models\FooterLink;
use App\Models\CookieConsent;
use App\Models\FacebookPixel;
use App\Models\MultiCurrency;
use App\Models\GoogleAnalytic;
use App\Models\BreadcrumbImage;
use App\Models\FooterSocialLink;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
public function boot()
{
    Sanctum::usePersonalAccessTokenModel(PersonalAccessTokenModal::class);




        View::composer('*', function($view){

            $setting = Setting::first();
            $social_links = FooterSocialLink::all();
            $footer = Footer::first();
            $googleAnalytic = GoogleAnalytic::first();
            $facebookPixel = FacebookPixel::first();
            $partners = Partner::where('status', 1)->get();
            $custom_pages = CustomPage::where('status',1)->get();
            $cookieConsent = CookieConsent::first();
            $tawk_setting = TawkChat::first();
            $breadcrumb = BreadcrumbImage::where('id',1)->first();
            $footer_categories = Category::where('status',1)->get()->take(5);
            $language_list = Language::where('status', 1)->get();
            $currency_list = MultiCurrency::where('status', 'active')->get();
            //dd($footer_categories);

            $view->with('currency_icon', $setting->currency_icon);
            $view->with('setting', $setting);
            $view->with('social_links', $social_links);
            $view->with('footer', $footer);
            $view->with('googleAnalytic', $googleAnalytic);
            $view->with('facebookPixel', $facebookPixel);
            $view->with('partners', $partners);
            $view->with('breadcrumb', $breadcrumb->image);
            $view->with('default_user_avatar', $setting->default_avatar);
            $view->with('custom_pages', $custom_pages);
            $view->with('cookie_consent', $cookieConsent);
            $view->with('tawk_setting', $tawk_setting);
            $view->with('footer_categories', $footer_categories);
            $view->with('language_list', $language_list);
            $view->with('currency_list', $currency_list);
        });
    }
}
