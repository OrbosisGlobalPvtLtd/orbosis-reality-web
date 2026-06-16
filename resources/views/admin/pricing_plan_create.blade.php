@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create Pricing Plan')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create Pricing Plan')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.pricing-plan.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Pricing Plan')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.pricing-plan.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Plan Type')}} <span class="text-danger">*</span></label>
                                        <select name="plan_type" id="plan_type" class="form-control">
                                            <option value="premium">{{__('admin.Premium')}}</option>
                                            <option value="free">{{__('admin.Free')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Plan Price')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="Price should be USD($)"></span> <span class="text-danger">*</span></label>
                                        <input type="text" name="plan_price" id="plan_price" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Plan Name')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="plan_name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Expiration')}} <span class="text-danger">*</span></label>
                                        <select name="expired_time" id="" class="form-control">
                                            <option value="monthly">{{__('admin.Monthly')}}</option>
                                            <option value="yearly">{{__('admin.Yearly')}}</option>
                                            <option value="lifetime">{{__('admin.Lifetime')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Number of property')}}  <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="For unlimited use(-1)"></span> <span class="text-danger">*</span> </label>
                                        <input type="number" name="number_of_property" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Featured Property')}} <span class="text-danger">*</span></label>
                                        <select name="featured_property" id="featured_property" class="form-control">
                                            <option value="enable">{{__('admin.Enable')}}</option>
                                            <option value="disable">{{__('admin.Disable')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" id="featured_property_qty">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Number of featured property')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="For unlimited use(-1)"></span> <span class="text-danger">*</span></label>
                                        <input type="number" name="featured_property_qty" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Top Property')}} <span class="text-danger">*</span></label>
                                        <select name="top_property" id="top_property" class="form-control">
                                            <option value="enable">{{__('admin.Enable')}}</option>
                                            <option value="disable">{{__('admin.Disable')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" id="top_property_qty">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Number of top property')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="For unlimited use(-1)"></span> <span class="text-danger">*</span></label>
                                        <input type="number" name="top_property_qty" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Urgent Property')}} <span class="text-danger">*</span></label>
                                        <select name="urgent_property" id="urgent_property" class="form-control">
                                            <option value="enable">{{__('admin.Enable')}}</option>
                                            <option value="disable">{{__('admin.Disable')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" id="urgent_property_qty">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Number of urgent property')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="For unlimited use(-1)"></span> <span class="text-danger">*</span></label>
                                        <input type="number" name="urgent_property_qty" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Number of Maximum Agent Add')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="max_agent_add" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Serial')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="serial" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option value="enable">{{__('admin.Enable')}}</option>
                                            <option value="disable">{{__('admin.Disable')}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-primary">{{__('admin.Save')}}</button>

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

