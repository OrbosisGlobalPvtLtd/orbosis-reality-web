
@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Agency Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Agency Details')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.agency') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Agency List')}}</a>
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
                        @if ($agent?->profile?->image)
                        <img alt="image" src="{{ asset($agent?->profile?->image) }}" class="rounded-circle profile-widget-picture">
                        @else
                        <img alt="image" src="{{ asset($default_user_avatar) }}" class="rounded-circle profile-widget-picture">
                        @endif
                      <div class="profile-widget-items">
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Joined at')}}</div>
                          <div class="profile-widget-item-value">{{ $agent?->profile?->created_at->format('d M Y') }}</div>
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
                                    <td>{{ html_decode($agent?->profile?->name) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Email')}}</td>
                                    <td>{{ html_decode($agent?->profile?->email) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Phone')}}</td>
                                    <td>{{ html_decode($agent?->profile?->phone) }}</td>
                                </tr>
                                @if($agent->is_agency != 0)
                                    <tr>
                                        <td>{{__('admin.Agency Status')}}</td>
                                        @if($agent->is_agency == 2)
                                            <td>{{ __('admin.Pending') }}</td>
                                        @else
                                            <td>{{ __('admin.Approved') }}</td>
                                        @endif
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{__('admin.Status')}}</td>
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
                                <h1>{{__('admin.Agency Action')}}</h1>
                            </div>
                            <div class="card-body text-center">
                                <div class="row">
                                    @if($agent->is_agency == 2)
                                        <div class="col-12">
                                            <a href="javascript:;" onclick="approveAgency({{ $agent->id }})" class="btn bg-danger btn-block btn-lg my-2 text-white">{{__('admin.Approve Agency')}}</a>
                                        </div>

                                        <form class="d-none" action="{{ route('admin.agency-approve', $agent->id) }}" method="POST" id="approve-agency-{{ $agent->id }}">
                                            @csrf
                                        </form>

                                    @endif

                                    <div class="col-12">
                                        <a href="{{ route('agency-details', $agent?->id) }}" target="_blank" class="btn btn-warning btn-block btn-lg my-2">{{__('admin.View Public Profile')}}</a>
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('admin.review-list', ['agent_id' => $agent->id]) }}" class="btn btn-primary btn-block btn-lg my-2">{{__('admin.Property Reviews')}}</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate="" action="{{ route('admin.agency-update',$agent?->profile?->id) }}">
                            @method('put')
                            @csrf
                            <div class="card-header">
                                <h4>{{__('admin.Edit Profile')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent?->profile?->company_name) }}" name="name">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Desgination')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent?->profile?->tag_line) }}" name="tag_line">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" value="{{ html_decode($agent?->profile?->email) }}" name="email" readonly>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent?->profile?->phone) }}" name="phone">
                                    </div>


                                    <div class="form-group col-12">
                                        <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent?->profile?->address) }}" name="address">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.About')}} <span class="text-danger">*</span></label>
                                        <textarea name="about_us" class="form-control text-area-5" id="" cols="30" rows="10">{{ html_decode($agent?->profile?->about_us) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Facebook')}}</label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent?->profile?->facebook) }}" name="facebook">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Twitter')}}</label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent?->profile?->twitter) }}" name="twitter">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Linkedin')}}</label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent?->profile?->linkedin) }}" name="linkedin">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Instagram')}}</label>
                                        <input type="text" class="form-control" value="{{ html_decode($agent?->profile?->instagram) }}" name="instagram">
                                    </div>

                                </div>
                                <button class="btn btn-primary" type="submit">{{__('admin.Save Changes')}}</button>
                            </div>

                        </form>
                    </div>
                </div>

              </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h1>{{__('admin.Document Section')}}</h1>
                    </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>{{__('admin.Document')}}</label>
                            <div>
                                <img width="300px" src="{{ asset($agent?->profile?->file) }}" alt="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('admin.Document Type')}}</label>
                            <p>{{ html_decode($agent?->profile?->kyc?->name) }}</p>
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{__('admin.Message')}}</label>
                            <p>{{ html_decode($agent?->profile?->message) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-title mt-4 ml-4">
                    <h5>{{__('admin.Agent List')}}</h5>
                  </div>
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


    function approveAgency(id){
        Swal.fire({
            title: "{{__('admin.Are you really want to approve this agency ?')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{__('admin.Yes, Approve It')}}",
            cancelButtonText: "{{__('admin.Cancel')}}",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#approve-agency-"+id).submit();
            }

        })
    }


</script>

@endsection
