@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Intro section')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Intro section')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Intro section')}}</div>
            </div>
          </div>

          @include('template-part.admin_lang_switcer')

          @if ($selected_theme == 0 || $selected_theme == 1)
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="lang_code" value="{{ admin_lang() }}">

                                    <div class="row">

                                        @if (admin_lang() === 'en')
                                        <div class="col-12">
                                            <h6 class="home_border">{{__('admin.Home One')}}</h6>
                                            <hr>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Existing Background')}}</label>
                                            <div>
                                                <img class="w_300" src="{{ ($slider->home1_bg)? asset($slider->home1_bg) : asset($setting->default_placeholder)}}" alt="">
                                            </div>
                                        </div>


                                        <div class="form-group col-12">
                                            <label>{{__('admin.New Image')}}</label>
                                            <input type="file" name="image" class="form-control-file">
                                        </div>

                                        @endif

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Title one')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home1_title_1" value="{{ $slider->home1_title_1 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Title two')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home1_title_2" value="{{ $slider->home1_title_2 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Title three')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home1_title_3" value="{{ $slider->home1_title_3 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Item one')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home1_item1" value="{{ $slider->home1_item1 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Item two')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home1_item2" value="{{ $slider->home1_item2 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Item three')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home1_item3" value="{{ $slider->home1_item3 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Button text')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home1_btn_text" value="{{ $slider->home1_btn_text }}" class="form-control">
                                        </div>

                                        <button class="btn btn-primary">{{__('admin.Update')}}</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endif

          @if ($selected_theme == 0 || $selected_theme == 2)
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.home2-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="lang_code" value="{{ admin_lang() }}">

                                    <div class="row">



                                        <div class="col-12">
                                            <h6 class="home_border">{{__('admin.Home two')}}</h6>
                                            <hr>
                                        </div>

                                        @if (admin_lang() === 'en')

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Existing Background')}}</label>
                                            <div>
                                                <img class="w_300" src="{{ ($slider->home2_bg)? asset($slider->home2_bg) : asset($setting->default_placeholder)}}" alt="">
                                            </div>
                                        </div>


                                        <div class="form-group col-12">
                                            <label>{{__('admin.New Image')}}</label>
                                            <input type="file" name="image" class="form-control-file">
                                        </div>

                                        @endif

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home2_title" value="{{ $slider->home2_title }}" class="form-control">
                                        </div>

                                        <button class="btn btn-primary">{{__('admin.Update')}}</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endif

          @if ($selected_theme == 0 || $selected_theme == 3)
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.home3-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="lang_code" value="{{ admin_lang() }}">

                                    <div class="row">

                                        @if (admin_lang() === 'en')
                                        <div class="col-12">
                                            <h6 class="home_border">{{__('admin.Home three')}}</h6>
                                            <hr>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Existing Background')}}</label>
                                            <div>
                                                <img class="w_300" src="{{ ($slider->home3_image)? asset($slider->home3_image) : asset($setting->default_placeholder)}}" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.New Image')}}</label>
                                            <input type="file" name="image" class="form-control-file">
                                        </div>

                                        @endif

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home3_title" value="{{ $slider->home3_title }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Item one')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home3_item1" value="{{ $slider->home3_item1 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Item two')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home3_item2" value="{{ $slider->home3_item2 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Item three')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home3_item3" value="{{ $slider->home3_item3 }}" class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.Button text')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="home3_btn_text" value="{{ $slider->home3_btn_text }}" class="form-control">
                                        </div>

                                        <button class="btn btn-primary">{{__('admin.Update')}}</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endif

        </section>
      </div>
@endsection
