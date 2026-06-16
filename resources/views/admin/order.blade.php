@extends('admin.master_layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="table-responsive table-invoice">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th >{{__('admin.SN')}}</th>
                                        <th >{{__('admin.Agent')}}</th>
                                        <th >{{__('admin.Plan Name')}}</th>
                                        <th >{{__('admin.Price')}}</th>
                                        <th >{{__('admin.Expiration')}}</th>
                                        <th >{{__('admin.Payment')}}</th>
                                        <th >{{__('admin.Order Status')}}</th>
                                        <th >{{__('admin.Action')}}</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $index => $item)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>
                                @if(optional($item->agent)->name)
                            <a target="_blank" href="{{ route('admin.agent-show', $item->agent_id) }}">
            {{ $item->agent->name }}
        </a>
    @else
        <span>N/A</span>
    @endif
</td>

                                            <td>{{ $item->plan_name }}</td>
                                            <td>{{ num_format($item->plan_price) }}</td>
                                            <td>{{ $item->expired_time }}</td>

                                            <td>
                                                @if ($item->payment_status == 'success')
                                                    <span class="badge badge-success">{{ $item->payment_status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $item->payment_status }}</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($item->order_status == 'active')
                                                    <span class="badge badge-success">{{ $item->order_status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $item->order_status }}</span>
                                                @endif
                                            </td>


                                            <td>
                                                <a href="{{ route('admin.show-purchase-history',$item->order_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $item->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        </div>
    </section>
</div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/delete-order/") }}'+"/"+id)
    }
</script>
@endsection
