<?php

use App\Models\Setting;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\PaypalController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\AminityContoller;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\User\CompanyController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\User\MyBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ErrorPageController;
use App\Http\Controllers\Admin\MobileAppController;
use App\Http\Controllers\Admin\BreadcrumbController;
use App\Http\Controllers\Admin\CustomPageController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\PopularBlogController;
use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Builder\BuilderController;

// frontend start

use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\AdminProfileController;

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\MobileSliderController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;

use App\Http\Controllers\Admin\NearestLocationController;
use App\Http\Controllers\Admin\FooterSocialLinkController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\EmailConfigurationController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\API\User\PaypalController as APIPaypalController;
use App\Http\Controllers\User\PropertyController as UserPropertyController;
use App\Http\Controllers\API\User\PaymentController as APIPaymentController;


Route::post('/builder/logout', function () {
    Auth::guard('builder')->logout(); // if using builder guard
    return redirect()->route('builder.login');
})->name('builder.logout');
Route::get('/builder/register', [HomeController::class, 'showRegisterForm'])->name('builder.register');
Route::post('/builder/register', [HomeController::class, 'register']);

Route::get('/builder/login', [HomeController::class, 'showLoginForm'])->name('builder.login');
Route::post('/builder/login', [HomeController::class, 'login']);

Route::get('/builder/register', [HomeController::class, 'showRegisterForm'])->name('builder.register');
Route::post('/builder/register', [HomeController::class, 'register']);

Route::get('/builder/login', [HomeController::class, 'showLoginForm'])->name('builder.login');
Route::post('/builder/login', [HomeController::class, 'login']);

/* AJAX Routes */
Route::get('/get-states/{country_id}', [HomeController::class, 'getStates']);
Route::get('/get-cities/{state_id}', [HomeController::class, 'getCities']);

Route::middleware(['auth'])->prefix('builder')->name('builder.')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/company-profile', [HomeController::class, 'companyProfile'])->name('company-profile');
    Route::get('/my-team', [HomeController::class, 'myTeam'])->name('my-team');
    Route::get('/my-properties', [HomeController::class, 'myProperties'])->name('my-properties');
    Route::get('/properties', [BuilderController::class, 'index'])
        ->name('properties');

    Route::get('/property/create', [HomeController::class, 'create'])
        ->name('create');

    Route::post('/property/store', [HomeController::class, 'store'])
        ->name('store');

    Route::get('/property/edit/{id}', [HomeController::class, 'edit'])
        ->name('edit');

    Route::post('/property/update/{id}', [HomeController::class, 'update'])
        ->name('update');

    Route::delete('/property/delete/{id}', [HomeController::class, 'delete'])
        ->name('delete');

    Route::post(
        '/builder/property/approve/{id}',
        [HomeController::class, 'updateApprovalStatus']
    )->name('status');

    Route::get('/purchase-history', [HomeController::class, 'purchaseHistory'])->name('purchase-history');
    Route::get('/booking-request', [HomeController::class, 'bookingRequest'])
        ->name('builder.my-booking');
    Route::post('/booking-status/{id}', [HomeController::class, 'updateBookingStatus'])
        ->name('booking.status');

    Route::delete(
        '/builder/property/delete/{id}',
        [HomeController::class, 'delete']
    )->name('builder.delete');

    Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist');
    Route::get('/compare', [HomeController::class, 'compare'])->name('compare');
    Route::get('/my-reviews', [HomeController::class, 'myReviews'])->name('my-reviews');
    Route::get('/my-booking', [HomeController::class, 'myBooking'])->name('my-booking');
    Route::get('/kyc-verification', [HomeController::class, 'kycVerification'])->name('kyc-verification');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
});

Route::middleware(['auth:web'])->prefix('builder')->group(function () {

    Route::get('/dashboard', [BuilderController::class, 'dashboard'])->name('builder.dashboard');
    Route::get('/profile', [BuilderController::class, 'profile'])->name('builder.profile');
    Route::post('/profile/update', [BuilderController::class, 'updateProfile'])->name('builder.profile.update');
    Route::get('/change-password', [BuilderController::class, 'changePassword'])->name('builder.change.password');
    Route::post('/update-password', [BuilderController::class, 'updatePassword'])->name('builder.update.password');
    Route::post('/logout', [BuilderController::class, 'logout'])->name('builder.logout');
});
Route::group(['middleware' => ['demo', 'XSS']], function () {

    Route::group(['middleware' => ['maintainance']], function () {

        Route::group(['middleware' => ['HtmlSpecialchars']], function () {

            Route::get('/language-switcher', [HomeController::class, 'language_switcher'])->name('language-switcher');
            Route::get('/admin-language-switcher', [HomeController::class, 'admin_language_switcher'])->name('admin-language-switcher');
            Route::get('/currency-switcher', [HomeController::class, 'currency_switcher'])->name('currency-switcher');



            Route::get('/download-file/{file}', [HomeController::class, 'downloadListingFile'])->name('download-file');

            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
            Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('contact-us');
            Route::post('/send-contact-message', [HomeController::class, 'send_contact_message'])->name('send-contact-message');
            Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
            Route::get('/blog/{slug}', [HomeController::class, 'single_blog'])->name('blog');
            Route::post('/blog-comment', [HomeController::class, 'blog_comment'])->name('blog-comment');
            Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
            Route::get('/terms-and-conditions', [HomeController::class, 'terms_and_condition'])->name('terms-and-conditions');
            Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');
            Route::get('/page/{slug}', [HomeController::class, 'custom_page'])->name('page');
            // Booking Route...
            Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

            Route::get('/pricing-plan', [HomeController::class, 'pricing_plan'])->name('pricing-plan');

            Route::get('/properties', [HomeController::class, 'properties'])->name('properties');
            Route::get('/properties-with-ajax', [HomeController::class, 'properties_with_ajax'])->name('properties-with-ajax');
            Route::get('/property/{slug}', [HomeController::class, 'property'])->name('property');

            Route::get('property/city/list/{id}', [HomeController::class, 'property_city_list'])->name('property-city-list');
            Route::get('property/city/list/filtering/{id}', [HomeController::class, 'property_city_list_filtering'])->name('property-city-list-filtering');

            Route::get('/agents', [HomeController::class, 'agents'])->name('agents');
            Route::get('/agent', [HomeController::class, 'agent'])->name('agent');

            Route::get('/agencies', [HomeController::class, 'agencies'])->name('agencies');
            Route::get('/agency-details/{id}', [HomeController::class, 'agency_details'])->name('agency-details');

            Route::post('/send-mail-to-agent', [HomeController::class, 'send_mail_to_agent'])->name('send-mail-to-agent');

            Route::post('/store-property-review', [HomeController::class, 'store_property_review'])->name('store-property-review');

            Route::post('/subscribe-request', [HomeController::class, 'subscribe_request'])->name('subscribe-request');
            Route::get('/subscriber-verification/{token}', [HomeController::class, 'subscriber_verifcation'])->name('subscriber-verification');

            Route::get('/free-enroll/{slug}', [PaymentController::class, 'free_enroll'])->name('free-enroll');
            Route::get('/payment/{slug}', [PaymentController::class, 'payment'])->name('payment');
            Route::post('/pay-with-stripe/{slug}', [PaymentController::class, 'payWithStripe'])->name('pay-with-stripe');

            Route::get('/pay-with-paypal/{slug}', [PaypalController::class, 'payWithPaypal'])->name('pay-with-paypal');
            Route::get('/paypal-payment-success', [PaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success');
            Route::get('/paypal-payment-cancled', [PaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled');

            Route::get('/paypal-webview/{slug}', [APIPaypalController::class, 'paypal_webview'])->name('paypal-webview');
            Route::get('/paypal-webview-success', [APIPaypalController::class, 'paypal_webview_success'])->name('paypal-webview-success');

            Route::post('/bank-payment/{slug}', [PaymentController::class, 'bankPayment'])->name('bank-payment');

            Route::post('/pay-with-razorpay/{slug}', [PaymentController::class, 'payWithRazorpay'])->name('pay-with-razorpay');

            Route::get('/razorpay-webview/{slug}', [APIPaymentController::class, 'razorpay_webview'])->name('razorpay-webview');

            Route::get('/razorpay-webview-payment/{slug}', [APIPaymentController::class, 'razorpay_webview_payment'])->name('razorpay-webview-payment');

            Route::get('/webview-success-payment', [APIPaymentController::class, 'webview_success_payment'])->name('webview-success-payment');

            Route::get('/webview-faild-payment', [APIPaymentController::class, 'webview_faild_payment'])->name('webview-faild-payment');

            Route::get('/flutterwave-webview/{slug}', [APIPaymentController::class, 'flutterwave_webview'])->name('flutterwave-webview');
            Route::post('/flutterwave-webview-payment/{slug}', [APIPaymentController::class, 'flutterwave_webview_payment'])->name('flutterwave-webview-payment');

            Route::get('/mollie-webview/{slug}', [APIPaymentController::class, 'mollie_webview'])->name('mollie-webview');
            Route::get('/mollie-webview-payment', [APIPaymentController::class, 'mollie_webview_payment'])->name('mollie-webview-payment');

            Route::get('/paystack-webview/{slug}', [APIPaymentController::class, 'paystack_webview'])->name('paystack-webview');
            Route::get('/paystack-webview-payment/{slug}', [APIPaymentController::class, 'paystack_webview_payment'])->name('paystack-webview-payment');

            Route::get('/instamojo-webview/{slug}', [APIPaymentController::class, 'instamojo_webview'])->name('instamojo-webview');
            Route::get('/instamojo-webview-payment', [APIPaymentController::class, 'instamojo_webview_payment'])->name('instamojo-webview-payment');


            Route::post('/pay-with-flutterwave/{slug}', [PaymentController::class, 'payWithFlutterwave'])->name('pay-with-flutterwave');
            Route::get('/pay-with-mollie/{slug}', [PaymentController::class, 'payWithMollie'])->name('pay-with-mollie');
            Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
            Route::get('/pay-with-paystack/{slug}', [PaymentController::class, 'payWithPayStack'])->name('pay-with-paystack');
            Route::get('/pay-with-instamojo/{slug}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
            Route::get('/response-instamojo', [PaymentController::class, 'instamojoResponse'])->name('response-instamojo');

            Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
            Route::post('/store-login', [LoginController::class, 'storeLogin'])->name('store-login');
            Route::get('/register', [RegisterController::class, 'loginPage'])->name('register');
            Route::post('/store-register', [RegisterController::class, 'storeRegister'])->name('store-register');
            Route::get('/user-verification/{token}', [RegisterController::class, 'userVerification'])->name('user-verification');
            Route::get('/forget-password', [LoginController::class, 'forgetPage'])->name('forget-password');
            Route::post('/send-forget-password', [LoginController::class, 'sendForgetPassword'])->name('send-forget-password');
            Route::get('/reset-password/{token}', [LoginController::class, 'resetPasswordPage'])->name('reset-password');
            Route::post('/store-reset-password/{token}', [LoginController::class, 'storeResetPasswordPage'])->name('store-reset-password');

            Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login-google');
            Route::get('/callback/google', [LoginController::class, 'googleCallBack'])->name('callback-google');

            Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
                Route::get('dashboard', [UserProfileController::class, 'dashboard'])->name('dashboard');

                Route::get('my-profile', [UserProfileController::class, 'my_profile'])->name('my-profile');

                Route::post('update-profile', [UserProfileController::class, 'update_profile'])->name('update-profile');

                Route::get('change-password', [UserProfileController::class, 'change_password'])->name('change-password');

                Route::post('update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');

                Route::get('add-to-compare/{id}', [UserProfileController::class, 'add_to_compare'])->name('add-to-compare');
                Route::get('compare', [UserProfileController::class, 'compare'])->name('compare');
                Route::delete('remove-compare/{id}', [UserProfileController::class, 'remove_compare'])->name('remove-compare');

                Route::get('add-to-wishlist/{id}', [UserProfileController::class, 'add_to_wishlist'])->name('add-to-wishlist');
                Route::delete('remove-wishlist/{id}', [UserProfileController::class, 'remove_wishlist'])->name('remove-wishlist');

                Route::get('wishlist', [UserProfileController::class, 'wishlist'])->name('wishlist');
                Route::get('my-reviews', [UserProfileController::class, 'my_reviews'])->name('my-reviews');

                Route::get('orders', [UserProfileController::class, 'orders'])->name('orders');

                Route::get('logout', [LoginController::class, 'userLogout'])->name('logout');

                Route::resource('property', UserPropertyController::class);
                Route::get('choose-property-type', [UserPropertyController::class, 'choose_property_type'])->name('choose-property-type');

                Route::get('my-company', [CompanyController::class, 'index'])->name('my-company');
                Route::get('my-team', [CompanyController::class, 'my_team'])->name('my-team');
                Route::get('create-company', [CompanyController::class, 'create_company'])->name('create-company');
                Route::get('create-agent', [CompanyController::class, 'create_agent'])->name('create-agent');
                Route::post('apply-company', [CompanyController::class, 'apply_company'])->name('apply-company');
                Route::post('update-agency-information/{id}', [CompanyController::class, 'update_agency_information'])->name('update-agency-information');
                Route::get('edit-agency-information/{id}', [CompanyController::class, 'edit_agency_information'])->name('edit-agency-information');
                Route::post('store-agent', [CompanyController::class, 'store_agent'])->name('store-agent');

                Route::DELETE('agency-agent-delete/{id}', [CompanyController::class, 'destroy'])->name('agency-agent-destroy');
                Route::get('agency-agent-edit/{id}', [CompanyController::class, 'agency_agent_edit'])->name('agency-agent-edit');
                Route::post('agency-agent-update/{id}', [CompanyController::class, 'agency_agent_update'])->name('agency-agent-update');

                Route::put('remove-property-slider/{id}', [UserPropertyController::class, 'remove_property_slider'])->name('remove-property-slider');
                Route::put('remove-nearest-location/{id}', [UserPropertyController::class, 'remove_nearest_location'])->name('remove-nearest-location');
                Route::put('remove-add-infor/{id}', [UserPropertyController::class, 'remove_add_info'])->name('remove-add-infor');
                Route::put('remove-plan/{id}', [UserPropertyController::class, 'remove_plan'])->name('remove-plan');

                Route::get('property/city/list/{id}', [UserPropertyController::class, 'property_city_list'])->name('property-city-list');

                // Property Booking....
                Route::get('property-booking/', [MyBookingController::class, 'index'])->name('property-booking');
                Route::post('property-booking/edit/{id}', [MyBookingController::class, 'view'])->name('property-booking.edit');
                Route::DELETE('property-booking/remove/{id}', [MyBookingController::class, 'remove'])->name('property-booking.remove');

                Route::get('my-booking/', [MyBookingController::class, 'myBooking'])->name('my-booking');
                Route::DELETE('my-booking/remove/{id}', [MyBookingController::class, 'myBookingRemove'])->name('my-booking.remove');
            });
        });
    });



    // start admin routes
    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['adminLangSession']], function () {

        // start auth route
        Route::get('login', [AdminLoginController::class, 'adminLoginPage'])->name('login');
        Route::post('login', [AdminLoginController::class, 'storeLogin'])->name('store-login');
        Route::post('logout', [AdminLoginController::class, 'adminLogout'])->name('logout');
        Route::get('forget-password', [AdminForgotPasswordController::class, 'forgetPassword'])->name('forget-password');
        Route::post('send-forget-password', [AdminForgotPasswordController::class, 'sendForgetEmail'])->name('send.forget.password');
        Route::get('reset-password/{token}', [AdminForgotPasswordController::class, 'resetPassword'])->name('reset.password');
        Route::post('password-store/{token}', [AdminForgotPasswordController::class, 'storeResetData'])->name('store.reset.password');
        // end auth route

        Route::resource('admin', AdminController::class);
        Route::put('admin-status/{id}', [AdminController::class, 'changeStatus'])->name('admin-status');

        Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::put('profile-update', [AdminProfileController::class, 'update'])->name('profile.update');

        Route::get('agent-profile', [AdminProfileController::class, 'agent_profile'])->name('agent-profile');
        Route::put('agent-profile-update', [AdminProfileController::class, 'agent_profile_update'])->name('agent-profile-update');

        Route::get('subscriber', [SubscriberController::class, 'index'])->name('subscriber');
        Route::delete('delete-subscriber/{id}', [SubscriberController::class, 'destroy'])->name('delete-subscriber');
        Route::post('specification-subscriber-email/{id}', [SubscriberController::class, 'specificationSubscriberEmail'])->name('specification-subscriber-email');
        Route::post('each-subscriber-email', [SubscriberController::class, 'eachSubscriberEmail'])->name('each-subscriber-email');

        Route::get('contact-message', [ContactMessageController::class, 'index'])->name('contact-message');
        Route::delete('delete-contact-message/{id}', [ContactMessageController::class, 'destroy'])->name('delete-contact-message');
        Route::put('enable-save-contact-message', [ContactMessageController::class, 'handleSaveContactMessage'])->name('enable-save-contact-message');

        Route::get('general-setting', [SettingController::class, 'index'])->name('general-setting');
        Route::put('update-general-setting', [SettingController::class, 'updateGeneralSetting'])->name('update-general-setting');

        Route::put('update-database', [SettingController::class, 'update_database'])->name('update-database');

        Route::put('update-map', [SettingController::class, 'update_map'])->name('update-map');


        Route::put('update-theme-color', [SettingController::class, 'updateThemeColor'])->name('update-theme-color');

        Route::put('update-logo-favicon', [SettingController::class, 'updateLogoFavicon'])->name('update-logo-favicon');
        Route::put('update-cookie-consent', [SettingController::class, 'updateCookieConset'])->name('update-cookie-consent');
        Route::put('update-google-recaptcha', [SettingController::class, 'updateGoogleRecaptcha'])->name('update-google-recaptcha');
        Route::put('update-tawk-chat', [SettingController::class, 'updateTawkChat'])->name('update-tawk-chat');
        Route::put('update-google-analytic', [SettingController::class, 'updateGoogleAnalytic'])->name('update-google-analytic');
        Route::put('update-custom-pagination', [SettingController::class, 'updateCustomPagination'])->name('update-custom-pagination');
        Route::put('update-social-login', [SettingController::class, 'updateSocialLogin'])->name('update-social-login');
        Route::put('update-facebook-pixel', [SettingController::class, 'updateFacebookPixel'])->name('update-facebook-pixel');
        Route::put('update-pusher', [SettingController::class, 'updatePusher'])->name('update-pusher');

        Route::get('admin-language', [LanguageController::class, 'adminLnagugae'])->name('admin-language');
        Route::post('update-admin-language', [LanguageController::class, 'updateAdminLanguage'])->name('update-admin-language');

        Route::get('admin-validation-language', [LanguageController::class, 'adminValidationLnagugae'])->name('admin-validation-language');
        Route::post('update-admin-validation-language', [LanguageController::class, 'updateAdminValidationLnagugae'])->name('update-admin-validation-language');

        Route::get('website-language', [LanguageController::class, 'websiteLanguage'])->name('website-language');
        Route::post('update-language', [LanguageController::class, 'updateLanguage'])->name('update-language');

        Route::get('website-validation-language', [LanguageController::class, 'websiteValidationLanguage'])->name('website-validation-language');
        Route::post('update-validation-language', [LanguageController::class, 'updateValidationLanguage'])->name('update-validation-language');


        // ----- languages Settings -------
        Route::get('language', [LanguageController::class, 'index'])->name('language');
        Route::get('language-edit/{id}', [LanguageController::class, 'edit'])->name('language.edit');
        Route::put('language-update/{id}', [LanguageController::class, 'update'])->name('language.update');

        Route::get('language-create', [LanguageController::class, 'create'])->name('language.create');
        Route::post('language-store', [LanguageController::class, 'store'])->name('language.store');
        Route::delete('language-delete/{id}', [LanguageController::class, 'destroy'])->name('language-delete');

        Route::get('admin-language', [LanguageController::class, 'adminLnagugae'])->name('admin-language');
        Route::post('update-admin-language', [LanguageController::class, 'updateAdminLanguage'])->name('update-admin-language');

        Route::get('admin-validation-language', [LanguageController::class, 'adminValidationLnagugae'])->name('admin-validation-language');
        Route::post('update-admin-validation-language', [LanguageController::class, 'updateAdminValidationLnagugae'])->name('update-admin-validation-language');

        Route::get('website-language', [LanguageController::class, 'websiteLanguage'])->name('website-language');
        Route::post('update-language', [LanguageController::class, 'updateLanguage'])->name('update-language');

        Route::get('website-validation-language', [LanguageController::class, 'websiteValidationLanguage'])->name('website-validation-language');
        Route::post('update-validation-language', [LanguageController::class, 'updateValidationLanguage'])->name('update-validation-language');



        Route::get('email-configuration', [EmailConfigurationController::class, 'index'])->name('email-configuration');
        Route::put('update-email-configuraion', [EmailConfigurationController::class, 'update'])->name('update-email-configuraion');

        Route::get('email-template', [EmailTemplateController::class, 'index'])->name('email-template');
        Route::get('edit-email-template/{id}', [EmailTemplateController::class, 'edit'])->name('edit-email-template');
        Route::put('update-email-template/{id}', [EmailTemplateController::class, 'update'])->name('update-email-template');

        Route::resource('blog-category', BlogCategoryController::class);
        Route::put('blog-category-status/{id}', [BlogCategoryController::class, 'changeStatus'])->name('blog.category.status');

        Route::resource('blog', BlogController::class);
        Route::put('blog-status/{id}', [BlogController::class, 'changeStatus'])->name('blog.status');

        Route::resource('popular-blog', PopularBlogController::class);
        Route::put('popular-blog-status/{id}', [PopularBlogController::class, 'changeStatus'])->name('popular-blog.status');

        Route::resource('blog-comment', BlogCommentController::class);
        Route::put('blog-comment-status/{id}', [BlogCommentController::class, 'changeStatus'])->name('blog-comment.status');

        Route::resource('about-us', AboutUsController::class);
        Route::put('update-about-us', [AboutUsController::class, 'update_aboutus'])->name('update-about-us');
        Route::get('home2-about-us', [AboutUsController::class, 'home2'])->name('home2-about-us');
        Route::put('update-home2-about-us', [AboutUsController::class, 'update_home2_aboutus'])->name('update-home2-about-us');

        Route::put('update-why-choose-use', [AboutUsController::class, 'updateWhyChooseUs'])->name('update-why-choose-use');

        Route::resource('contact-us', ContactPageController::class);

        Route::resource('custom-page', CustomPageController::class);
        Route::put('custom-page-status/{id}', [CustomPageController::class, 'changeStatus'])->name('custom-page.status');

        Route::resource('terms-and-condition', TermsAndConditionController::class);
        Route::resource('privacy-policy', PrivacyPolicyController::class);

        Route::resource('faq', FaqController::class);
        Route::put('faq-status/{id}', [FaqController::class, 'changeStatus'])->name('faq-status');
        Route::put('faq-content', [FaqController::class, 'update_faq_content'])->name('faq-content');

        Route::resource('error-page', ErrorPageController::class);

        Route::resource('footer', FooterController::class);
        Route::resource('social-link', FooterSocialLinkController::class);

        Route::resource('slider', SliderController::class);
        Route::put('slider-status/{id}', [SliderController::class, 'changeStatus'])->name('slider-status');
        Route::put('home2-update', [SliderController::class, 'home2_update'])->name('home2-update');
        Route::put('home3-update', [SliderController::class, 'home3_update'])->name('home3-update');

        Route::resource('mobile-slider', MobileSliderController::class);

        Route::resource('counter', CounterController::class);
        Route::put('counter-status/{id}', [CounterController::class, 'changeStatus'])->name('counter.status');
        Route::put('update-counter-bg', [CounterController::class, 'updateCounterBg'])->name('update-counter-bg');

        Route::resource('testimonial', TestimonialController::class);
        Route::put('testimonial-status/{id}', [TestimonialController::class, 'changeStatus'])->name('testimonial.status');

        Route::resource('why-choose-us', WhyChooseUsController::class);

        Route::resource('nearest-location', NearestLocationController::class);
        Route::put('nearest-location-status/{id}', [NearestLocationController::class, 'changeStatus'])->name('nearest-location-status');

        Route::resource('aminity', AminityContoller::class);
        Route::resource('pricing-plan', PricingPlanController::class);

        Route::get('assign-pricing-plan', [OrderController::class, 'assign_pricing_plan'])->name('assign-pricing-plan');
        Route::post('store-assign-pricing-plan', [OrderController::class, 'store_assign_pricing_plan'])->name('store-assign-pricing-plan');

        Route::get('purchase-history', [OrderController::class, 'index'])->name('purchase-history');
        Route::get('pending-payment', [OrderController::class, 'pending_payment'])->name('pending-payment');
        Route::get('show-purchase-history/{id}', [OrderController::class, 'show'])->name('show-purchase-history');
        Route::put('payment-approved/{id}', [OrderController::class, 'payment_approved'])->name('payment-approved');
        Route::delete('delete-order/{id}', [OrderController::class, 'destroy'])->name('delete-order');

        Route::resource('property', PropertyController::class);
        Route::put('remove-property-slider/{id}', [PropertyController::class, 'remove_property_slider'])->name('remove-property-slider');
        Route::put('remove-nearest-location/{id}', [PropertyController::class, 'remove_nearest_location'])->name('remove-nearest-location');
        Route::put('remove-add-infor/{id}', [PropertyController::class, 'remove_add_info'])->name('remove-add-infor');
        Route::put('remove-plan/{id}', [PropertyController::class, 'remove_plan'])->name('remove-plan');
        Route::get('check-slug/{slug}', [PropertyController::class, 'check_slug'])->name('check-slug');
        Route::get('agent-plan-availability/{owner_id}', [PropertyController::class, 'agent_plan_availability'])->name('agent-plan-availability');
        Route::get('agent-property', [PropertyController::class, 'agent_property'])->name('agent-property');
        Route::get('agent-pending-property', [PropertyController::class, 'agent_pending_property'])->name('agent-pending-property');
        Route::get('agent-reject-property', [PropertyController::class, 'agent_reject_property'])->name('agent-reject-property');

        Route::get('property-booking', [PropertyController::class, 'Booking'])->name('property.booking');
        Route::put('property-booking-edit/{id}', [PropertyController::class, 'changeStatus'])->name('property-booking-edit');
        Route::get('property-booking-show/{id}', [PropertyController::class, 'showBooking'])->name('property-booking-show');
        Route::DELETE('property-booking/delete/{id}', [PropertyController::class, 'remove'])->name('property.remove');

        Route::get('assign-slider-property', [PropertyController::class, 'assign_slider_property'])->name('assign-slider-property');
        Route::post('store-slider-property', [PropertyController::class, 'store_assign_slider_property'])->name('store-slider-property');
        Route::delete('remove-slider-property/{id}', [PropertyController::class, 'remove_intro_slider'])->name('remove-slider-property');

        Route::get('review-list', [PropertyController::class, 'review_list'])->name('review-list');
        Route::get('show-review/{id}', [PropertyController::class, 'show_review'])->name('show-review');
        Route::delete('delete-property-review/{id}', [PropertyController::class, 'delete_review'])->name('delete-property-review');
        Route::put('update-review/{id}', [PropertyController::class, 'update_review'])->name('update-review');

        Route::get('property/city/list/{id}', [PropertyController::class, 'property_city_list'])->name('property-city-list');


        Route::get('create-property', [ContentController::class, 'create_property'])->name('create-property');
        Route::put('update-create-property', [ContentController::class, 'update_create_property'])->name('update-create-property');

        Route::get('homepage', [ContentController::class, 'homepage'])->name('homepage');
        Route::put('update-homepage', [ContentController::class, 'update_homepage'])->name('update-homepage');

        Route::get('mobile-app', [ContentController::class, 'mobileApp'])->name('mobile-app');
        Route::put('update-mobile-app', [ContentController::class, 'updateMobileApp'])->name('update-mobile-app');

        Route::get('customer-list', [CustomerController::class, 'index'])->name('customer-list');
        Route::get('customer-show/{id}', [CustomerController::class, 'show'])->name('customer-show');
        Route::put('customer-status/{id}', [CustomerController::class, 'change_status'])->name('customer-status');
        Route::delete('customer-delete/{id}', [CustomerController::class, 'destroy'])->name('customer-delete');
        Route::get('pending-customer-list', [CustomerController::class, 'pending_customer_list'])->name('pending-customer-list');
        Route::get('send-email-to-all-customer', [CustomerController::class, 'send_emailto_all_user'])->name('send-email-to-all-customer');
        Route::post('send-mail-to-all-user', [CustomerController::class, 'send_mailto_all_user'])->name('send-mail-to-all-user');
        Route::post('send-mail-to-single-user/{id}', [CustomerController::class, 'send_mailto_single_user'])->name('send-mail-to-single-user');

        Route::get('create-customer', [CustomerController::class, 'create'])->name('create-customer');
        Route::post('store-user', [CustomerController::class, 'store'])->name('store-user');

        Route::get('payment-method', [PaymentMethodController::class, 'index'])->name('payment-method');
        Route::put('update-paypal', [PaymentMethodController::class, 'updatePaypal'])->name('update-paypal');
        Route::put('update-stripe', [PaymentMethodController::class, 'updateStripe'])->name('update-stripe');
        Route::put('update-razorpay', [PaymentMethodController::class, 'updateRazorpay'])->name('update-razorpay');
        Route::put('update-bank', [PaymentMethodController::class, 'updateBank'])->name('update-bank');
        Route::put('update-mollie', [PaymentMethodController::class, 'updateMollie'])->name('update-mollie');
        Route::put('update-paystack', [PaymentMethodController::class, 'updatePayStack'])->name('update-paystack');
        Route::put('update-flutterwave', [PaymentMethodController::class, 'updateflutterwave'])->name('update-flutterwave');
        Route::put('update-instamojo', [PaymentMethodController::class, 'updateInstamojo'])->name('update-instamojo');
        Route::put('update-paymongo', [PaymentMethodController::class, 'updatePaymongo'])->name('update-paymongo');
        Route::put('update-cash-on-delivery', [PaymentMethodController::class, 'updateCashOnDelivery'])->name('update-cash-on-delivery');

        Route::resource('partner', PartnerController::class);
        Route::put('partner-status/{id}', [PartnerController::class, 'changeStatus'])->name('partner-status');

        Route::resource('category', CategoryController::class);
        Route::put('category-status/{id}', [CategoryController::class, 'changeStatus'])->name('category.status');

        Route::resource('country', CountryController::class);
        Route::get('country-import-page', [CountryController::class, 'country_import'])->name('country-import-page');
        Route::get('country-export', [CountryController::class, 'country_export'])->name('country-export');
        Route::post('store-import-country', [CountryController::class, 'store_import_country'])->name('store-import-country');

        Route::resource('city', CityController::class);
        Route::put('city-status/{id}', [CityController::class, 'changeStatus'])->name('city-status');

        Route::get('city-import-page', [CityController::class, 'city_import'])->name('city-import-page');
        Route::get('city-export', [CityController::class, 'city_export'])->name('city-export');
        Route::get('city-demo-export', [CityController::class, 'demo_city_export'])->name('city-demo-export');
        Route::post('store-import-city', [CityController::class, 'store_import_city'])->name('store-import-city');

        Route::get('assign-homepage-city', [CityController::class, 'assign_homepage_city'])->name('assign-homepage-city');
        Route::post('store-assign-homepage-city', [CityController::class, 'store_assign_homepage_city'])->name('store-assign-homepage-city');
        Route::post('update-assign-homepage-city/{id}', [CityController::class, 'update_assign_homepage_city'])->name('update-assign-homepage-city');
        Route::delete('remove-homepage-city/{id}', [CityController::class, 'remove_from_home'])->name('remove-homepage-city');

        Route::get('agencies', [AgencyController::class, 'index'])->name('agency');
        Route::get('agency-show/{id}', [AgencyController::class, 'show'])->name('agency-show');
        Route::post('agency-approve/{id}', [AgencyController::class, 'agency_approve'])->name('agency-approve');
        Route::put('agency-update/{id}', [AgencyController::class, 'update_agency'])->name('agency-update');
        Route::delete('agency-delete/{id}', [AgencyController::class, 'destroy'])->name('agency-delete');

        Route::get('agent', [AgentController::class, 'index'])->name('agent');
        Route::get('create-agent', [AgentController::class, 'create'])->name('create-agent');
        Route::post('store-agent', [AgentController::class, 'store'])->name('store-agent');
        Route::get('agent-show/{id}', [AgentController::class, 'show'])->name('agent-show');
        Route::put('agent-update/{id}', [AgentController::class, 'update_agent'])->name('agent-update');
        Route::delete('agent-delete/{id}', [AgentController::class, 'destroy'])->name('agent-delete');
        Route::put('agent-status/{id}', [AgentController::class, 'change_status'])->name('agent-status');

        Route::get('send-email-to-all-agent', [AgentController::class, 'send_emailto_all_agent'])->name('send-email-to-all-agent');
        Route::post('send-mail-to-all-agent', [AgentController::class, 'send_mail_to_all_agent'])->name('send-mail-to-all-agent');
        Route::get('send-email-to-agent/{id}', [AgentController::class, 'send_email_to_agent'])->name('send-email-to-agent');
        Route::post('send-mail-to-single-agent/{id}', [AgentController::class, 'send_mailto_single_agent'])->name('send-mail-to-single-agent');

        Route::get('default-avatar', [ContentController::class, 'defaultAvatar'])->name('default-avatar');
        Route::put('update-default-avatar', [ContentController::class, 'updateDefaultAvatar'])->name('update-default-avatar');

        Route::get('default-placeholder', [ContentController::class, 'defaultPlaceholder'])->name('default-placeholder');
        Route::put('update-default-placeholder', [ContentController::class, 'updateDefaultPlaceholder'])->name('update-default-placeholder');

        Route::get('login-page', [ContentController::class, 'login_page'])->name('login-page');
        Route::put('update-login-page', [ContentController::class, 'update_login_page'])->name('update-login-page');

        Route::get('maintainance-mode', [ContentController::class, 'maintainanceMode'])->name('maintainance-mode');
        Route::put('maintainance-mode-update', [ContentController::class, 'maintainanceModeUpdate'])->name('maintainance-mode-update');

        Route::get('seo-setup', [ContentController::Class, 'seoSetup'])->name('seo-setup');
        Route::put('update-seo-setup/{id}', [ContentController::Class, 'updateSeoSetup'])->name('update-seo-setup');

        Route::resource('banner-image', BreadcrumbController::class);

        Route::get('/', [DashboardController::class, 'dashobard']);
        Route::get('dashboard', [DashboardController::class, 'dashobard'])->name('dashboard');

        Route::get('clear-database', [SettingController::class, 'showClearDatabasePage'])->name('clear-database');
        Route::delete('delete-clear-database', [SettingController::class, 'clearDatabase'])->name('delete-clear-database');
        Route::get('clear-cache', [SettingController::class, 'clear_cache'])->name('clear-cache');

        Route::get('mobile-app-setting', [MobileAppController::class, 'mobile_app'])->name('mobile-app-setting');
        Route::post('update-mobile-app-setting', [MobileAppController::class, 'update_mobile_app'])->name('update-mobile-app-setting');
    });
});
// end admin routes


Route::get('/migrate', function () {

    Artisan::call('migrate');

    $setting = Setting::first();
    $setting->current_version = '4.0.0';
    $setting->save();

    Artisan::call('optimize:clear');

    $notification = trans('Version updated successful');
    $notification = array('messege' => $notification, 'alert-type' => 'success');
    return redirect()->route('home')->with($notification);
})->name('migrate-for-version');
