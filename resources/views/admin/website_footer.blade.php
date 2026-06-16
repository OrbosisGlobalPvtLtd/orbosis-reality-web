@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Footer')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Footer')}}</h1>
          </div> 

          @include('template-part.admin_lang_switcer')
          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.footer.update', $footer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code"
                                    value="{{ request('lang_code') ?? admin_lang() }}">

                            <div class="row">

                                @if (admin_lang() === 'en')

                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing Background')}}</label>
                                    <div>
                                        <img src="{{ asset($footer->background_image) }}" alt="" width="220px">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.New Background')}}</label>
                                    <input type="file" name="background_image" class="form-control-file" >
                                </div>

                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.About Us')}} <span class="text-danger">*</span></label>
                                    <textarea name="about_us" class="form-control text-area-5" id="" cols="30" rows="10">{{ $footer->about_us }}</textarea>
                                </div>

                                @if (admin_lang() === 'en')
                                <div class="form-group col-12">
                                    <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ $footer->email }}">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" value="{{ $footer->phone }}">
                                </div>
                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control" value="{{ $footer->address }}">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('admin.Copyright')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="copyright" class="form-control" value="{{ $footer->copyright }}">
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
