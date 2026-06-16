<?php

namespace Modules\SupportTicket\Http\Controllers\API;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\SupportTicket\Entities\SupportTicket;
use Modules\SupportTicket\Entities\TicketMessage;
use Modules\SupportTicket\Http\Requests\SupportTicketRequest;
use Modules\SupportTicket\Http\Requests\TicketMessageRequest;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $user = Auth::guard('api')->user();

        $support_tickets = SupportTicket::where('user_id', $user->id)->latest()->get();

        return response()->json([
             'support_tickets' => $support_tickets
        ]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $priorities = [
            'Low',
            'Midum',
            'High',
            'Urgent'
        ];

        return response()->json([
            'priorities' => $priorities
       ]);

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SupportTicketRequest $request)
    {

        $user = Auth::guard('api')->user();

        $ticket = new SupportTicket();
        $ticket->user_id = $user->id;
        $ticket->ticket_id = substr(rand(0,time()),0,10);
        $ticket->subject = $request->subject;
        $ticket->priority = $request->priority;
        $ticket->save();

        $ticket_message = new TicketMessage();
        $ticket_message->user_id = $user->id;
        $ticket_message->support_ticket_id = $ticket->id;
        $ticket_message->message = $request->message;
        $ticket_message->message_from = 'user';
        $ticket_message->seen_by_user = 'yes';
        $ticket_message->save();

        return response()->json([
            'message' => trans('Ticket Created Successful'),
            'ticket' => $ticket,
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

        $user = Auth::guard('api')->user();

        $ticket = SupportTicket::where(['user_id' => $user->id, 'id' => $id])->first();

        if(!$ticket){
            return response()->json([
                'message' => trans('Ticket Not Found'),
            ],403);
        }


        $ticket_messages = TicketMessage::where('support_ticket_id', $ticket->id)->get();

        return response()->json([
            'ticket' => $ticket,
            'ticket_messages' => $ticket_messages,
        ]);

    }

    public function send_support_message(TicketMessageRequest $request, $id){

        $user = Auth::guard('api')->user();

        $ticket_message = new TicketMessage();
        $ticket_message->user_id = $user->id;
        $ticket_message->support_ticket_id = $id;
        $ticket_message->message = $request->message;
        $ticket_message->message_from = 'user';
        $ticket_message->seen_by_user = 'yes';
        $ticket_message->save();


        return response()->json([
            'message' => trans('Message Send Successful'),
            'ticket_message' => $ticket_message,
        ]);

    }


}
