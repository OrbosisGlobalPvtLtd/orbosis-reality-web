@php
    $unseenMessages = Modules\SupportTicket\Entities\TicketMessage::where('seen_by_admin', 'no')->groupBy('support_ticket_id')->get();
    $count = $unseenMessages->count();
@endphp

<li class="{{ Route::is('admin.support-tickets.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.support-tickets.index') }}"><i class="fas fa-envelope-open-text"></i> <span>{{__('Support Ticket')}} <sup class="badge badge-danger">{{ $count }}</sup></span></a></li>
