@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Agency List')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Agency List')}}</h1>

          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('admin.SN')}}</th>
                                    <th >{{__('admin.Agency')}}</th>
                                    <th >{{__('admin.Email')}}</th>
                                    <th >{{__('admin.Agency Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($agencies as $index => $agency)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ html_decode($agency?->profile?->company_name) }}</td>
                                        <td>{{ html_decode($agency?->profile?->email) }}</td>
                                        <td>
                                            @if ($agency->is_agency == 1)
                                                <span class="text-success">{{ __('admin.Approved') }}</span>
                                            @elseif ($agency->is_agency == 2)
                                                <span class="text-danger">{{ __('admin.Pending') }}</span>
                                            @else
                                                <span class="text-muted">{{ __('admin.Unknown') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.agency-show',$agency->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $agency->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
            $("#deleteForm").attr("action",'{{ url("admin/agency-delete/") }}'+"/"+id)
        }
    </script>

@endsection
