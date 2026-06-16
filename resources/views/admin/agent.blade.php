@extends('admin.master_layout')
@section('title')
<title>{{__('Associates List')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Associates List')}}</h1>

          </div>

          <div class="section-body">
              <a href="{{ route('admin.send-email-to-all-agent') }}" class="btn btn-primary">{{__('admin.Send email to all agent')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('admin.SN')}}</th>
                                    <th >{{__('admin.Agent')}}</th>
                                    <th >{{__('admin.Email')}}</th>
                                    <th >{{__('admin.Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($agents as $index => $agent)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ html_decode($agent->name) }}</td>
                                        <td>{{ html_decode($agent->email) }}</td>
                                        <td>
                                            @if($agent->status == 1)
                                            <a href="javascript:;" onclick="manageCustomerStatus({{ $agent->id }})">
                                                <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.Inctive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>

                                            @else
                                            <a href="javascript:;" onclick="manageCustomerStatus({{ $agent->id }})">
                                                <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>

                                            @endif
                                        </td>
                                        <td>

                                        <a href="{{ route('admin.agent-show',$agent->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a href="{{ route('admin.send-email-to-agent',$agent->id) }}" class="btn btn-success btn-sm"><i class="far fa-envelope" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $agent->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        $("#deleteForm").attr("action",'{{ url("admin/agent-delete/") }}'+"/"+id)
    }
    function manageCustomerStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/agent-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
