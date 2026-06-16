@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Mobile App')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Mobile App')}}</h1>
          </div>

          @include('template-part.admin_lang_switcer')

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-mobile-app') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="lang_code"
                                    value="{{ request('lang_code') ?? admin_lang() }}">

                                    @if (admin_lang() === 'en')
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ ($mobile_app->image)? asset($mobile_app->image) : asset($setting->default_placeholder)}}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>

                                    @endif


                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="app_full_title" class="form-control" value="{{ $mobile_app->full_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="app_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $mobile_app->description }}</textarea>
                                    </div>

                                    @if (admin_lang() === 'en')
                                    <div class="form-group">
                                        <label for="">{{__('admin.Google Play Store Link')}}</label>
                                        <input type="text" name="play_store" class="form-control" value="{{ $mobile_app->play_store }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.App Store Link')}}</label>
                                        <input type="text" name="app_store" class="form-control" value="{{ $mobile_app->app_store }}">
                                    </div>

                                    @endauth

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Apple button text')}}</label>
                                                <input type="text" name="apple_btn_text1" class="form-control" value="{{ $mobile_app->apple_btn_text1 }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Apple button text')}}</label>
                                                <input type="text" name="apple_btn_text2" class="form-control" value="{{ $mobile_app->apple_btn_text2 }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Google button text')}}</label>
                                                <input type="text" name="google_btn_text1" class="form-control" value="{{ $mobile_app->google_btn_text1 }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('admin.Google button text')}}</label>
                                                <input type="text" name="google_btn_text2" class="form-control" value="{{ $mobile_app->google_btn_text2 }}">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
@endsection
