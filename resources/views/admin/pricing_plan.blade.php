@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Pricing Plan')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Pricing Plan')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.pricing-plan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('admin.SN')}}</th>
                                    <th >{{__('admin.Plan Name')}}</th>
                                    <th >{{__('admin.Price')}}</th>
                                    <th >{{__('admin.Expiration')}}</th>
                                    <th >{{__('admin.Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)
                                    <tr>
                                        <td>{{ $item->serial }}</td>
                                        <td>{{ $item->plan_name }}</td>
                                        <td>{{ num_format($item->plan_price) }}</td>
                                        <td>{{ $item->expired_time }}</td>
                                        <td>

                                            @if ($item->status == 'enable')
                                                <span class="badge badge-success">{{__('admin.Enable')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('admin.Disable')}}</span>
                                            @endif

                                        </td>

                                        <td>

                                        <a href="{{ route('admin.pricing-plan.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

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
        </section>
      </div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/pricing-plan/") }}'+"/"+id)
    }
</script>
@endsection
