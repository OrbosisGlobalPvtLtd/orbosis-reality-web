
@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create User')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create User')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.customer-list') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.User List')}}</a>

            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card">
                        <form method="post" novalidate="" action="{{ route('admin.store-user') }}">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Desgination')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="designation">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Password')}} <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone">
                                    </div>


                                    <div class="form-group col-12">
                                        <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="address">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.About')}} <span class="text-danger">*</span></label>
                                        <textarea name="about_me" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Facebook')}}</label>
                                        <input type="text" class="form-control" name="facebook">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Twitter')}}</label>
                                        <input type="text" class="form-control" name="twitter">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Linkedin')}}</label>
                                        <input type="text" class="form-control" name="linkedin">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('admin.Instagram')}}</label>
                                        <input type="text" class="form-control" name="instagram">
                                    </div>

                                </div>
                                <button class="btn btn-primary" type="submit">{{__('admin.Save')}}</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
          </div>
        </section>
      </div>


@endsection
