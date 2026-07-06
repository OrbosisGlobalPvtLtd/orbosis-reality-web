@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Builder Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Builder Details')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item"><a href="{{ route('admin.builder') }}">{{__('admin.Builder List')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Builder Details')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.builder') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Builder List')}}</a>
            <div class="row mt-5">

                <div class="col-md-3">
                    <a href="{{ route('admin.agent-property',['agent_id' => $builderUser->id]) }}">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas far fa-building"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>{{__('admin.Total Property')}}</h4>
                              </div>
                              <div class="card-body">
                               {{ $total_property }}
                              </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('admin.agent-pending-property',['agent_id' => $builderUser->id]) }}">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                            <i class="fas far fa-building"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{__('admin.Pending Property')}}</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_pending_property }}
                            </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('admin.agent-property',['agent_id' => $builderUser->id, 'type' => 'enable']) }}">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                              <i class="fas far fa-building"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>{{__('admin.Active Property')}}</h4>
                              </div>
                              <div class="card-body">
                                {{ $total_active_property }}
                              </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('admin.purchase-history', ['agent_id' => $builderUser->id]) }}">
                      <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                          <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                          <div class="card-header">
                            <h4>{{__('admin.Total Purchase')}}</h4>
                          </div>
                          <div class="card-body">
                            {{ num_format($total_purchase_amount) }}
                          </div>
                        </div>
                      </div>
                    </a>
                </div>
            </div>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                  <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @if ($builderUser->image)
                        <img alt="image" src="{{ asset($builderUser->image) }}" class="rounded-circle profile-widget-picture">
                        @elseif ($builderUser->builder->company_logo ?? '')
                        <img alt="image" src="{{ asset($builderUser->builder->company_logo) }}" class="rounded-circle profile-widget-picture">
                        @else
                        <img alt="image" src="{{ asset($default_user_avatar) }}" class="rounded-circle profile-widget-picture">
                        @endif
                      <div class="profile-widget-items">
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Joined at')}}</div>
                          <div class="profile-widget-item-value">{{ $builderUser->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Status')}}</div>
                          <div class="profile-widget-item-value">
                              @php
                                  $status = $builderUser->builder->status ?? 0;
                              @endphp
                              @if($status == 1)
                                  <span class="text-success">{{__('admin.Approved')}}</span>
                              @elseif($status == 2)
                                  <span class="text-danger">{{__('admin.Rejected')}}</span>
                              @elseif($status == 3)
                                  <span class="text-secondary">{{__('admin.Suspended')}}</span>
                              @else
                                  <span class="text-warning">{{__('admin.Pending')}}</span>
                              @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>{{__('admin.Name')}}</td>
                                    <td>{{ html_decode($builderUser->name) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Company Name')}}</td>
                                    <td>{{ html_decode($builderUser->builder->company_name ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Email')}}</td>
                                    <td>{{ html_decode($builderUser->email) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Phone')}}</td>
                                    <td>{{ html_decode($builderUser->builder->phone_number ?? $builderUser->phone ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.GSTIN')}}</td>
                                    <td>{{ html_decode($builderUser->builder->gstin ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.PAN Number')}}</td>
                                    <td>{{ html_decode($builderUser->builder->pan_number ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Registration Number')}}</td>
                                    <td>{{ html_decode($builderUser->builder->registration_number ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Business Type')}}</td>
                                    <td>{{ html_decode($builderUser->builder->business_type ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Website')}}</td>
                                    <td>
                                        @if($builderUser->builder->website ?? '')
                                            <a href="{{ $builderUser->builder->website }}" target="_blank">{{ $builderUser->builder->website }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Address')}}</td>
                                    <td>{{ html_decode($builderUser->builder->full_address ?? $builderUser->address ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                     <td>{{__('admin.Approval Status')}}</td>
                                     <td>
                                         @php
                                             $bStatus = $builderUser->builder->status ?? 0;
                                         @endphp
                                         <div class="mb-2">
                                             @if($bStatus == 1)
                                                 <span class="badge badge-success">{{__('admin.Approved')}}</span>
                                             @elseif($bStatus == 2)
                                                 <span class="badge badge-danger">{{__('admin.Rejected')}}</span>
                                             @elseif($bStatus == 3)
                                                 <span class="badge badge-secondary">{{__('admin.Suspended')}}</span>
                                             @else
                                                 <span class="badge badge-warning">{{__('admin.Pending')}}</span>
                                             @endif
                                         </div>
                                         <div class="btn-group" role="group">
                                             @if($bStatus != 1)
                                                 <button type="button" class="btn btn-success btn-sm mr-1" onclick="changeBuilderStatus({{ $builderUser->id }}, 1)">
                                                     <i class="fas fa-check"></i> {{__('admin.Approve')}}
                                                 </button>
                                             @endif
                                             @if($bStatus != 2)
                                                 <button type="button" class="btn btn-danger btn-sm mr-1" onclick="changeBuilderStatus({{ $builderUser->id }}, 2)">
                                                     <i class="fas fa-times"></i> {{__('admin.Reject')}}
                                                 </button>
                                             @endif
                                             @if($bStatus != 3)
                                                 <button type="button" class="btn btn-secondary btn-sm mr-1" onclick="changeBuilderStatus({{ $builderUser->id }}, 3)">
                                                     <i class="fas fa-ban"></i> {{__('admin.Suspend')}}
                                                 </button>
                                             @endif
                                             @if($bStatus != 0)
                                                 <button type="button" class="btn btn-warning btn-sm" onclick="changeBuilderStatus({{ $builderUser->id }}, 0)">
                                                     <i class="fas fa-undo"></i> {{__('admin.Set Pending')}}
                                                 </button>
                                             @endif
                                         </div>
                                     </td>
                                 </tr>
                            </table>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('admin.Verification Documents')}}</h4>
                        </div>
                        <div class="card-body">
                            @if($builderUser->builder->business_registration_doc ?? '')
                                <div class="form-group">
                                    <label>{{__('admin.Business Registration Document')}}</label>
                                    <div>
                                        @php
                                            $docPath = $builderUser->builder->business_registration_doc;
                                            $extension = pathinfo($docPath, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ asset($docPath) }}" class="img-fluid img-thumbnail" style="max-height: 400px;" alt="Doc">
                                        @else
                                            <div class="alert alert-info">
                                                <i class="fas fa-file-alt"></i> {{ basename($docPath) }}
                                            </div>
                                        @endif
                                        <div class="mt-2">
                                            <a href="{{ asset($docPath) }}" class="btn btn-primary" download><i class="fas fa-download"></i> {{__('admin.Download Document')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    {{__('admin.No business registration document uploaded.')}}
                                </div>
                            @endif

                            <div class="form-group mt-4">
                                <label>{{__('admin.Company Description')}}</label>
                                <p>{{ html_decode($builderUser->builder->description ?? 'N/A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </section>
      </div>

<script>
    function changeBuilderStatus(id, status){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { 
                _token : '{{ csrf_token() }}',
                status: status
            },
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
