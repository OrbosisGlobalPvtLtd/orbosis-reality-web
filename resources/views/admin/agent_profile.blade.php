@extends('admin.master_layout')
@section('title')
<title>{{__('Associates Profile')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Associates Profile')}}</h1>
          </div>
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="{{ ($admin->agent_image)? asset($admin->agent_image) : asset($setting->default_placeholder)}}" class="rounded-circle profile-widget-picture">
                  </div>
                  <div class="profile-widget-description">
                    <form action="{{ route('admin.agent-profile-update') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')

                        <div class="row">

                            <div class="form-group col-12">
                                <label>{{__('admin.New Image')}}</label>
                                <input type="file" class="form-control-file" name="image">
                            </div>

                            <div class="form-group col-6">
                                <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ $admin->agent_name }}">
                            </div>

                            <div class="form-group col-6">
                                <label>{{__('admin.Desgination')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="designation" value="{{ $admin->designation }}">
                            </div>

                            <div class="form-group col-6">
                                <label>{{__('admin.Email')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="Property page contact message will be send this email"></span> <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ $admin->agent_email }}">
                            </div>

                            <div class="form-group col-6">
                                <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" value="{{ $admin->agent_phone }}">
                            </div>


                            <div class="form-group col-12">
                                <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" value="{{ $admin->agent_address }}">
                            </div>

                            <div class="form-group col-12">
                                <label>{{__('admin.About')}} <span class="text-danger">*</span></label>
                                <textarea name="about_me" class="form-control text-area-5" id="" cols="30" rows="10">{{ $admin->about_me }}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{__('admin.Facebook')}}</label>
                                <input type="text" class="form-control" name="facebook" value="{{ $admin->facebook }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{__('admin.Twitter')}}</label>
                                <input type="text" class="form-control" name="twitter" value="{{ $admin->twitter }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{__('admin.Linkedin')}}</label>
                                <input type="text" class="form-control" name="linkedin" value="{{ $admin->linkedin }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{__('admin.Instagram')}}</label>
                                <input type="text" class="form-control" name="instagram" value="{{ $admin->instagram }}">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection
