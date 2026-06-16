
@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Agent Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Agent Details')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.agent') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Agent List')}}</a>
            <div class="row mt-5">

                <div class="col-md-3">
                    <a href="{{ route('admin.agent-property',['agent_id' => $agent->id]) }}">
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
                        <a href="{{ route('admin.agent-pending-property',['agent_id' => $agent->id]) }}">
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
                    <a href="{{ route('admin.agent-property',['agent_id' => $agent->id, 'type' => 'enable']) }}">
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
                    <a href="{{ route('admin.purchase-history', ['agent_id' => $agent->id]) }}">
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
                        @if ($agent->image)
                        <img alt="image" src="{{ asset($agent->image) }}" class="rounded-circle profile-widget-picture">
                        @else
                        <img alt="image" src="{{ asset($default_user_avatar) }}" class="rounded-circle profile-widget-picture">
                        @endif
                      <div class="profile-widget-items">
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Joined at')}}</div>
                          <div class="profile-widget-item-value">{{ $agent->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Total Purchase')}}</div>
                          <div class="profile-widget-item-value">{{ num_format($total_purchase_amount) }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>{{__('admin.Name')}}</td>
                                    <td>{{ html_decode($agent->name) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Email')}}</td>
                                    <td>{{ html_decode($agent->email) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Phone')}}</td>
                                    <td>{{ html_decode($agent->phone) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Agent Status')}}</td>
                                    <td>
                                        @if($agent->status == 1)
                                        <a href="javascript:;" onclick="manageCustomerStatus({{ $agent->id }})">
                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                        </a>
                                        @else
                                        <a href="javascript:;" onclick="manageCustomerStatus({{ $agent->id }})">
                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                        </a>
                                    @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                  </div>

                  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h1>{{__('admin.Agent Action')}}</h1>
                            </div>
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col-12">
                                        <a target="_blank" href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => $agent->user_name]) }}" class="btn btn-success btn-block btn-lg my-2">{{__('admin.Go to Agent Front Page')}}</a>
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('admin.review-list', ['agent_id' => $agent->id]) }}" class="btn btn-primary btn-block btn-lg my-2">{{__('admin.Property Reviews')}}</a>
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('admin.send-email-to-agent', $agent->id) }}" class="btn btn-warning btn-block btn-lg my-2">{{__('admin.Send Email')}}</a>
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('admin.purchase-history', ['agent_id' => $agent->id]) }}" class="btn btn-primary btn-block btn-lg my-2">{{__('admin.Purchase History')}}</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate="" action="{{ route('admin.agent-update',$agent->id) }}">
                            @method('put')
                            @csrf
                            <div class="card-header">
                                <h4>{{__('admin.Edit Profile')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent->name) }}" name="name">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Desgination')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent->designation) }}" name="designation">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" value="{{ html_decode($agent->email) }}" name="email" readonly>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent->phone) }}" name="phone">
                                    </div>


                                    <div class="form-group col-12">
                                        <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent->address) }}" name="address">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.About')}} <span class="text-danger">*</span></label>
                                        <textarea name="about_me" class="form-control text-area-5" id="" cols="30" rows="10">{{ html_decode($agent->about_me) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Facebook')}}</label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent->facebook) }}" name="facebook">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Twitter')}}</label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent->twitter) }}" name="twitter">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Linkedin')}}</label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent->linkedin) }}" name="linkedin">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Instagram')}}</label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent->instagram) }}" name="instagram">
                                    </div>

                                </div>
                                <button class="btn btn-primary" type="submit">{{__('admin.Save Changes')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
              </div>
          </div>
        </section>
      </div>




<script>



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
