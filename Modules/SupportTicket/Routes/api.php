<?php

use Illuminate\Http\Request;
use Modules\SupportTicket\Http\Controllers\API\SupportTicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['XSS', 'maintainance', 'auth:api']], function () {

    Route::group(['as'=> 'user.', 'prefix' => 'user'],function (){
        Route::resource('support-tickets', SupportTicketController::class);
        Route::post('send-support-message/{ticket_id}', [SupportTicketController::class, 'send_support_message'])->name('send-support-message');

    });

});
