@extends('admin.master_layout')
@section('title')
<title>{{ $type === 'pending' ? __('admin.Pending Builder List') : __('admin.Builder List') }}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ $type === 'pending' ? __('admin.Pending Builder List') : __('admin.Builder List') }}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{ $type === 'pending' ? __('admin.Pending Builder List') : __('admin.Builder List') }}</div>
            </div>
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
                                    <th>{{__('admin.SN')}}</th>
                                    <th>{{__('admin.Name')}}</th>
                                    <th>{{__('admin.Company Name')}}</th>
                                    <th>{{__('admin.Email')}}</th>
                                    <th>{{__('admin.Phone')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($builders as $index => $builderUser)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ html_decode($builderUser->name) }}</td>
                                        <td>{{ html_decode($builderUser->builder->company_name ?? 'N/A') }}</td>
                                        <td>{{ html_decode($builderUser->email) }}</td>
                                        <td>{{ html_decode($builderUser->builder->phone_number ?? $builderUser->phone ?? 'N/A') }}</td>

                                        <td>
                                            @if(($builderUser->builder->status ?? 0) == 1)
                                            <a href="javascript:;" onclick="manageBuilderStatus({{ $builderUser->id }})">
                                                <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Approved')}}" data-off="{{__('admin.Pending')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>
                                            @else
                                            <a href="javascript:;" onclick="manageBuilderStatus({{ $builderUser->id }})">
                                                <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Approved')}}" data-off="{{__('admin.Pending')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.builder-show', $builderUser->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $builderUser->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        $("#deleteForm").attr("action",'{{ url("admin/builder-delete/") }}'+"/"+id)
    }
    function manageBuilderStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/builder-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
                setTimeout(function(){
                    location.reload();
                }, 1000);
            },
            error:function(err){
                toastr.error('Error changing status')
            }
        })
    }
</script>
@endsection
