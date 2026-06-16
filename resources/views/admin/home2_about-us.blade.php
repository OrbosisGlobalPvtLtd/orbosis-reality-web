@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Home2 About Us')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Home2 About Us')}}</h1>
          </div>

          @include('template-part.admin_lang_switcer')

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">

                        <form action="{{ route('admin.update-home2-about-us') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="lang_code"
                                        value="{{ request('lang_code') ?? admin_lang() }}">

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Home one')}}</label>
                                <div>
                                    <img class="h_300"  src="{{ ($about->home2_image1)? asset($about->home2_image1) : asset($setting->default_placeholder)}}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Image')}}</label>
                                <input type="file" name="home2_image1" class="form-control-file">
                            </div>


                            <div class="form-group">
                                <label for="">{{__('admin.Image two')}}</label>
                                <div>
                                    <img class="h_300"  src="{{ ($about->home2_image2)? asset($about->home2_image2) : asset($setting->default_placeholder)}}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Image')}}</label>
                                <input type="file" name="home2_image2" class="form-control-file">
                            </div>


                            <div class="form-group">
                                <label for="">{{__('admin.Percentage')}}</label>
                                <input type="text" class="form-control" name="home2_percentage" value="{{ $about->home2_percentage }}">
                            </div>

                            @endif
                            

                            <div class="form-group">
                                <label for="">{{__('admin.Percentage text')}}</label>
                                <input type="text" class="form-control" name="home2_percentage_text" value="{{ $about->translate(admin_lang(), 'home2_percentage_text') }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Short title')}}</label>
                                <input type="text" class="form-control" name="home2_short_title" value="{{ $about->home2_short_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Long Title')}}</label>
                                <input type="text" class="form-control" name="home2_long_title" value="{{ $about->translate(admin_lang(), 'home2_long_title') }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description one')}}</label>
                                <textarea name="home2_description1" class="form-control text-area-5"  cols="30" rows="10">{{ $about->translate(admin_lang(), 'home2_description1') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description two')}}</label>
                                <textarea name="home2_description2" class="form-control text-area-5"  cols="30" rows="10">{{ $about->translate(admin_lang(), 'home2_description2') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Item one')}}</label>
                                <input type="text" class="form-control" name="home2_item1" value="{{ $about->translate(admin_lang(), 'home2_item1') }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Item two')}}</label>
                                <input type="text" class="form-control" name="home2_item2" value="{{ $about->translate(admin_lang(), 'home2_item2') }}">
                            </div>

                            <button class="btn btn-primary">{{__('admin.Update')}}</button>

                        </form>

                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

@endsection
