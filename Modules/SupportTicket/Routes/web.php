<?php

use Modules\SupportTicket\Http\Controllers\Admin\SupportTicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['XSS', 'auth:admin', 'adminLangSession']], function () {

    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){
        Route::resource('support-tickets', SupportTicketController::class);

        Route::post('send-support-message/{ticket_id}', [SupportTicketController::class, 'send_support_message'])->name('send-support-message');
        Route::put('ticket-closed/{ticket_id}', [SupportTicketController::class, 'ticket_closed'])->name('ticket-closed');
    });

});
