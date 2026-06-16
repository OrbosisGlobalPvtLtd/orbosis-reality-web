@extends('admin.master_layout')
@section('title')
<title>{{__('Support Ticket')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Support Ticket')}}</h1>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped report_table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('SN')}}</th>
                                    <th >{{__('From')}}</th>
                                    <th >{{__('Ticket Info')}}</th>
                                    <th >{{__('Unread Message')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th >{{__('Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($support_tickets as $index => $ticket)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            <p>
                                                {{__('Name')}}: <a href="{{ route('admin.customer-show',$ticket->user_id) }}">{{ $ticket?->user?->name }}</a>
                                            </p>
                                            <p>{{__('User Type')}} : {{__('Client')}}</p>
                                            <p>{{__('Email')}} : {{ $ticket->user->email  }}</p>
                                            <p>{{__('Phone')}} : {{ $ticket->user->Phone  }}</p>
                                        </td>
                                        <td>
                                            <p>{{__('Subject')}}: {{ html_decode($ticket->subject) }}</p>
                                            <p>{{__('Ticket Id')}}: {{ $ticket->ticket_id }}</p>
                                            <p>{{__('Created')}}: {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
                                        </td>

                                        <td>
                                            @php

                                                $unseen_message = Modules\SupportTicket\Entities\TicketMessage::where('seen_by_admin', 'no')->where('support_ticket_id', $ticket->id)->count();
                                            @endphp
                                            @if ($unseen_message > 0)
                                            <span class="badge badge-danger">{{ $unseen_message }}</span>
                                            @endif

                                        </td>


                                        <td>
                                            @if($ticket->status == 'pending')
                                            <span class="badge badge-danger">{{__('Pending')}}</span>
                                            @elseif ($ticket->status == 'in_progress')
                                            <span class="badge badge-success">{{__('In Progress')}}</span>
                                            @elseif ($ticket->status == 'closed')
                                            <span class="badge badge-danger">{{__('Closed')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('admin.support-tickets.show',$ticket->ticket_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $ticket->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>

                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/support-tickets/") }}'+"/"+id)
    }
</script>
@endsection
