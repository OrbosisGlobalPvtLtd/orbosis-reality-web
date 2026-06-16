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
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body ticket-message">
                            <div class="list-group">
                                @foreach ($ticket_messages as $message)
                                    @if ($message->admin_id == 0)
                                        <div class="list-group-item list-group-item-action flex-column align-items-start author_message mb-2">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1"> {{ $ticket->user->name }} <small>({{__('Author')}})</small></h6> <small>{{ $message->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1">{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                        </div>
                                    @else
                                        <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ $message->admin ? $message->admin->name : '' }} <small>({{__('Administrator')}})</small></h6> <small>{{ $message->created_at->diffForHumans() }} </small>
                                            </div>
                                            <p class="mb-1">{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                        </div>

                                    @endif
                                @endforeach


                            </div>

                            <div class="message-box mt-4">
                                <form action="{{ route('admin.send-support-message', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <textarea required name="message" placeholder="{{__('Type here')}}.." class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                                    </div>
                                    <input type="hidden" value="{{ $ticket->id }}" name="ticket_id">
                                    <input type="hidden" value="{{ $ticket->user_id }}" name="user_id">
                                    {{-- <div class="form-group">
                                        <input type="file" name="documents[]" multiple class="form-control">
                                        <span class="text-danger">{{__('Maximum file size 2MB')}}</span>
                                    </div> --}}

                                    <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>{{__('Ticket Information')}}</h6>
                            <hr>
                            <p>{{__('Subject')}}: {{ html_decode($ticket->subject) }}</p>
                            <p>{{__('Ticket Id')}}: {{ $ticket->ticket_id }}</p>
                            <p>{{__('Created')}}: {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
                            <p>{{__('Status')}}:
                                @if($ticket->status == 'pending')
                                <span class="badge badge-danger">{{__('Pending')}}</span>
                                @elseif ($ticket->status == 'in_progress')
                                <span class="badge badge-success">{{__('In Progress')}}</span>
                                @elseif ($ticket->status == 'closed')
                                <span class="badge badge-danger">{{__('Closed')}}</span>
                                @endif
                            </p>

                            <h6 class="mt-3">{{__('User Information')}}</h6>
                            <hr>

                            <p>
                                {{__('Name')}}: <a href="{{ route('admin.customer-show',$ticket->user_id) }}">{{ $ticket?->user?->name }}</a>
                            </p>
                            <p>{{__('User Type')}} : {{__('Client')}}</p>
                            <p>{{__('Email')}} : {{ $ticket->user->email  }}</p>
                            <p>{{__('Phone')}} : {{ $ticket->user->Phone  }}</p>

                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger" onclick="deleteData({{ $ticket->id }})"><i class="fa fa-trash" aria-hidden="true"></i> {{__('Delete')}}</a>

                            @if ($ticket->status != 'closed')
                                <a data-toggle="modal" data-target="#closeTicket" href="javascript:;" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> {{__('Closed')}}</a>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="closeTicket">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{__('Ticket Closed Confirmation')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>{{__('Are You sure closed this ticket ?')}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('admin.ticket-closed', $ticket->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <button type="submit" class="btn btn-primary">{{__('Yes, Closed')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/support-tickets/") }}'+"/"+id)
    }
</script>
@endsection
