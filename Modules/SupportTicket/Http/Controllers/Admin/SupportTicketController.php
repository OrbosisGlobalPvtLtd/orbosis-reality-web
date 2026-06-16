<?php

namespace Modules\SupportTicket\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\SupportTicket\Entities\SupportTicket;
use Modules\SupportTicket\Entities\TicketMessage;
use Modules\SupportTicket\Http\Requests\TicketMessageRequest;
use Auth;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $support_tickets = SupportTicket::latest()->get();

        return view('supportticket::admin.index', [
            'support_tickets' => $support_tickets
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

        $ticket = SupportTicket::where(['ticket_id' => $id])->firstOrFail();

        $ticket_messages = TicketMessage::where('support_ticket_id', $ticket->id)->get();


        return view('supportticket::admin.show', [
            'ticket' => $ticket,
            'ticket_messages' => $ticket_messages,
        ]);
    }


    public function send_support_message(TicketMessageRequest $request, $id){

        $admin = Auth::guard('admin')->user();

        $ticket_message = new TicketMessage();
        $ticket_message->user_id = $request->user_id;
        $ticket_message->admin_id = $admin->id;
        $ticket_message->support_ticket_id = $id;
        $ticket_message->message = $request->message;
        $ticket_message->message_from = 'admin';
        $ticket_message->seen_by_admin = 'yes';
        $ticket_message->save();


        $firstSmsExist = TicketMessage::where('message_from', 'admin')->where('support_ticket_id',$id)->count();


        if($firstSmsExist == 0){
            $ticket = SupportTicket::where(['id' => $id])->first();
            $ticket->status = 'in_progress';
            $ticket->save();

            TicketMessage::where('support_ticket_id',$id)->update(['seen_by_admin' => 'yes']);

        }

        $notification = trans('Message Send Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function ticket_closed($id){
        $ticket = SupportTicket::where('id', $id)->firstOrFail();
        $ticket->status = 'closed';
        $ticket->save();

        $notification= trans('Closed Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.support-tickets.index')->with($notification);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        SupportTicket::where('id', $id)->delete();
        TicketMessage::where('support_ticket_id', $id)->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.support-tickets.index')->with($notification);
    }
}
