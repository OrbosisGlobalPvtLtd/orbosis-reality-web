@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Conact Us')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Conact Us')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Conact Us')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                            <form action="{{ route('admin.contact-us.update',$contact->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img src="{{ asset($contact->supporter_image) }}" width="200px" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>{{__('admin.New Image')}}</label>
                                        <input type="file" id="slug" class="form-control-file"  name="supporter_image">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="email" value="{{ $contact->email }}" class="form-control">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" value="{{ $contact->phone }}" class="form-control">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="address" value="{{ $contact->address }}" class="form-control">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Google Map')}} <span class="text-danger">*</span></label>
                                        <textarea name="google_map" cols="30" rows="10" class="form-control text-area-5">{{ $contact->map }}</textarea>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary">{{__('admin.Update')}}</button>
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
