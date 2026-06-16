@extends('layout')

@section('title')
    <title>{{ __('user.Edit Property') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('user.Edit Property') }}">
    <meta name="title" content="{{ __('user.Edit Property') }}">
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
                            <li class="active"><a href="{{ route('user.dashboard') }}">{{ __('user.Dashboard') }}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{ __('user.Edit Property') }}</h2>
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
                        <h4 class="homec-submit-form__heading">{{ __('user.Nearest Location') }}</h4>
                        <div class="form-group homec-form-input">
                            <select name="nearest_locations[]" class="homec-form-select homec-border">
                                <option value="">{{ __('user.Select') }}</option>
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
                        <h4 class="homec-submit-form__heading">{{ __('user.Distance(km)') }}</h4>
                        <div class="form-group homec-form-input homec-form-add">
                            <input type="text" name="distances[]" autocomplete="off">
                            <button type="button"
                                class="homec-form-add__button homec-form-add__button--delete removeNearestPlaceRow"><img
                                    src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
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
                        <h4 class="homec-submit-form__heading">{{ __('user.Key') }}</h4>
                        <div class="form-group homec-form-input">
                            <input type="text" name="add_keys[]" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Form Element -->
                    <div class="mg-top-20">
                        <h4 class="homec-submit-form__heading">{{ __('user.Value') }}</h4>
                        <div class="form-group homec-form-input homec-form-add">
                            <input type="text" name="add_values[]" autocomplete="off">
                            <button type="button"
                                class="homec-form-add__button homec-form-add__button--delete removeAdditioanRow"><img
                                    src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
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
                        <p class="homec-img-video-label mg-btm-10">{{ __('user.Image') }}</p>
                        <!-- Image Input -->
                        <div class="homec-image-video-upload homec-border">
                            <input type="file" class="btn-check" name="plan_images[]">
                            <label class="homec-image-video-upload__label plan-video-id">
                                <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                <span class="homec-image-video-upload__title">{{ __('user.Please') }} <span
                                        class="homec-primary-color">{{ __('user.Choose File') }}</span>
                                    {{ __('user.to upload') }} </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Form Element -->
                    <div class="mg-top-30">
                        <h4 class="homec-submit-form__heading">{{ __('user.Title') }} </h4>
                        <div class="form-group homec-form-input">
                            <input type="text" name="plan_titles[]">
                        </div>
                    </div>
                    <!-- Single Form Element -->
                    <div class="mg-top-30">
                        <h4 class="homec-submit-form__heading">{{ __('user.Description') }}</h4>
                        <div class="form-group homec-form-input homec-form-add">
                            <textarea name="plan_descriptions[]"></textarea>
                            <button type="button"
                                class="homec-form-add__button homec-form-add__button--delete removePlanRow"><img
                                    src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <section class="pd-top-80 pd-btm-80">
        <div class="container">
            @include('template-part.admin_lang_switcer')
            <div class="row mt-1">
                <div class="col-12">
                    <form action="{{ route('user.property.update', $property->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang_code" value="{{ front_lang() }}">
                        <div class="homec-submit-form">
                            <h4 class="homec-submit-form__title">{{ __('user.Basic Information') }}</h4>
                            <div class="homec-submit-form__inner">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Title') }} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="title" id="title"
                                                    value="{{ html_decode($property->title) }}">
                                            </div>
                                        </div>
                                    </div>

                                    @if (front_lang() === 'en')
                                        <div class="col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Slug') }} *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" name="slug" id="slug"
                                                        value="{{ html_decode($property->slug) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Property Type') }} *
                                                </h4>
                                                <div class="form-group homec-form-input">
                                                    <select class="homec-form-select homec-border"
                                                        name="property_type_id">
                                                        <option value="">{{ __('user.Select') }}</option>
                                                        @foreach ($types as $type)
                                                            <option
                                                                {{ $property->property_type_id == $type->id ? 'selected' : '' }}
                                                                value="{{ $type->id }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Purpose') }} *</h4>
                                                <div class="form-group homec-form-input">
                                                    <select class="homec-form-select homec-border" name="purpose"
                                                        id="purpose">
                                                        <option {{ $property->purpose == 'sale' ? 'selected' : '' }}
                                                            value="sale">{{ __('user.For Sale') }}</option>
                                                        <option {{ $property->purpose == 'rent' ? 'selected' : '' }}
                                                            value="rent">{{ __('user.For Rent') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($property->purpose == 'sale')
                                            <div class="col-lg-6 col-md-6 col-12 d-none" id="rend_period_box">
                                                <!-- Single Form Element -->
                                                <div class="mg-top-20">
                                                    <h4 class="homec-submit-form__heading">{{ __('user.Rent Period') }} *
                                                    </h4>
                                                    <div class="form-group homec-form-input">
                                                        <select name="rent_period" class="homec-form-select homec-border">
                                                            <option
                                                                {{ $property->rent_period == 'daily' ? 'selected' : '' }}
                                                                value="daily">{{ __('user.Daily') }}</option>
                                                            <option
                                                                {{ $property->rent_period == 'monthly' ? 'selected' : '' }}
                                                                value="monthly">{{ __('user.Monthly') }}</option>
                                                            <option
                                                                {{ $property->rent_period == 'yearly' ? 'selected' : '' }}
                                                                value="yearly">{{ __('user.Yearly') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->purpose == 'rent')
                                            <div class="col-lg-6 col-md-6 col-12" id="rend_period_box">
                                                <!-- Single Form Element -->
                                                <div class="mg-top-20">
                                                    <h4 class="homec-submit-form__heading">{{ __('user.Rent Period') }} *
                                                    </h4>
                                                    <div class="form-group homec-form-input">
                                                        <select name="rent_period" class="homec-form-select homec-border">
                                                            <option
                                                                {{ $property->rent_period == 'daily' ? 'selected' : '' }}
                                                                value="daily">{{ __('user.Daily') }}</option>
                                                            <option
                                                                {{ $property->rent_period == 'monthly' ? 'selected' : '' }}
                                                                value="monthly">{{ __('user.Monthly') }}</option>
                                                            <option
                                                                {{ $property->rent_period == 'yearly' ? 'selected' : '' }}
                                                                value="yearly">{{ __('user.Yearly') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Price') }} *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" name="price"
                                                        value="{{ html_decode($property->price) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Total Area(m2)') }}
                                                </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" name="total_area"
                                                        value="{{ html_decode($property->total_area) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Total Unit') }} *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="number" name="total_unit"
                                                        value="{{ $property->total_unit }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Total Bedroom') }} *
                                                </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="number" name="total_bedroom"
                                                        value="{{ $property->total_bedroom }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Total Bathroom') }} *
                                                </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="number" name="total_bathroom"
                                                        value="{{ $property->total_bathroom }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Total Garage') }} *
                                                </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="number" name="total_garage"
                                                        value="{{ $property->total_garage }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{ __('user.Total Kitchen') }} *
                                                </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="number" name="total_kitchen"
                                                        value="{{ $property->total_kitchen }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- Single Form Element -->
                                <div class="mg-top-20">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Description') }} *</h4>
                                    <div class="form-group homec-form-input">
                                        <textarea name="description" id="ckdesc1" class="summernote">{{ html_decode($property->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (front_lang() === 'en')
                            <div class="homec-submit-form mg-top-40">
                                <h4 class="homec-submit-form__title">{{ __('user.Property Image') }}</h4>
                                <div class="homec-submit-form__inner">

                                    <input id="slider_image_hideden_id" type="file" class="d-none"
                                        name="slider_images[]" multiple>

                                    <div class="row">
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
                                                        @foreach ($existing_sliders as $existing_slider)
                                                            <div class="col-lg-4 col-md-4 col-12 image-box">
                                                                <div class="homec-upload-images__single">
                                                                    <img src="{{ asset($existing_slider->image) }}">
                                                                    <button data-id="{{ $existing_slider->id }}"
                                                                        class="homec-upload-images__single--edit remove_existing_image"><img
                                                                            src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mg-top-20">
                                                <p class="homec-img-video-label mg-btm-10">
                                                    {{ __('user.Thumbnail Image') }}</p>
                                                <!-- Image Input -->
                                                <div class="homec-image-video-upload homec-border homec-bg-cover"
                                                    style="background-image: url({{ asset($property->thumbnail_image) }});">
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
                        @endif

                        <div class="homec-submit-form mg-top-40">
                            <h4 class="homec-submit-form__title">{{ __('user.Property Video') }}</h4>
                            <div class="homec-submit-form__inner">

                                <div class="row">
                                    @if (front_lang() === 'en')
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mg-top-20">
                                                <p class="homec-img-video-label mg-btm-10">
                                                    {{ __('user.Video Thumbnail Image') }}</p>
                                                <!-- Image Input -->
                                                <div class="homec-image-video-upload homec-border homec-bg-cover"
                                                    style="background-image: url({{ asset($property->video_thumbnail) }});">
                                                    <div class="homec-overlay homec-overlay--img-video"></div>
                                                    <input type="file" class="btn-check" name="video_thumbnail"
                                                        id="input-video1564">
                                                    <label class="homec-image-video-upload__label" for="input-video1564">
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
                                    @endif
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{ __('user.Video description') }}</h4>
                                        <div class="form-group homec-form-input">
                                            <textarea name="video_description">{{ html_decode($property->video_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @if (front_lang() === 'en')
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="mg-top-20">
                                            <p class="homec-img-video-label mg-btm-10">{{ __('user.Existing Video') }}</p>
                                            <!-- Image Input -->
                                            <div>
                                                <iframe width="300" height="150"
                                                    src="https://www.youtube.com/embed/{{ html_decode($property->video_id) }}">
                                                </iframe>
                                            </div>
                                        </div>
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Youtube video id') }} </h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="video_id"
                                                    value="{{ html_decode($property->video_id) }}">
                                            </div>
                                        </div>
                                @endif
                            </div>
                        </div>

                </div>
            </div>

            <div class="homec-submit-form mg-top-40">
                <h4 class="homec-submit-form__title">{{ __('user.Property Location') }}</h4>
                <div class="homec-submit-form__inner">
                    <div class="row">


                        @if (front_lang() === 'en')
                            <div class="col-lg-6 col-md-6">
                                <!-- Single Form Element -->
                                <div class="mg-top-20">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Country') }} *</h4>
                                    <div class="form-group homec-form-input">
                                        <select name="country_id" class="homec-form-select homec-border select2"
                                            id="country_id">
                                            <option value="">{{ __('user.Select') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ $property->country_id == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <!-- Single Form Element -->
                                <div class="mg-top-20">
                                    <h4 class="homec-submit-form__heading">{{ __('user.City') }} *</h4>
                                    <div class="form-group homec-form-input" id="country_selector">
                                        <select name="city_id" class="homec-form-select homec-border select2">
                                            <option value="">{{ __('user.Select') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{ __('user.Address') }} *</h4>
                                <div class="form-group homec-form-input">
                                    <input type="text" name="address" value="{{ html_decode($property->address) }}"
                                        id="address">
                                    <ul id="results-list"></ul> <!-- Results list -->
                                </div>
                            </div>
                        </div>
                        @if (front_lang() === 'en')
                            @if ($setting->live_map == 'yes')
                                <div class="col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{ __('user.Map') }} *</h4>
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
                                        <h4 class="homec-submit-form__heading">{{ __('user.Google Map') }} *</h4>
                                        <div class="form-group homec-form-input">
                                            <textarea name="google_map">{{ html_decode($property->google_map) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="{{ $setting->live_map == 'yes' ? 'col-12' : 'col-lg-6 col-md-6 col-12' }}">
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{ __('user.Address Details') }} *</h4>
                                <div class="form-group homec-form-input">
                                    <textarea name="address_description">{{ html_decode($property->address_description) }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if (front_lang() === 'en')
                <div class="homec-submit-form mg-top-40">
                    <h4 class="homec-submit-form__title">{{ __('user.Aminities') }}</h4>
                    <div class="homec-submit-form__inner">
                        <div class="form-group homec-form-input--list">
                            @foreach ($aminities as $aminity)
                                @php
                                    $is_checked = false;
                                @endphp
                                @foreach ($existing_properties as $amnty)
                                    @if ($aminity->id == $amnty->aminity_id)
                                        @php
                                            $is_checked = true;
                                        @endphp
                                    @endif
                                @endforeach

                                <div class="form-group homec-form-checkbox mg-top-15">
                                    <input {{ $is_checked ? 'checked' : '' }} type="checkbox"
                                        id="item1-{{ $aminity->id }}" name="aminities[]"
                                        value="{{ $aminity->id }}">
                                    <label class="homec-form-label"
                                        for="item1-{{ $aminity->id }}">{{ $aminity->aminity }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="homec-submit-form mg-top-40">
                    <h4 class="homec-submit-form__title">{{ __('user.Nearest Location') }}</h4>
                    <div class="homec-submit-form__inner" id="nearest-place-box">
                        @foreach ($existing_nearest_locations as $existing_nearest_location)
                            <div class="delete-dynamic-location">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Nearest Location') }}</h4>
                                            <div class="form-group homec-form-input">
                                                <select name="existing_nearest_locations[]"
                                                    class="homec-form-select homec-border">
                                                    <option value="">{{ __('user.Select') }}</option>
                                                    @foreach ($nearest_locations as $nearest_location)
                                                        <option
                                                            {{ $existing_nearest_location->nearest_location_id == $nearest_location->id ? 'selected' : '' }}
                                                            value="{{ $nearest_location->id }}">
                                                            {{ $nearest_location->location }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input name="existing_nearest_ids[]" type="hidden" class="form-control"
                                        value="{{ $existing_nearest_location->id }}">

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{ __('user.Distance(km)') }}</h4>
                                            <div class="form-group homec-form-input homec-form-add">
                                                <input type="text" name="existing_distances[]" autocomplete="off"
                                                    value="{{ html_decode($existing_nearest_location->distance) }}">
                                                <button data-id="{{ $existing_nearest_location->id }}" type="button"
                                                    class="homec-form-add__button homec-form-add__button--delete existingRemoveNearestPlaceRow"><img
                                                        src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Single Form Element -->
                                <div class="mg-top-20">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Nearest Location') }}</h4>
                                    <div class="form-group homec-form-input">
                                        <select name="nearest_locations[]" class="homec-form-select homec-border">
                                            <option value="">{{ __('user.Select') }}</option>
                                            @foreach ($nearest_locations as $nearest_location)
                                                <option value="{{ $nearest_location->id }}">
                                                    {{ $nearest_location->location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Single Form Element -->
                                <div class="mg-top-20">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Distance(km)') }}</h4>
                                    <div class="form-group homec-form-input homec-form-add">
                                        <input type="text" name="distances[]" autocomplete="off">
                                        <button id="addNearestPlaceRow" type="button"
                                            class="homec-form-add__button"><img
                                                src="{{ asset('frontend/img/plus-icon.svg') }}"></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="homec-submit-form mg-top-40">
                <h4 class="homec-submit-form__title">{{ __('user.Additional Information') }}</h4>
                <div class="homec-submit-form__inner" id="additional-box">

                    @foreach ($existing_add_informations as $existing_add_information)
                        <div class="delete-dynamic-additio">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{ __('user.Key') }}</h4>
                                        <div class="form-group homec-form-input">
                                            <input type="text" name="existing_add_keys[]" autocomplete="off"
                                                value="{{ html_decode($existing_add_information->add_key) }}">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="existing_add_ids[]"
                                    value="{{ $existing_add_information->id }}">

                                <div class="col-lg-6 col-md-6 col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{ __('user.Value') }}</h4>
                                        <div class="form-group homec-form-input homec-form-add">
                                            <input type="text" name="existing_add_values[]" autocomplete="off"
                                                value="{{ html_decode($existing_add_information->add_value) }}">
                                            @if (front_lang() === 'en')
                                                <button data-id="{{ $existing_add_information->id }}" type="button"
                                                    class="homec-form-add__button homec-form-add__button--delete existingRemoveAdditioanRow"><img
                                                        src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if (front_lang() === 'en')
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Single Form Element -->
                                <div class="mg-top-20">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Key') }}</h4>
                                    <div class="form-group homec-form-input">
                                        <input type="text" name="add_keys[]" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Single Form Element -->
                                <div class="mg-top-20">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Value') }}</h4>
                                    <div class="form-group homec-form-input homec-form-add">
                                        <input type="text" name="add_values[]" autocomplete="off">
                                        <button id="addAdditionalRow" type="button" class="homec-form-add__button"><img
                                                src="{{ asset('frontend/img/plus-icon.svg') }}"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <div class="homec-submit-form mg-top-40">
                <h4 class="homec-submit-form__title">{{ __('user.Property Plan') }}</h4>
                <div class="homec-submit-form__inner" id="plan-box">

                    @foreach ($existing_plans as $existing_plan)
                        <div class="row">
                            @if (front_lang() === 'en')
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="mg-top-20">
                                        <p class="homec-img-video-label mg-btm-10">{{ __('user.Existing Image') }}</p>
                                        <!-- Image Input -->
                                        <div class="homec-image-video-upload homec-border homec-bg-cover"
                                            style="background-image: url({{ asset($existing_plan->image) }});">
                                            <div class="homec-overlay homec-overlay--img-video"></div>
                                            <input type="file" class="btn-check"
                                                name="existing_plan_image_{{ $existing_plan->id }}"
                                                id="input-video1-{{ $existing_plan->id }}plan">
                                            <label class="homec-image-video-upload__label"
                                                for="input-video1-{{ $existing_plan->id }}plan">
                                                <img src="{{ asset('frontend/img/upload-file-2.svg') }}" alt="#">
                                                <span
                                                    class="homec-image-video-upload__title homec-image-video-upload__title--v2">{{ __('user.Please') }}
                                                    <span class="homec-primary-color">{{ __('user.Choose File') }}</span>
                                                    {{ __('user.to upload') }} </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Single Form Element -->
                                <div class="mg-top-30">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Title') }} </h4>
                                    <div class="form-group homec-form-input">
                                        <input type="text" name="existing_plan_titles[]"
                                            value="{{ html_decode($existing_plan->title) }}">
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="existing_plan_ids[]"
                                    value="{{ $existing_plan->id }}">

                                <!-- Single Form Element -->
                                <div class="mg-top-30">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Description') }}</h4>
                                    <div class="form-group homec-form-input homec-form-add">
                                        <textarea name="existing_plan_descriptions[]">{{ html_decode($existing_plan->description) }}</textarea>
                                        @if (front_lang() === 'en')
                                            <button type="button" data-id="{{ $existing_plan->id }}"
                                                class="homec-form-add__button homec-form-add__button--delete existingRemovePlanRow"><img
                                                    src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if (front_lang() === 'en')
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="mg-top-30">
                                    <p class="homec-img-video-label mg-btm-10">{{ __('user.Image') }}</p>
                                    <!-- Image Input -->
                                    <div class="homec-image-video-upload homec-border">
                                        <input type="file" class="btn-check" name="plan_images[]">
                                        <label class="homec-image-video-upload__label plan-video-id">
                                            <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                            <span class="homec-image-video-upload__title">{{ __('user.Please') }} <span
                                                    class="homec-primary-color">{{ __('user.Choose File') }}</span>
                                                {{ __('user.to upload') }} </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Single Form Element -->
                                <div class="mg-top-30">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Title') }} </h4>
                                    <div class="form-group homec-form-input">
                                        <input type="text" name="plan_titles[]">
                                    </div>
                                </div>
                                <!-- Single Form Element -->
                                <div class="mg-top-30">
                                    <h4 class="homec-submit-form__heading">{{ __('user.Description') }}</h4>
                                    <div class="form-group homec-form-input homec-form-add">
                                        <textarea name="plan_descriptions[]"></textarea>
                                        <button id="addNewPlan" type="button" class="homec-form-add__button"><img
                                                src="{{ asset('frontend/img/plus-icon.svg') }}"></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="homec-submit-form mg-top-40">
                <h4 class="homec-submit-form__title">{{ __('user.SEO Information') }}</h4>
                <div class="homec-submit-form__inner">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{ __('user.SEO Title') }}</h4>
                                <div class="form-group homec-form-input">
                                    <input type="text" name="seo_title"
                                        value="{{ html_decode($property->seo_title) }}">
                                </div>
                            </div>
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{ __('user.SEO Meta Description') }}</h4>
                                <div class="form-group homec-form-input">
                                    <input type="text" name="seo_meta_description"
                                        value="{{ html_decode($property->seo_meta_description) }}">
                                </div>
                            </div>
                        </div>
                        @if (front_lang() === 'en')
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="homeco-switcher-group mg-top-20">
                                    <div class="homeco-switcher-group__single">
                                        <!-- Single Switcher-->
                                        <div class="homeco-switcher-group__item">
                                            <h4 class="homeco-switcher-group__title">{{ __('user.Status') }}</h4>
                                            <div class="homeco-switcher-group__switch">
                                                <label class="homeco__item-switch">
                                                    <input name="status" type="checkbox"
                                                        {{ $property->status == 'enable' ? 'checked' : '' }}>
                                                    <span
                                                        class="homeco__item-switch--slide homeco__item-switch--round"></span>
                                                </label>
                                                <p class="homeco-switcher-group__text">{{ __('user.Enable / Disable') }}
                                                </p>
                                            </div>
                                        </div>
                                        <!-- End Single Switcher-->

                                        @if ($property->is_urgent == 'enable')
                                            <!-- Single Switcher-->
                                            <div class="homeco-switcher-group__item">
                                                <h4 class="homeco-switcher-group__title">{{ __('user.Urgent Property') }}
                                                </h4>
                                                <div class="homeco-switcher-group__switch">
                                                    <label class="homeco__item-switch">
                                                        <input type="checkbox"
                                                            {{ $property->is_urgent == 'enable' ? 'checked' : '' }}
                                                            name="is_urgent">
                                                        <span
                                                            class="homeco__item-switch--slide homeco__item-switch--round"></span>
                                                    </label>
                                                    <p class="homeco-switcher-group__text">
                                                        {{ __('user.Enable / Disable') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- End Single Switcher-->
                                        @else
                                            @if ($urgent_property == 'enable')
                                                <!-- Single Switcher-->
                                                <div class="homeco-switcher-group__item">
                                                    <h4 class="homeco-switcher-group__title">
                                                        {{ __('user.Urgent Property') }}
                                                    </h4>
                                                    <div class="homeco-switcher-group__switch">
                                                        <label class="homeco__item-switch">
                                                            <input type="checkbox"
                                                                {{ $property->is_urgent == 'enable' ? 'checked' : '' }}
                                                                name="is_urgent">
                                                            <span
                                                                class="homeco__item-switch--slide homeco__item-switch--round"></span>
                                                        </label>
                                                        <p class="homeco-switcher-group__text">
                                                            {{ __('user.Enable / Disable') }}</p>
                                                    </div>
                                                </div>
                                                <!-- End Single Switcher-->
                                            @endif
                                        @endif
                                    </div>
                                    <div class="homeco-switcher-group__single">

                                        @if ($property->is_featured == 'enable')
                                            <!-- Single Switcher-->
                                            <div class="homeco-switcher-group__item">
                                                <h4 class="homeco-switcher-group__title">
                                                    {{ __('user.Featured Property') }}
                                                </h4>
                                                <div class="homeco-switcher-group__switch">
                                                    <label class="homeco__item-switch">
                                                        <input {{ $property->is_featured == 'enable' ? 'checked' : '' }}
                                                            type="checkbox" name="is_featured">
                                                        <span
                                                            class="homeco__item-switch--slide homeco__item-switch--round"></span>
                                                    </label>
                                                    <p class="homeco-switcher-group__text">
                                                        {{ __('user.Enable / Disable') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- End Single Switcher-->
                                        @else
                                            @if ($featured_property == 'enable')
                                                <!-- Single Switcher-->
                                                <div class="homeco-switcher-group__item">
                                                    <h4 class="homeco-switcher-group__title">
                                                        {{ __('user.Featured Property') }}</h4>
                                                    <div class="homeco-switcher-group__switch">
                                                        <label class="homeco__item-switch">
                                                            <input
                                                                {{ $property->is_featured == 'enable' ? 'checked' : '' }}
                                                                type="checkbox" name="is_featured">
                                                            <span
                                                                class="homeco__item-switch--slide homeco__item-switch--round"></span>
                                                        </label>
                                                        <p class="homeco-switcher-group__text">
                                                            {{ __('user.Enable / Disable') }}</p>
                                                    </div>
                                                </div>
                                                <!-- End Single Switcher-->
                                            @endif
                                        @endif

                                        @if ($property->is_top == 'enable')
                                            <!-- Single Switcher-->
                                            <div class="homeco-switcher-group__item">
                                                <h4 class="homeco-switcher-group__title">{{ __('user.Top Property') }}
                                                </h4>
                                                <div class="homeco-switcher-group__switch">
                                                    <label class="homeco__item-switch">
                                                        <input type="checkbox"
                                                            {{ $property->is_top == 'enable' ? 'checked' : '' }}
                                                            name="is_top">
                                                        <span
                                                            class="homeco__item-switch--slide homeco__item-switch--round"></span>
                                                    </label>
                                                    <p class="homeco-switcher-group__text">
                                                        {{ __('user.Enable / Disable') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- End Single Switcher-->
                                        @else
                                            @if ($top_property == 'enable')
                                                <!-- Single Switcher-->
                                                <div class="homeco-switcher-group__item">
                                                    <h4 class="homeco-switcher-group__title">
                                                        {{ __('user.Top Property') }}
                                                    </h4>
                                                    <div class="homeco-switcher-group__switch">
                                                        <label class="homeco__item-switch">
                                                            <input type="checkbox"
                                                                {{ $property->is_top == 'enable' ? 'checked' : '' }}
                                                                name="is_top">
                                                            <span
                                                                class="homeco__item-switch--slide homeco__item-switch--round"></span>
                                                        </label>
                                                        <p class="homeco-switcher-group__text">
                                                            {{ __('user.Enable / Disable') }}</p>
                                                    </div>
                                                </div>
                                                <!-- End Single Switcher-->
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-end mg-top-40">
                    <button type="submit"
                        class="homec-btn homec-btn__second"><span>{{ __('user.Submit Property') }}</span></button>
                </div>
            </div>
            </form>
        </div>
        </div>
        </div>
    </section>

    <!-- Download App -->
    <section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15"
        style="background-image:url({{ asset($mobile_app->app_bg) }})">
        <div class="homec-shape">
            <div class="homec-shape-single homec-shape-11"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                    alt="bg"></div>
            <div class="homec-shape-single homec-shape-12"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                    alt="bg"></div>
            <div class="homec-shape-single homec-shape-13"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                    alt="bg"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="download-app__middle">
                        <div class="download-app__content">
                            <div class="homec-section__head section-white mg-btm-30" data-aos="fade-up"
                                data-aos-delay="400">
                                <h2 class="homec-section__title">{{ $mobile_app->full_title }}</h2>
                                <p class="sec-head__text">{{ $mobile_app->description }}</p>
                            </div>
                            <!-- App Download Button -->
                            <div class="download__app-button" data-aos="fade-up" data-aos-delay="500">
                                <a href="{{ $mobile_app->app_store }}"
                                    class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-apple"></i>
                                        <div class="btn-content"><span>{{ $mobile_app->apple_btn_text1 }}</span>
                                            <p>{{ $mobile_app->apple_btn_text2 }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ $mobile_app->play_store }}"
                                    class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-google-play"></i>
                                        <div class="btn-content"><span>{{ $mobile_app->google_btn_text1 }}</span>
                                            <p>{{ $mobile_app->google_btn_text2 }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- End App Download Button -->
                        </div>
                        <!-- Download Image -->
                        <div class="download-app__img" data-aos="fade-up" data-aos-delay="700">
                            <img src="{{ asset($mobile_app->image) }}" alt="mobile_app">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Download App -->


    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                // slider box load

                $("#slider_image_hideden_btn").on("click", function() {
                    $('#slider_image_hideden_id').click();
                })


                $.get({
                    url: "{{ url('/') }}/user/property/city/list/{{ $property->country_id }}?city_id={{ $property->city_id }}",
                    dataType: 'json',
                    data: {},
                    beforeSend: function() {},
                    success: function(response) {
                        $('#country_selector').html(response.template);
                    },
                    complete: function() {},
                });

                // slider box load


                // slug generate and check

                $("#title").on("keyup", function(e) {
                    $("#slug").val(convertToSlug($(this).val()));
                })

                // slug generate and check

                // manage rent period price

                $("#purpose").on("change", function() {
                    var purpose = $(this).val()
                    if (purpose == 'rent') {
                        $("#rend_period_box").removeClass('d-none');
                    } else {
                        $("#rend_period_box").addClass('d-none');
                    }
                })

                // manage rent period price

                //start dynamic nearest place add and remove

                $("#addNearestPlaceRow").on("click", function() {
                    var new_row = $("#hidden-location-box").html();
                    $("#nearest-place-box").append(new_row)
                })

                $(document).on('click', '.removeNearestPlaceRow', function() {
                    $(this).closest('.delete-dynamic-location').remove();
                });

                $(document).on('click', '.existingRemoveNearestPlaceRow', function() {

                    let id = $(this).data('id');
                    $(this).closest('.delete-dynamic-location').remove();

                    $.ajax({
                        type: "put",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        url: "{{ url('/user/remove-nearest-location/') }}" + "/" + id,
                        success: function(response) {},
                        error: function(err) {}
                    })
                });

                //end dynamic nearest place add and remove

                //start additonal information add and remove

                $("#addAdditionalRow").on("click", function() {
                    var new_row = $("#hidden-addition-box").html();
                    $("#additional-box").append(new_row)
                })

                $(document).on('click', '.removeAdditioanRow', function() {
                    $(this).closest('.delete-dynamic-additio').remove();
                });

                $(document).on('click', '.existingRemoveAdditioanRow', function() {

                    var isDemo = "{{ env('APP_MODE') }}"
                    if (isDemo == 'DEMO') {
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    let id = $(this).data('id');
                    $(this).closest('.delete-dynamic-additio').remove();

                    $.ajax({
                        type: "put",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        url: "{{ url('/user/remove-add-infor/') }}" + "/" + id,
                        success: function(response) {},
                        error: function(err) {}
                    })

                });

                //end additonal information add and remove

                //start dynamic plan add and remove

                $("#addNewPlan").on("click", function() {
                    var new_row = $("#hidden-plan-box").html();
                    $("#plan-box").append(new_row)
                })

                $(document).on('click', '.removePlanRow', function() {
                    $(this).closest('.delete-dynamic-plan').remove();
                });

                $(document).on('click', '.existingRemovePlanRow', function() {
                    var isDemo = "{{ env('APP_MODE') }}"
                    if (isDemo == 'DEMO') {
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    let id = $(this).data('id');
                    $(this).closest('.delete-dynamic-plan').remove();
                    $.ajax({
                        type: "put",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        url: "{{ url('/user/remove-plan/') }}" + "/" + id,
                        success: function(response) {

                        },
                        error: function(err) {}
                    })
                });

                //end dynamic plan  add and remove

                // load plan image

                $(document).on('click', '.plan-video-id', function() {
                    $(this).siblings('input[type="file"]').click();
                });

                // load plan image

                // remove existing slider

                $(".remove_existing_image").on("click", function() {

                    var isDemo = "{{ env('APP_MODE') }}"
                    if (isDemo == 'DEMO') {
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    let id = $(this).data('id');
                    let parent_div = $(this).closest('.image-box').remove();

                    $.ajax({
                        type: "put",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        url: "{{ url('/user/remove-property-slider/') }}" + "/" + id,
                        success: function(response) {},
                        error: function(err) {}
                    })
                })

                // remove existing slider

            });

        })(jQuery);

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }

        $("#country_id").change(function() {
            let id = this.value;
            let route = "{{ url('/user/property/city/list/') }}/" + id;
            ajax_switch_country(route)
        });

        function ajax_switch_country(route) {
            $.get({
                url: route,
                dataType: 'json',
                data: {},
                beforeSend: function() {},
                success: function(response) {
                    $('#country_selector').html(response.template);
                },
                complete: function() {},
            });
        }

        var editLat = "{{ $property->lat }}";
        var editLon = "{{ $property->lon }}";

        var initialLat = editLat ? parseFloat(editLat) : 23.822350;
        var initialLon = editLon ? parseFloat(editLon) : 90.365417;

        var map = L.map('map').setView([initialLat, initialLon], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var currentMarker;

        currentMarker = L.marker([initialLat, initialLon]).addTo(map);

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
                    debounce(function() {
                        const keyword = this.value;

                        if (keyword.length > 3) {
                            const xhr = new XMLHttpRequest();
                            const url = 'https://nominatim.openstreetmap.org/search?format=json&q=' +
                                encodeURIComponent(keyword);
                            xhr.open('GET', url, true);
                            xhr.onload = function() {
                                if (xhr.status >= 200 && xhr.status < 400) {
                                    const data = JSON.parse(xhr.responseText);
                                    resultsElement.innerHTML = '';
                                    if (data.length > 0) {
                                        let resultsHTML = '';
                                        data.forEach(function(v) {
                                            resultsHTML +=
                                                `<li data-lat="${v.lat}" data-lon="${v.lon}">${v.display_name}</li>`;
                                        });
                                        resultsElement.innerHTML = resultsHTML;
                                        resultsElement.style.display = 'block';

                                        resultsElement.addEventListener('click', function(event) {
                                            if (event.target.tagName.toLowerCase() === 'li') {
                                                const thatItem = event.target;
                                                const getLat = thatItem.getAttribute(
                                                    'data-lat');
                                                const getLon = thatItem.getAttribute(
                                                    'data-lon');
                                                const displayName = thatItem.textContent;

                                                // Update input values
                                                addressInput.value = displayName;
                                                document.getElementById('lat').value = getLat;
                                                document.getElementById('lng').value = getLon;

                                                // Set the map view to the selected coordinates
                                                map.setView([getLat, getLon], 13);

                                                // Update or create the marker
                                                if (currentMarker) {
                                                    map.removeLayer(
                                                        currentMarker
                                                        ); // Remove existing marker
                                                }
                                                currentMarker = L.marker([getLat, getLon])
                                                    .addTo(map); // Add new marker

                                                resultsElement.style.display =
                                                    'none'; // Hide results
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
                document.addEventListener('click', function(event) {
                    if (!addressInput.contains(event.target) && !resultsElement.contains(event.target)) {
                        resultsElement.style.display = 'none';
                    }
                });
            }
        });
    </script>

@endsection
