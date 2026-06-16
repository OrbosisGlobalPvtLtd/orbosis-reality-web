@extends('layout')

@section('title')
    <title>{{ __('user.Create Company/Team') }}</title>
@endsection

@section('meta')
    <meta name="title" content="{{ __('user.Create Company/Team') }}">
    <meta name="description" content="{{ __('user.Create Company/Team') }}">
@endsection

@section('frontend-content')
    <!-- Breadcrumbs -->
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
        <!-- <div class="homec-overlay"></div> -->
        <div class="container">
            <div class="row">
                <!-- Breadcrumb-Content -->
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{ __('user.Home') }}</a></li>
                            <li class="active"><a
                                    href="{{ route('user.my-company') }}">{{ __('user.Create Company/Team') }}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{ __('user.Create Company/Team') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <!-- Homec Dashboard -->
    <section class="homec-dashboard pd-top-100 pd-btm-100 homec-bg-third-color">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('user.apply-company') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="homec-submit-form">
                                    <h4 class="homec-submit-form__title">{{ __('user.Company Information') }}</h4>
                                    <div class="homec-submit-form__inner">
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Single Form Element -->
                                                <div class="mg-top-20">
                                                    <h4 class="homec-submit-form__heading">{{ __('user.Company Name') }}*
                                                    </h4>
                                                    <div class="form-group homec-form-input">
                                                        <input type="text" placeholder="Name"
                                                            value="{{ old('name') }}" name="name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <!-- Single Form Element -->
                                                <div class="mg-top-20">
                                                    <h4 class="homec-submit-form__heading">
                                                        {{ __('user.Company Tag Line') }}*</h4>
                                                    <div class="form-group homec-form-input">
                                                        <input type="text" placeholder="Real State Company"
                                                            name="tag_line" value="{{ old('tag_line') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.About Us') }}*</h4>
                                            <div class="form-group homec-form-input">
                                                <textarea rows="3" name="about_us" placeholder="This is best agency">{{ old('about_us') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="homec-submit-form">
                                    <h4 class="homec-submit-form__title">{{ __('user.Company Logo') }}</h4>
                                    <div class="homec-submit-form__inner">
                                        <div class="row">
                                            <div class="mg-top-20">
                                                <p class="homec-img-video-label mg-btm-10">{{ __('user.Image') }}*</span>
                                                </p>
                                                <!-- Image Input -->
                                                <div class="homec-image-video-upload homec-border">
                                                    <input type="file" class="btn-check" id="input-video1"
                                                        name="image">
                                                    <label class="homec-image-video-upload__label" for="input-video1">
                                                        <img src="{{ asset('frontend/img/upload-file.svg') }}"
                                                            alt="#">
                                                        <span
                                                            class="homec-image-video-upload__title">{{ __('user.Please') }}
                                                            <span
                                                                class="homec-primary-color">{{ __('user.Choose File') }}</span>
                                                            {{ __('user.to upload') }} </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{ __('user.Contact Info') }}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Email address') }}* </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="email" placeholder="examplce@example.com" name="email"
                                                    value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading"> {{ __('user.Phone number') }}* </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="tel" placeholder="+880123456" name="phone"
                                                    value="{{ old('phone') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Facebook') }} </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" placeholder="www.facebook.com" name="facebook"
                                                    value="{{ old('facebook') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Instagram') }} </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" placeholder="www.instagram.com" name="instagram"
                                                    value="{{ old('instagram') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Twitter') }} </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" placeholder="www.twitter.com" name="twitter"
                                                    value="{{ old('twitter') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Linkedin') }} </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" placeholder="www.linkedin.com" name="linkedin"
                                                    value="{{ old('linkedin') }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{ __('user.Company Location') }}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="row">

                                    <div class="col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Address') }}*</h4>
                                            <div class="form-group homec-form-input">
                                                <textarea rows="3" name="address" placeholder="Usa, Calefornia">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{ __('user.Company Document') }}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="row">

                                    <div class="col-12 mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('admin.Select Document Type')}} *</h4>
                                        <div class="form-group homec-form-input">
                                            <select name="kyc_id" class="homec-form-select homec-border">

                                                <option value="">{{__('admin.Select Type')}}</option>

                                                @foreach ($kycType as $type)
                                                    <option {{ $type->id == old('kyc_id') ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 pt-2">
                                        <div class="form-group homec-form-input">
                                            <label class="ecom-wc__form-label mg-btm-10">{{__('admin.File')}} *</label>
                                            <div class="form-group__input">
                                                <input class="ecom-wc__form-input pt-2" type="file" name="file">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 pt-2">
                                        <div class="form-group homec-form-input">
                                            <label class="ecom-wc__form-label mg-btm-10">{{__('admin.Message')}}*</label>
                                            <div class="form-group__input">
                                                <textarea class="ecom-wc__form-input" type="text" name="message"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row h-b-t">
                            <div class="col-12  d-flex justify-content-end p-0">
                                <button type="submit"
                                    class="homec-btn homec-btn__second"><span>{{ __('user.Submit') }}</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Dashboard -->
@endsection
