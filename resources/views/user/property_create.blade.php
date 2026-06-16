
@extends('layout')
@section('title')
    <title>{{__('user.Create Property')}}</title>
@endsection

@section('meta')
    <meta name="description" content="{{__('user.Create Property')}}">
    <meta name="title" content="{{__('user.Create Property')}}">
@endsection

@section('frontend-content')
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                            <li class="active"><a href="{{ route('user.dashboard') }}">{{__('user.Dashboard')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Create Property')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <div id="hidden-location-box" class="d-none">
        <div class="delete-dynamic-location">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Form Element -->
                    <div class="mg-top-20">
                        <h4 class="homec-submit-form__heading">{{__('user.Nearest Location')}}</h4>
                        <div class="form-group homec-form-input">
                            <select name="nearest_locations[]" class="homec-form-select homec-border">
                                <option value="">{{__('user.Select')}}</option>
                                @foreach ($nearest_locations as $nearest_location)
                                    <option value="{{ $nearest_location->id }}">{{ $nearest_location->location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Form Element -->
                    <div class="mg-top-20">
                        <h4 class="homec-submit-form__heading">{{__('user.Distance(km)')}}</h4>
                        <div class="form-group homec-form-input homec-form-add">
                            <input type="text" name="distances[]" autocomplete="off">
                            <button type="button" class="homec-form-add__button homec-form-add__button--delete removeNearestPlaceRow"><img src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hidden-addition-box" class="d-none">
        <div class="delete-dynamic-additio">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Form Element -->
                    <div class="mg-top-20">
                        <h4 class="homec-submit-form__heading">{{__('user.Key')}}</h4>
                        <div class="form-group homec-form-input">
                            <input type="text" name="add_keys[]" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Form Element -->
                    <div class="mg-top-20">
                        <h4 class="homec-submit-form__heading">{{__('user.Value')}}</h4>
                        <div class="form-group homec-form-input homec-form-add">
                            <input type="text" name="add_values[]" autocomplete="off">
                            <button type="button" class="homec-form-add__button homec-form-add__button--delete removeAdditioanRow"><img src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hidden-plan-box" class="d-none">
        <div class="delete-dynamic-plan">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="mg-top-30">
                        <p class="homec-img-video-label mg-btm-10">{{__('user.Image')}}</p>
                        <!-- Image Input -->
                        <div class="homec-image-video-upload homec-border">
                            <input type="file" class="btn-check" name="plan_images[]">
                            <label class="homec-image-video-upload__label plan-video-id" >
                                <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                <span class="homec-image-video-upload__title">{{__('user.Please')}} <span class="homec-primary-color">{{__('user.Choose File')}}</span> {{__('user.to upload')}} </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Form Element -->
                    <div class="mg-top-30">
                        <h4 class="homec-submit-form__heading">{{__('user.Title')}} </h4>
                        <div class="form-group homec-form-input">
                            <input type="text" name="plan_titles[]">
                        </div>
                    </div>
                    <!-- Single Form Element -->
                    <div class="mg-top-30">
                        <h4 class="homec-submit-form__heading">{{__('user.Description')}}</h4>
                        <div class="form-group homec-form-input homec-form-add">
                            <textarea name="plan_descriptions[]"></textarea>
                            <button type="button" class="homec-form-add__button homec-form-add__button--delete removePlanRow"><img src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pd-top-80 pd-btm-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('user.property.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="homec-submit-form">
                            <h4 class="homec-submit-form__title">{{__('user.Basic Information')}}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Title')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="title" id="title" value="{{ old('title') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Slug')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Property Type')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <select class="homec-form-select homec-border" name="property_type_id">
                                                    <option value="">{{__('user.Select')}}</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="purpose" value="{{ $request_purpose }}">

                                    @if ($request_purpose == 'rent')
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.Rent Period')}} *</h4>
                                                <div class="form-group homec-form-input">
                                                    <select name="rent_period" class="homec-form-select homec-border">
                                                        <option value="daily">{{__('user.Daily')}}</option>
                                                        <option value="monthly">{{__('user.Monthly')}}</option>
                                                        <option value="yearly">{{__('user.Yearly')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Price')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="price" value="{{ old('price') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                         <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Total Area(m2)')}} </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="total_area" value="{{ old('total_area') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Total Unit')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="number"  name="total_unit" value="{{ old('total_unit') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Total Bedroom')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="number" name="total_bedroom" value="{{ old('total_bedroom') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Total Bathroom')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="number" name="total_bathroom" value="{{ old('total_bathroom') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Total Garage')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="number" name="total_garage" value="{{ old('total_garage') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Total Kitchen')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="number" name="total_kitchen" value="{{ old('total_kitchen') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Form Element -->
                                <div class="mg-top-20">
                                    <h4 class="homec-submit-form__heading">{{__('user.Description')}} *</h4>
                                    <div class="form-group homec-form-input">
                                        <textarea name="description" id="ckdesc1" class="summernote">{{ html_decode(old('description')) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="homec-submit-form mg-top-40">
                                <h4 class="homec-submit-form__title">{{ __('user.Property Image') }}</h4>
                                <div class="homec-submit-form__inner">

                                    <input id="slider_image_hideden_id" type="file" class="d-none"
                                        name="slider_images[]" multiple>

                                    <div class="row slider-images-row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mg-top-20">
                                                <div class="homec-submit-form__upload mg-btm-10">
                                                    <p class="homec-img-video-label">{{ __('user.Slider Image') }}</span>
                                                    </p>
                                                    <div class="homec-submit-form__upload-btn">
                                                        <button id="slider_image_hideden_btn" type="button"
                                                            class="homec-btn homec-btn--upload"><span>{{ __('user.Upload New Image') }}</span>

                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- Image Input -->
                                                <div class="homec-upload-images">
                                                    <div class="row">
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mg-top-20">
                                                <p class="homec-img-video-label mg-btm-10">
                                                    {{ __('user.Thumbnail Image') }}</p>
                                                <!-- Image Input -->
                                                <div class="homec-image-video-upload homec-border homec-bg-cover' : '' }}"
                                                    >
                                                    <div class="homec-overlay homec-overlay--img-video"></div>
                                                    <input type="file" class="btn-check" name="thumbnail_image"
                                                        id="input-video121">
                                                    <label class="homec-image-video-upload__label" for="input-video121">
                                                        <img src="{{ asset('frontend/img/upload-file-2.svg') }}"
                                                            alt="#">
                                                        <span
                                                            class="homec-image-video-upload__title homec-image-video-upload__title--v2">{{ __('user.Please') }}
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

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{__('user.Property Video')}}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mg-top-20">
                                            <p class="homec-img-video-label mg-btm-10">{{__('user.Video Thumbnail Image')}} </p>
                                            <!-- Image Input -->
                                            <div class="homec-image-video-upload homec-border">
                                                <input type="file" class="btn-check" name="video_thumbnail" id="input-video13">
                                                <label class="homec-image-video-upload__label" for="input-video13">
                                                    <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                                    <span class="homec-image-video-upload__title">{{__('user.Please')}} <span class="homec-primary-color">{{__('user.Choose File')}}</span> {{__('user.to upload')}} </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Youtube video id')}} </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="video_id">
                                            </div>
                                        </div>
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Video description')}}</h4>
                                            <div class="form-group homec-form-input">
                                                <textarea name="video_description">{{ old('video_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{__('user.Property Location')}}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Country')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <select  name="country_id" class="homec-form-select homec-border select2" id="country_id">
                                                    <option value="">{{__('user.Select')}}</option>
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.City')}} *</h4>
                                            <div class="form-group homec-form-input" id="country_selector">
                                                <select  name="city_id" class="homec-form-select homec-border select2">
                                                    <option value="">{{__('user.Select')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Address')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="address" id="address" required>
                                                <ul id="results-list"></ul> <!-- Results list -->
                                            </div>
                                        </div>
                                    </div>

                                    @if($setting->live_map == 'yes')
                                        <div class="col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.Map')}} *</h4>
                                                <div id="map">

                                                </div>
                                                <input type="hidden" id="lat" name="lat" value="">
                                                <input type="hidden" id="lng" name="lng" value="">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.Google Map')}} *</h4>
                                                <div class="form-group homec-form-input">
                                                    <textarea name="google_map">{{ old('google_map') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="{{$setting->live_map == 'yes' ? 'col-12' : 'col-lg-6 col-md-6 col-12'}}">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Address Details')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <textarea name="address_description">{{ old('address_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{__('user.Aminities')}}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="form-group homec-form-input--list">
                                    @foreach ($aminities as $aminity)
                                        <div class="form-group homec-form-checkbox mg-top-15">
                                            <input type="checkbox" id="item1-{{ $aminity->id }}" name="aminities[]" value="{{ $aminity->id }}">
                                            <label style="color:#000;" class="homec-form-label" for="item1-{{ $aminity->id }}">{{ $aminity->aminity }}</label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{__('user.Nearest Location')}}</h4>
                            <div class="homec-submit-form__inner" id="nearest-place-box">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Nearest Location')}}</h4>
                                            <div class="form-group homec-form-input">
                                                <select name="nearest_locations[]" class="homec-form-select homec-border">
                                                    <option value="">{{__('user.Select')}}</option>
                                                    @foreach ($nearest_locations as $nearest_location)
                                                        <option value="{{ $nearest_location->id }}">{{ $nearest_location->location }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Distance(km)')}}</h4>
                                            <div class="form-group homec-form-input homec-form-add">
                                                <input type="text" name="distances[]" autocomplete="off">
                                                <button id="addNearestPlaceRow" type="button" class="homec-form-add__button"><img src="{{ asset('frontend/img/plus-icon.svg') }}"></button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{__('user.Additional Information')}}</h4>
                            <div class="homec-submit-form__inner" id="additional-box">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Key')}}</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="add_keys[]" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Value')}}</h4>
                                            <div class="form-group homec-form-input homec-form-add">
                                                <input type="text" name="add_values[]" autocomplete="off">
                                                <button id="addAdditionalRow" type="button" class="homec-form-add__button"><img src="{{ asset('frontend/img/plus-icon.svg') }}"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{__('user.Property Plan')}}</h4>
                            <div class="homec-submit-form__inner" id="plan-box">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mg-top-30">
                                            <p class="homec-img-video-label mg-btm-10">{{__('user.Image')}}</p>
                                            <!-- Image Input -->
                                            <div class="homec-image-video-upload homec-border">
                                                <input type="file" class="btn-check" name="plan_images[]" >
                                                <label class="homec-image-video-upload__label plan-video-id">
                                                    <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                                    <span class="homec-image-video-upload__title">{{__('user.Please')}} <span class="homec-primary-color">{{__('user.Choose File')}}</span> {{__('user.to upload')}} </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-30">
                                            <h4 class="homec-submit-form__heading">{{__('user.Title')}} </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="plan_titles[]">
                                            </div>
                                        </div>
                                        <!-- Single Form Element -->
                                        <div class="mg-top-30">
                                            <h4 class="homec-submit-form__heading">{{__('user.Description')}}</h4>
                                            <div class="form-group homec-form-input homec-form-add">
                                                <textarea name="plan_descriptions[]"></textarea>
                                                <button id="addNewPlan" type="button" class="homec-form-add__button"><img src="{{ asset('frontend/img/plus-icon.svg') }}"></button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{__('user.SEO Information')}}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.SEO Title')}}</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="seo_title" value="{{ old('seo_title') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.SEO Meta Description')}}</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="seo_meta_description" value="{{ old('seo_meta_description') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end mg-top-40">
                                <button type="submit" class="homec-btn homec-btn__second"><span>{{__('user.Submit Property')}}</span></button>
                            </div>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </section>

    <!-- Download App -->
    <section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15" style="background-image:url({{ asset($mobile_app->app_bg) }})">
        <div class="homec-shape">
            <div class="homec-shape-single homec-shape-11"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
            <div class="homec-shape-single homec-shape-12"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
            <div class="homec-shape-single homec-shape-13"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="download-app__middle">
                        <div class="download-app__content">
                            <div class="homec-section__head section-white mg-btm-30" data-aos="fade-up" data-aos-delay="400">
                                <h2 class="homec-section__title">{{ $mobile_app->full_title }}</h2>
                                <p class="sec-head__text">{{ $mobile_app->description }}</p>
                            </div>
                            <!-- App Download Button -->
                            <div class="download__app-button" data-aos="fade-up" data-aos-delay="500">
                                <a href="{{ $mobile_app->app_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-apple"></i>
                                        <div class="btn-content"><span>{{ $mobile_app->apple_btn_text1 }}</span><p>{{ $mobile_app->apple_btn_text2 }}</p></div>
                                    </div>
                                </a>
                                <a href="{{ $mobile_app->play_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-google-play"></i>
                                        <div class="btn-content"><span>{{ $mobile_app->google_btn_text1 }}</span><p>{{ $mobile_app->google_btn_text2 }}</p></div>
                                    </div>
                                </a>
                            </div>
                            <!-- End App Download Button -->
                        </div>
                        <!-- Download Image -->
                        <div class="download-app__img" data-aos="fade-up" data-aos-delay="700">
                            <img src="{{ ($mobile_app->image)? asset($mobile_app->image) : asset($setting->default_placeholder)}}" alt="mobile_app">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Download App -->


    <script>

        

        function deleteCookie(cookieName) {
            document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }

        window.addEventListener('beforeunload', function (e) {
            deleteCookie('uploadedsliderImages');
        });


        window.addEventListener('popstate', function () {
            deleteCookie('uploadedsliderImages');
        });

        (function($) {
        "use strict";
        $(document).ready(function () {
            

            // Set background image on single file upload
            $('.homec-image-video-upload input[type="file"]').on('change', function (e) {
                let thatFile = $(this),
                    fileInput = thatFile[0];

                if (fileInput.files && fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            // Set background image
                            thatFile.closest('.homec-bg-cover, .homec-image-video-upload')
                                .css('background-image', `url(${event.target.result})`)
                                .addClass('active-bg');
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            // Helper function to set a cookie
            function setCookie(name, value, days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                const expires = "expires=" + date.toUTCString();
                document.cookie = name + "=" + encodeURIComponent(JSON.stringify(value)) + ";" + expires + ";path=/";
            }

            // Helper function to get a cookie
            function getCookie(name) {
                const decodedCookie = decodeURIComponent(document.cookie);
                const cookies = decodedCookie.split(';');
                for (let i = 0; i < cookies.length; i++) {
                    let cookie = cookies[i].trim();
                    if (cookie.indexOf(name + "=") === 0) {
                        return JSON.parse(cookie.substring(name.length + 1));
                    }
                }
                return [];
            }

            // Helper function to delete a cookie
            function deleteCookie(name) {
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/";
            }

            // Retrieve existing files from cookies
            var storedFiles = getCookie('uploadedsliderImages');

            // Function to initialize the file input with stored files
            function fileDataUpload() {
                const dataTransfer = new DataTransfer();

                // Add all stored files to the DataTransfer object
                storedFiles.forEach((fileData) => {
                    const byteCharacters = atob(fileData.src.split(',')[1]); // Decode base64
                    const byteArrays = [];
                    for (let offset = 0; offset < byteCharacters.length; offset++) {
                        byteArrays.push(byteCharacters.charCodeAt(offset));
                    }
                    const file = new Blob([new Uint8Array(byteArrays)], { type: fileData.type });
                    dataTransfer.items.add(new File([file], fileData.name));
                });

                // Update the hidden file input
                $('#slider_image_hideden_id')[0].files = dataTransfer.files;
            }

            const deleteIconUrl = "{{ asset('frontend/img/delete-icon.svg') }}";
            const editIconUrl = "{{ asset('frontend/img/edit-icon.svg') }}";

            // Display previously stored images and initialize file input
            $(document).ready(function () {
                const imageContainer = $('#slider_image_hideden_id').next('.slider-images-row').find('.homec-upload-images .row');

                // Display stored images
                storedFiles.forEach((file) => {
                    imageContainer.append(`
                        <div class="col-lg-4 col-md-4 col-12 image-box">
                            <div class="homec-upload-images__single">
                                <img src="${event.target.result}" alt="Uploaded Image">
                                <button class="homec-upload-images__single--edit remove_existing_image" data-file-name="${file.name}">
                                    <img src="${deleteIconUrl}" alt="Delete">
                                </button>
                                <button class="homec-upload-images__single--replace replace_existing_image" data-file-name="${file.name}">
                                    <img src="${editIconUrl}" alt="Edit">
                                </button>
                            </div>
                        </div>
                    `);
                });

                // Initialize the file input with stored files
                fileDataUpload();
            });

            // Handle new file uploads
            $('#slider_image_hideden_id').on('change', function () {
                const fileInput = $(this)[0];
                const imageContainer = $(this).next('.slider-images-row').find('.homec-upload-images .row');
                console.log(storedFiles);
                if (fileInput.files && fileInput.files.length > 0) {
                    Array.from(fileInput.files).forEach((file) => {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();

                            reader.onload = function (event) {
                                const fileData = {
                                    name: file.name,
                                    src: event.target.result, // Base64 string
                                    type: file.type,
                                };

                                // Add the new file to the stored files list
                                storedFiles.push(fileData);

                                // Save updated files to cookies
                                setCookie('uploadedsliderImages', storedFiles, 7);

                                // Append the new image preview
                                imageContainer.append(`
                                    <div class="col-lg-4 col-md-4 col-12 image-box">
                                        <div class="homec-upload-images__single">
                                            <img src="${event.target.result}" alt="Uploaded Image">
                                            <button class="homec-upload-images__single--edit remove_existing_image" data-file-name="${file.name}">
                                                <img src="${deleteIconUrl}" alt="Delete">
                                            </button>
                                            <button class="homec-upload-images__single--replace replace_existing_image" data-file-name="${file.name}">
                                                <img src="${editIconUrl}" alt="Edit">
                                            </button>
                                        </div>
                                    </div>
                                `);

                                // Rebuild the file input with all files
                                fileDataUpload();
                            };

                            reader.readAsDataURL(file);
                        }
                    });
                }
            });

            // Handle image removal
            $(document).on('click', '.remove_existing_image', function () {
                const fileName = $(this).data('file-name');

                // Remove the file from the stored files array
                storedFiles = storedFiles.filter(file => file.name !== fileName);

                // Update cookies
                setCookie('uploadedsliderImages', storedFiles, 7);

                // Remove the image preview
                $(this).closest('.image-box').remove();

                // Rebuild the file input with remaining files
                fileDataUpload();
            });


            $(document).on('click', '.replace_existing_image', function (e) {
                e.preventDefault();
                const fileName = $(this).data('file-name'); // Get the file name of the image to replace
                const replaceButton = $(this);
                
                // Create a temporary file input for image replacement
                const fileInput = $('<input type="file" class="" accept="image/*" style="display: none;">');
                
                // Handle file selection
                fileInput.on('change', function () {
                    const newFile = this.files[0];
                    console.log('asdad');
                    if (newFile && newFile.type.startsWith('image/')) {
                        const reader = new FileReader();

                        reader.onload = function (event) {
                            const newFileData = {
                                name: newFile.name,
                                src: event.target.result, // Base64 string
                                type: newFile.type,
                            };

                            // Replace the file in the stored files array
                            const fileIndex = storedFiles.findIndex(file => file.name === fileName);
                            if (fileIndex !== -1) {
                                storedFiles[fileIndex] = newFileData;
                            }

                            // Update cookies
                            setCookie('uploadedsliderImages', storedFiles, 7);
                            console.log(newFileData.src);
                            // Update the image preview
                            const imageBox = replaceButton.closest('.image-box');
                            imageBox.find('img').first().attr('src', newFileData.src);

                            // Rebuild the file input with updated files
                            fileDataUpload();
                        };

                        reader.readAsDataURL(newFile);
                        fileInput.remove();
                    }
                });

                // Append the hidden file input to the body and trigger the file dialog
                $('body').append(fileInput);
                fileInput.click();
                 // Clean up after use
            });





            $("#slider_image_hideden_btn").on("click", function() {
                $('#slider_image_hideden_id').click();
            });

            // slug generate and check

            $("#title").on("keyup",function(e){
                let slug = convertToSlug($(this).val());
                $("#slug").val(slug);

                $.ajax({
                    type:"get",
                    url:"{{url('/admin/check-slug/')}}"+"/"+slug,
                    success:function(response){

                    },
                    error:function(err){
                        if(err.status == 403){
                            toastr.error(err.responseJSON.message);
                            $("#slug").val('');
                        }
                    }
                })
            })

            // slug generate and check

            //start dynamic nearest place add and remove

            $("#addNearestPlaceRow").on("click",function(){
                var new_row=$("#hidden-location-box").html();
                $("#nearest-place-box").append(new_row)
            })

            $(document).on('click', '.removeNearestPlaceRow', function () {
                $(this).closest('.delete-dynamic-location').remove();
            });

            //end dynamic nearest place add and remove

            //start additonal information add and remove

            $("#addAdditionalRow").on("click",function(){
                var new_row=$("#hidden-addition-box").html();
                $("#additional-box").append(new_row)
            })

            $(document).on('click', '.removeAdditioanRow', function () {
                $(this).closest('.delete-dynamic-additio').remove();
            });

            //end additonal information add and remove

            //start dynamic plan add and remove

            $("#addNewPlan").on("click",function(){
                var new_row=$("#hidden-plan-box").html();
                $("#plan-box").append(new_row)
            })

            $(document).on('click', '.removePlanRow', function () {
                $(this).closest('.delete-dynamic-plan').remove();
            });

            //end dynamic plan  add and remove

            // load plan image

            $(document).on('click', '.plan-video-id', function () {
                $(this).siblings('input[type="file"]').click();
            });

            // load plan image

        });

        })(jQuery);

        function convertToSlug(Text)
            {
                return Text
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-');
            }

        $("#country_id").change(function (){
            let id = this.value;
            let route = "{{ url('/user/property/city/list/') }}/" + id;
            ajax_switch_country(route)
        });

        function ajax_switch_country(route) {
            $.get({
                url: route,
                dataType: 'json',
                data: {},
                beforeSend: function () {
                },
                success: function (response) {
                    $('#country_selector').html(response.template);
                },
                complete: function () {
                },
            });
        }

        var map = L.map('map').setView([23.822350, 90.365417], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var currentMarker;

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            // Update hidden input fields
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

            // Update or create the marker
            if (currentMarker) {
                map.removeLayer(currentMarker); // Remove existing marker
            }
            currentMarker = L.marker([lat, lng]).addTo(map); // Add new marker

            // Fetch the address from the clicked coordinates
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        document.getElementById('address').value = data.display_name; // Set the address input
                    } else {
                        document.getElementById('address').value = "Clicked Location"; // Fallback text
                    }
                });
        });


        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                const context = this;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), delay);
            };
        }

        // Wait for the DOM to fully load
        document.addEventListener('DOMContentLoaded', function() {
            const addressInput = document.getElementById('address');
            const resultsElement = document.getElementById('results-list');

            if (addressInput) {
                addressInput.addEventListener(
                    'keyup',
                    debounce(function () {
                        const keyword = this.value;

                        if (keyword.length > 3) {
                            const xhr = new XMLHttpRequest();
                            const url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(keyword);
                            xhr.open('GET', url, true);
                            xhr.onload = function () {
                                if (xhr.status >= 200 && xhr.status < 400) {
                                    const data = JSON.parse(xhr.responseText);
                                    resultsElement.innerHTML = '';
                                    if (data.length > 0) {
                                        let resultsHTML = '';
                                        data.forEach(function (v) {
                                            resultsHTML += `<li data-lat="${v.lat}" data-lon="${v.lon}">${v.display_name}</li>`;
                                        });
                                        resultsElement.innerHTML = resultsHTML;
                                        resultsElement.style.display = 'block';

                                        resultsElement.addEventListener('click', function (event) {
                                            if (event.target.tagName.toLowerCase() === 'li') {
                                                const thatItem = event.target;
                                                const getLat = thatItem.getAttribute('data-lat');
                                                const getLon = thatItem.getAttribute('data-lon');
                                                const displayName = thatItem.textContent;

                                                // Update input values
                                                addressInput.value = displayName;
                                                document.getElementById('lat').value = getLat;
                                                document.getElementById('lng').value = getLon;

                                                // Set the map view to the selected coordinates
                                                map.setView([getLat, getLon], 13);

                                                // Update or create the marker
                                                if (currentMarker) {
                                                    map.removeLayer(currentMarker); // Remove existing marker
                                                }
                                                currentMarker = L.marker([getLat, getLon]).addTo(map); // Add new marker

                                                resultsElement.style.display = 'none'; // Hide results
                                            }
                                        });
                                    } else {
                                        resultsElement.style.display = 'none'; // No results found
                                    }
                                }
                            };
                            xhr.send();
                        } else {
                            resultsElement.style.display = 'none'; // Hide results if input is too short
                        }
                    }, 500) // 500ms debounce
                );

                // Hide results when clicking outside
                document.addEventListener('click', function (event) {
                    if (!addressInput.contains(event.target) && !resultsElement.contains(event.target)) {
                        resultsElement.style.display = 'none';
                    }
                });
            }
        });
    </script>

@endsection
