@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Mobile App Setting')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Mobile App Setting')}}</h1>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">

                        <form action="{{ route('admin.update-mobile-app-setting') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <h5 class="dashboard_title">{{__('admin.Onboarding screen one')}}</h5>
                            <hr>

                            <div class="form-group">
                                <label for="">{{__('admin.Icon')}}</label>
                                <div>
                                    <img width="200px" src="{{ asset($mobile_app->onboarding_one_icon) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Icon')}}</label>
                                <input type="file" name="onboarding_one_icon" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="onboarding_one_title" class="form-control" value="{{ $mobile_app->onboarding_one_title }}" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="onboarding_one_description" class="form-control" value="{{ $mobile_app->onboarding_one_description }}" required>
                            </div>


                            <h5 class="dashboard_title">{{__('admin.Onboarding screen two')}}</h5>
                            <hr>

                            <div class="form-group">
                                <label for="">{{__('admin.Icon')}}</label>
                                <div>
                                    <img width="200px" src="{{ asset($mobile_app->onboarding_two_icon) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Icon')}}</label>
                                <input type="file" name="onboarding_two_icon" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="onboarding_two_title" class="form-control" value="{{ $mobile_app->onboarding_two_title }}" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="onboarding_two_description" class="form-control" value="{{ $mobile_app->onboarding_two_description }}" required>
                            </div>


                            <h5 class="dashboard_title">{{__('admin.Onboarding screen three')}}</h5>
                            <hr>

                            <div class="form-group">
                                <label for="">{{__('admin.Icon')}}</label>
                                <div>
                                    <img width="200px" src="{{ asset($mobile_app->onboarding_three_icon) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Icon')}}</label>
                                <input type="file" name="onboarding_three_icon" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="onboarding_three_title" class="form-control" value="{{ $mobile_app->onboarding_three_title }}" required>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="onboarding_three_description" class="form-control" value="{{ $mobile_app->onboarding_three_description }}" required>
                            </div>







                            <div class="form-group">
                                <label for="">{{__('admin.Login Background')}}</label>
                                <div>
                                    <img class="h_300"  src="{{ asset($mobile_app->login_bg_image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New background')}}</label>
                                <input type="file" name="login_bg_image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Logo')}}</label>
                                <div>
                                    <img  src="{{ asset($mobile_app->login_page_logo) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Logo')}}</label>
                                <input type="file" name="login_page_logo" class="form-control-file">
                            </div>

                            {{-- <div class="form-group">
                                <label for="">{{__('admin.Experience text')}}</label>
                                <input type="text" class="form-control" name="experience_text_1" value="{{ $about->experience_text_1 }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Experience text')}}</label>
                                <input type="text" class="form-control" name="experience_text_2" value="{{ $about->experience_text_2 }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Author Image')}}</label>
                                <div>
                                    <img class="w_220"  src="{{ asset($about->author_image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Image')}}</label>
                                <input type="file" name="author_image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Author name')}}</label>
                                <input type="text" class="form-control" name="author_name" value="{{ $about->author_name }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Author designation')}}</label>
                                <input type="text" class="form-control" name="author_designation" value="{{ $about->author_designation }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Short title')}}</label>
                                <input type="text" class="form-control" name="short_title" value="{{ $about->short_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Long Title')}}</label>
                                <input type="text" class="form-control" name="long_title" value="{{ $about->long_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description one')}}</label>
                                <textarea name="description_1" class="form-control text-area-5"  cols="30" rows="10">{{ $about->description_1 }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description two')}}</label>
                                <textarea name="description_2" class="form-control text-area-5"  cols="30" rows="10">{{ $about->description_2 }}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="">{{__('admin.Item one icon')}}</label>

                                <div>
                                    <img src="{{ asset($about->item1_icon) }}" alt="" class="w_80">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New icon')}}</label>
                                <input type="file" class="form-control-file" name="item1_icon">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Item one number')}}</label>
                                        <input type="text" class="form-control" name="item1_title" value="{{ $about->item1_title }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Item one title')}}</label>
                                        <input type="text" class="form-control" name="item1_title2" value="{{ $about->item1_title2 }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Item one description')}}</label>
                                <input type="text" class="form-control" name="item1_description" value="{{ $about->item1_description }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Item two icon')}}</label>

                                <div>
                                    <img src="{{ asset($about->item2_icon) }}" alt="" class="w_80">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New icon')}}</label>
                                <input type="file" class="form-control-file" name="item2_icon">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Item two number')}}</label>
                                        <input type="text" class="form-control" name="item2_title" value="{{ $about->item2_title }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Item two title')}}</label>
                                        <input type="text" class="form-control" name="item2_title2" value="{{ $about->item2_title2 }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Item two description')}}</label>
                                <input type="text" class="form-control" name="item2_description" value="{{ $about->item2_description }}">
                            </div> --}}

                            <button class="btn btn-primary">{{__('admin.Update')}}</button>

                        </form>

                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

@endsection
