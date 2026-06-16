<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BuilderAuthController;



// frontend start

use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\User\PaypalController;
use App\Http\Controllers\API\User\CompanyController;

use App\Http\Controllers\API\User\PaymentController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\User\MyBookingController;
use App\Http\Controllers\API\User\UserProfileController;
use App\Http\Controllers\API\User\PropertyController as UserPropertyController;

Route::prefix('builder')->group(function () {

    Route::post('/register', [BuilderAuthController::class, 'register']);
    Route::post('/login', [BuilderAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [BuilderAuthController::class, 'profile']);
        Route::post('/logout', [BuilderAuthController::class, 'logout']);
    });

});

Route::group(['middleware' => ['demo','XSS', 'LangSessionForApi']], function () {

Route::group(['middleware' => ['maintainance']], function () {

    Route::group(['middleware' => ['HtmlSpecialchars']], function () {

    Route::get('/download-file/{file}', [HomeController::class, 'downloadListingFile'])->name('download-file');

    Route::get('/website-setup', [HomeController::class, 'website_setup'])->name('website-setup');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
    Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('contact-us');
    Route::post('/send-contact-message', [HomeController::class, 'send_contact_message'])->name('send-contact-message');
    Route::get('/category-list', [HomeController::class, 'category_list'])->name('category-list');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/terms-and-conditions', [HomeController::class, 'terms_and_condition'])->name('terms-and-conditions');
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');

    Route::get('/pricing-plan', [HomeController::class, 'pricing_plan'])->name('pricing-plan');

    Route::get('/properties', [HomeController::class, 'properties'])->name('properties');
    Route::get('/properties-with-ajax', [HomeController::class, 'properties_with_ajax'])->name('properties-with-ajax');
    Route::get('/property/{slug}', [HomeController::class, 'property'])->name('property');


    Route::get('city-by-country/{country_id}', [HomeController::class, 'city_by_country'])->name('city-by-country');

    Route::get('/agents', [HomeController::class, 'agents'])->name('agents');
    Route::get('/agent', [HomeController::class, 'agent'])->name('agent');
    Route::get('agency-list', [HomeController::class, 'agency_list'])->name('agency-list');
    Route::get('/agency-details/{id}', [HomeController::class, 'agency_details'])->name('agency-details');


    Route::post('/send-mail-to-agent', [HomeController::class, 'send_mail_to_agent'])->name('send-mail-to-agent');

    Route::post('/store-property-review', [HomeController::class, 'store_property_review'])->name('store-property-review');

    Route::post('/subscribe-request', [HomeController::class, 'subscribe_request'])->name('subscribe-request');
    Route::get('/subscriber-verification/{token}', [HomeController::class, 'subscriber_verifcation'])->name('subscriber-verification');

    Route::get('/kyc-list', [HomeController::class, 'kyc_list'])->name('kyc-list');

    Route::get('/free-enroll/{slug}', [PaymentController::class, 'free_enroll'])->name('free-enroll');
    Route::get('/payment/{slug}', [PaymentController::class, 'payment'])->name('payment');
    Route::post('/pay-with-stripe/{slug}', [PaymentController::class, 'payWithStripe'])->name('pay-with-stripe');

    Route::get('/pay-with-paypal/{slug}', [PaypalController::class, 'payWithPaypal'])->name('pay-with-paypal');
    Route::get('/paypal-payment-success', [PaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success');
    Route::get('/paypal-payment-cancled', [PaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled');

    Route::post('/bank-payment/{slug}', [PaymentController::class, 'bankPayment'])->name('bank-payment');
    Route::post('/pay-with-razorpay/{slug}', [PaymentController::class, 'payWithRazorpay'])->name('pay-with-razorpay');
    Route::post('/pay-with-flutterwave/{slug}', [PaymentController::class, 'payWithFlutterwave'])->name('pay-with-flutterwave');
    Route::get('/pay-with-mollie/{slug}', [PaymentController::class, 'payWithMollie'])->name('pay-with-mollie');
    Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
    Route::get('/pay-with-paystack/{slug}', [PaymentController::class, 'payWithPayStack'])->name('pay-with-paystack');
    Route::get('/pay-with-instamojo/{slug}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
    Route::get('/response-instamojo', [PaymentController::class, 'instamojoResponse'])->name('response-instamojo');

    Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
    Route::post('/store-login', [LoginController::class, 'storeLogin'])->name('store-login');
    Route::get('/register', [RegisterController::class, 'reg_page'])->name('register');
    Route::post('/resend-register', [RegisterController::class, 'resend_register_code'])->name('resend-register');

    Route::post('/store-register', [RegisterController::class, 'storeRegister'])->name('store-register');
    Route::post('/user-verification', [RegisterController::class, 'userVerification'])->name('user-verification');

    Route::get('/forget-password', [LoginController::class, 'forgetPage'])->name('forget-password');
    Route::post('/send-forget-password', [LoginController::class, 'sendForgetPassword'])->name('send-forget-password');
    Route::get('/reset-password/{token}', [LoginController::class, 'resetPasswordPage'])->name('reset-password');
    Route::post('/store-reset-password', [LoginController::class, 'storeResetPasswordPage'])->name('store-reset-password');

    Route::get('login/google',[LoginController::class, 'redirectToGoogle'])->name('login-google');
    Route::get('/callback/google',[LoginController::class,'googleCallBack'])->name('callback-google');

    Route::group(['as'=> 'user.', 'prefix' => 'user'],function (){
        Route::get('dashboard', [UserProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('my-profile', [UserProfileController::class, 'my_profile'])->name('my-profile');

        Route::post('update-profile', [UserProfileController::class, 'update_profile'])->name('update-profile');

        Route::post('update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');

        Route::get('add-to-wishlist/{id}', [UserProfileController::class, 'add_to_wishlist'])->name('add-to-wishlist');
        Route::delete('remove-wishlist/{id}', [UserProfileController::class, 'remove_wishlist'])->name('remove-wishlist');

        Route::get('wishlist', [UserProfileController::class, 'wishlist'])->name('wishlist');
        Route::get('my-reviews', [UserProfileController::class, 'my_reviews'])->name('my-reviews');

        Route::get('orders', [UserProfileController::class, 'orders'])->name('orders');
        Route::get('order/{id}', [UserProfileController::class, 'order_show'])->name('order');

        Route::delete('delete-account', [UserProfileController::class, 'delete_account'])->name('delete-account');

        Route::post('add-to-compare/{id}', [UserProfileController::class, 'add_to_compare'])->name('add-to-compare');
        Route::get('compare', [UserProfileController::class, 'compare'])->name('compare');
        Route::delete('remove-compare/{id}', [UserProfileController::class, 'remove_compare'])->name('remove-compare');

        Route::get('logout', [LoginController::class, 'userLogout'])->name('logout');

        Route::resource('property', UserPropertyController::class);
        Route::post('update-property/{id}', [UserPropertyController::class, 'update'])->name('update-property');
        Route::get('choose-property-type', [UserPropertyController::class, 'choose_property_type'])->name('choose-property-type');

        Route::delete('remove-property-slider/{id}', [UserPropertyController::class, 'remove_property_slider'])->name('remove-property-slider');
        Route::delete('remove-nearest-location/{id}', [UserPropertyController::class, 'remove_nearest_location'])->name('remove-nearest-location');
        Route::delete('remove-add-infor/{id}', [UserPropertyController::class, 'remove_add_info'])->name('remove-add-infor');
        Route::delete('remove-plan/{id}', [UserPropertyController::class, 'remove_plan'])->name('remove-plan');


        // Property Booking....

        Route::post('booking', [MyBookingController::class, 'store'])->name('booking.store');
        Route::get('property-booking/', [MyBookingController::class, 'index'])->name('property-booking');
        Route::get('property-booking/show/{id}', [MyBookingController::class, 'show'])->name('property-booking.show');
        Route::post('property-booking/edit/{id}', [MyBookingController::class, 'update'])->name('property-booking.edit');
        Route::delete('property-booking/remove/{id}', [MyBookingController::class, 'remove'])->name('property-booking.remove');

        Route::get('my-booking/', [MyBookingController::class, 'myBooking'])->name('my-booking');
        Route::delete('my-booking/remove/{id}', [MyBookingController::class, 'myBookingRemove'])->name('my-booking.remove');

         // Agency and Agent....

        Route::get('company-profile', [CompanyController::class, 'company_profile'])->name('company-profile');
        Route::get('my-team', [CompanyController::class, 'my_team'])->name('my-team');
        Route::post('apply-company', [CompanyController::class, 'apply_company'])->name('apply-company');
        Route::post('update-agency-information/{id}', [CompanyController::class, 'update_agency_information'])->name('update-agency-information');

        Route::post('store-agent', [CompanyController::class, 'store_agent'])->name('store-agent');
        Route::DELETE('agency-agent-delete/{id}',[CompanyController::class, 'destroy'])->name('agency-agent-destroy');
        Route::get('agency-agent-edit/{id}',[CompanyController::class, 'agency_agent_edit'])->name('agency-agent-edit');
        Route::post('agency-agent-update/{id}',[CompanyController::class, 'agency_agent_update'])->name('agency-agent-update');

    });

    });

});

});
// end admin routes
