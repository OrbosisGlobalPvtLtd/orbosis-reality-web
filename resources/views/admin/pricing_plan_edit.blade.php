@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Pricing Plan')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Pricing Plan')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.pricing-plan.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Pricing Plan')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.pricing-plan.update', $item->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Plan Type')}} <span class="text-danger">*</span></label>
                                        <select name="plan_type" id="plan_type" class="form-control">
                                            <option {{ $item->plan_type == 'premium' ? 'selected' : '' }} value="premium">{{__('admin.Premium')}}</option>
                                            <option {{ $item->plan_type == 'free' ? 'selected' : '' }} value="free">{{__('admin.Free')}}</option>
                                        </select>
                                    </div>
                                </div>

                                @if ($item->plan_type == 'premium')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Plan Price')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="Price should be USD($)"></span> <span class="text-danger">*</span></label>
                                            <input value="{{ $item->plan_price }}" type="text" name="plan_price" id="plan_price" class="form-control">
                                        </div>
                                    </div>
                                @endif

                                @if ($item->plan_type != 'premium')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Plan Price')}} <span class="text-danger">*</span></label>
                                            <input value="{{ $item->plan_price }}" type="text" name="plan_price" id="plan_price" class="form-control" readonly>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Plan Name')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="plan_name" class="form-control" value="{{ $item->plan_name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Expiration')}} <span class="text-danger">*</span></label>
                                        <select name="expired_time" id="" class="form-control">
                                            <option {{ $item->expired_time == 'monthly' ? 'selected' : '' }} value="monthly">{{__('admin.Monthly')}}</option>
                                            <option {{ $item->expired_time == 'yearly' ? 'selected' : '' }} value="yearly">{{__('admin.Yearly')}}</option>
                                            <option {{ $item->expired_time == 'limetime' ? 'selected' : '' }} value="lifetime">{{__('admin.Lifetime')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Number of property')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="number_of_property" class="form-control" value="{{ $item->number_of_property }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Featured Property')}} <span class="text-danger">*</span></label>
                                        <select name="featured_property" id="featured_property" class="form-control">
                                            <option {{ $item->featured_property == 'enable' ? 'selected' : '' }} value="enable">{{__('admin.Enable')}}</option>
                                            <option {{ $item->featured_property == 'disable' ? 'selected' : '' }} value="disable">{{__('admin.Disable')}}</option>
                                        </select>
                                    </div>
                                </div>

                                @if ($item->featured_property == 'enable')
                                    <div class="col-md-6" id="featured_property_qty">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Number of featured property')}} <span class="text-danger">*</span></label>
                                            <input type="number" name="featured_property_qty" class="form-control" value="{{ $item->featured_property_qty }}">
                                        </div>
                                    </div>
                                @endif

                                @if ($item->featured_property != 'enable')
                                    <div class="col-md-6 d-none" id="featured_property_qty">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Number of featured property')}} <span class="text-danger">*</span></label>
                                            <input type="number" name="featured_property_qty" class="form-control" value="{{ $item->featured_property_qty }}">
                                        </div>
                                    </div>
                                @endif



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Top Property')}} <span class="text-danger">*</span></label>
                                        <select name="top_property" id="top_property" class="form-control">
                                            <option {{ $item->top_property == 'enable' ? 'selected' : '' }} value="enable">{{__('admin.Enable')}}</option>
                                            <option {{ $item->top_property == 'disable' ? 'selected' : '' }} value="disable">{{__('admin.Disable')}}</option>
                                        </select>
                                    </div>
                                </div>

                                @if ($item->top_property == 'enable')
                                    <div class="col-md-6" id="top_property_qty">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Number of top property')}} <span class="text-danger">*</span></label>
                                            <input type="number" name="top_property_qty" class="form-control" value="{{ $item->top_property_qty }}">
                                        </div>
                                    </div>
                                @endif


                                @if ($item->top_property != 'enable')
                                    <div class="col-md-6 d-none" id="top_property_qty">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Number of top property')}} <span class="text-danger">*</span></label>
                                            <input type="number" name="top_property_qty" class="form-control" value="{{ $item->top_property_qty }}">
                                        </div>
                                    </div>
                                @endif




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Urgent Property')}} <span class="text-danger">*</span></label>
                                        <select name="urgent_property" id="urgent_property" class="form-control">
                                            <option {{ $item->urgent_property == 'enable' ? 'selected' : '' }} value="enable">{{__('admin.Enable')}}</option>
                                            <option {{ $item->urgent_property == 'disable' ? 'selected' : '' }} value="disable">{{__('admin.Disable')}}</option>
                                        </select>
                                    </div>
                                </div>

                                @if ($item->urgent_property == 'enable')
                                    <div class="col-md-6" id="urgent_property_qty">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Number of urgent property')}} <span class="text-danger">*</span></label>
                                            <input type="number" name="urgent_property_qty" class="form-control" value="{{ $item->urgent_property_qty }}">
                                        </div>
                                    </div>
                                @endif

                                @if ($item->urgent_property != 'enable')
                                    <div class="col-md-6 d-none" id="urgent_property_qty">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Number of urgent property')}} <span class="text-danger">*</span></label>
                                            <input type="number" name="urgent_property_qty" class="form-control" value="{{ $item->urgent_property_qty }}">
                                        </div>
                                    </div>
                                @endif



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Number of Maximum Agent Add')}} <span class="text-danger">*</span>

                                            <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="Apply to existing agent"></span>

                                            <label class="custom-switch">
                                                <input type="checkbox" name="apply_to_existing_user" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                              </label>



                                        </label>
                                        <input type="number" name="max_agent_add" class="form-control" value="{{ $item->max_agent_add }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Serial')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="serial" class="form-control" value="{{ $item->serial }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option {{ $item->status == 'enable' ? 'selected' : '' }}  value="enable">{{__('admin.Enable')}}</option>
                                            <option {{ $item->status == 'disable' ? 'selected' : '' }}  value="disable">{{__('admin.Disable')}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-primary">{{__('admin.Update')}}</button>

                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>


<script>


    (function($) {
        "use strict";
        $(document).ready(function () {
            $("#plan_type").on("change", function(){
                let plan_type = $(this).val();
                if(plan_type == 'premium'){
                    $("#plan_price").attr('readOnly', false);
                    $("#plan_price").val('');
                }else{
                    $("#plan_price").attr('readOnly', true);
                    $("#plan_price").val('0.00');
                }
            })

            $("#featured_property").on("change", function(){
                let plan_type = $(this).val();
                if(plan_type == 'enable'){
                    $("#featured_property_qty").removeClass('d-none');
                }else{
                    $("#featured_property_qty").addClass('d-none');
                }
            })

            $("#top_property").on("change", function(){
                let plan_type = $(this).val();
                if(plan_type == 'enable'){
                    $("#top_property_qty").removeClass('d-none');
                }else{
                    $("#top_property_qty").addClass('d-none');
                }
            })

            $("#urgent_property").on("change", function(){
                let plan_type = $(this).val();
                if(plan_type == 'enable'){
                    $("#urgent_property_qty").removeClass('d-none');
                }else{
                    $("#urgent_property_qty").addClass('d-none');
                }
            })


        });
    })(jQuery);

</script>
@endsection

