
@extends('layout')
@section('title')
    <title>{{__('user.Create Property')}}</title>
@endsection

@section('meta')
    <meta name="description" content="{{__('user.Create Property')}}">
    <meta name="title" content="{{__('user.Create Property')}}">
@endsection

@section('frontend-content')
<style>
    body {
        background-color: #f8fafc !important;
    }
    .pd-top-80.pd-btm-80, section.pd-top-80 {
        background-color: #f8fafc !important;
        padding-top: 40px !important;
        padding-bottom: 70px !important;
    }
    .homec-submit-form {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05) !important;
        margin-bottom: 30px !important;
        transition: all 0.3s ease-in-out !important;
        position: relative !important;
        z-index: 1 !important;
    }
    #map {
        height: 380px !important;
        width: 100% !important;
        border-radius: 14px !important;
        border: 1.5px solid #cbd5e1 !important;
        position: relative !important;
        z-index: 1 !important;
        margin-top: 10px !important;
        overflow: hidden !important;
    }
    .leaflet-container {
        height: 100% !important;
        width: 100% !important;
        border-radius: 14px !important;
        z-index: 1 !important;
    }
    .homec-form-input {
        position: relative !important;
    }
    #results-list {
        position: absolute !important;
        width: 100% !important;
        max-height: 220px !important;
        overflow-y: auto !important;
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15) !important;
        z-index: 9999 !important;
        list-style: none !important;
        padding: 0 !important;
        margin-top: 4px !important;
        display: none;
    }
    #results-list li {
        padding: 12px 18px !important;
        cursor: pointer !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        color: #1e293b !important;
        border-bottom: 1px solid #f1f5f9 !important;
        transition: background-color 0.2s ease !important;
    }
    #results-list li:hover {
        background-color: #e6f6ff !important;
        color: #008cc7 !important;
    }
    .homec-submit-form:hover {
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.08) !important;
    }
    .amenity-tag-badge {
        background: linear-gradient(135deg, #e6f6ff 0%, #d0efff 100%) !important;
        color: #008cc7 !important;
        border: 1.5px solid #90d8ff !important;
        border-radius: 20px !important;
        padding: 7px 16px !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 3px !important;
        box-shadow: 0 2px 6px rgba(0, 140, 199, 0.12) !important;
        transition: all 0.2s ease-in-out !important;
    }
    .amenity-tag-badge:hover {
        background: #bde4ff !important;
        transform: translateY(-1px) !important;
    }
    .amenity-tag-remove {
        cursor: pointer !important;
        color: #ef4444 !important;
        font-weight: 700 !important;
        font-size: 16px !important;
        line-height: 1 !important;
        margin-left: 4px !important;
        display: inline-block !important;
        transition: transform 0.2s ease !important;
    }
    .amenity-tag-remove:hover {
        color: #dc2626 !important;
        transform: scale(1.3) !important;
    }
    .homec-submit-form__title {
        background: linear-gradient(135deg, #48aadf 0%, #008cc7 100%) !important;
        color: #ffffff !important;
        font-size: 18px !important;
        font-weight: 700 !important;
        padding: 18px 28px !important;
        border-radius: 20px 20px 0 0 !important;
        letter-spacing: 0.3px !important;
        margin: 0 !important;
    }
    .homec-submit-form__inner {
        padding: 28px 32px 36px !important;
        background: #ffffff !important;
    }
    .homec-submit-form__heading {
        font-size: 14.5px !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        margin-bottom: 8px !important;
        display: block !important;
    }
    .homec-form-input input[type="text"],
    .homec-form-input input[type="number"],
    .homec-form-input select,
    .homec-form-select {
        width: 100% !important;
        height: 50px !important;
        background-color: #f8fafc !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 12px !important;
        padding: 10px 18px !important;
        font-size: 14.5px !important;
        font-weight: 500 !important;
        color: #0f172a !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    .homec-form-input input:focus,
    .homec-form-input select:focus,
    .homec-form-input textarea:focus,
    .homec-form-select:focus {
        background-color: #ffffff !important;
        border-color: #48aadf !important;
        box-shadow: 0 0 0 4px rgba(72, 170, 223, 0.18) !important;
        outline: none !important;
    }
    .homec-image-video-upload {
        background-color: #f1f5f9 !important;
        border: 2px dashed #94a3b8 !important;
        border-radius: 16px !important;
        padding: 36px 20px !important;
        transition: all 0.3s ease !important;
    }
    .homec-image-video-upload:hover {
        border-color: #48aadf !important;
        background-color: #e6f6ff !important;
    }
    .homec-btn, .homec-btn--primary {
        background: linear-gradient(135deg, #48aadf 0%, #008cc7 100%) !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        border-radius: 30px !important;
        padding: 14px 42px !important;
        border: none !important;
        box-shadow: 0 6px 20px rgba(0, 140, 199, 0.35) !important;
        transition: all 0.3s ease !important;
    }
    .homec-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 10px 25px rgba(0, 140, 199, 0.45) !important;
        color: #ffffff !important;
    }
    .ck-editor__editable_inline {
        min-height: 200px !important;
        border-radius: 0 0 12px 12px !important;
    }
    .ck-toolbar {
        border-radius: 12px 12px 0 0 !important;
        background: #f8fafc !important;
    }
    .property-submit-btn-wrapper {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        margin-top: 40px !important;
        margin-bottom: 20px !important;
        width: 100% !important;
    }
    .property-submit-btn {
        background: linear-gradient(135deg, #48aadf 0%, #008cc7 100%) !important;
        color: #ffffff !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        padding: 16px 50px !important;
        border-radius: 50px !important;
        border: none !important;
        box-shadow: 0 8px 25px rgba(0, 140, 199, 0.35) !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        min-width: 260px !important;
        text-align: center !important;
    }
    .property-submit-btn span {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 16px !important;
    }
    .property-submit-btn:hover {
        background: linear-gradient(135deg, #008cc7 0%, #006699 100%) !important;
        color: #ffffff !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 12px 30px rgba(0, 140, 199, 0.5) !important;
    }
    .property-submit-btn:hover span {
        color: #ffffff !important;
    }
    .homec-btn--upload,
    #slider_image_hideden_btn {
        background: linear-gradient(135deg, #48aadf 0%, #008cc7 100%) !important;
        color: #ffffff !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 10px 24px !important;
        border-radius: 30px !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(0, 140, 199, 0.25) !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        transition: all 0.25s ease !important;
        cursor: pointer !important;
    }
    .homec-btn--upload span,
    #slider_image_hideden_btn span {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 14px !important;
    }
    .homec-btn--upload:hover,
    #slider_image_hideden_btn:hover {
        background: linear-gradient(135deg, #008cc7 0%, #006699 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 6px 18px rgba(0, 140, 199, 0.4) !important;
        transform: translateY(-2px) !important;
    }
    .homec-btn--upload:hover span,
    #slider_image_hideden_btn:hover span {
        color: #ffffff !important;
    }
    .homec-image-video-upload__title,
    .homec-image-video-upload__title span {
        transition: color 0.2s ease !important;
    }
    .homec-image-video-upload:hover .homec-image-video-upload__title {
        color: #0f172a !important;
    }
    .homec-image-video-upload:hover .homec-image-video-upload__title .homec-primary-color {
        color: #008cc7 !important;
    }
</style>
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
                                            <h4 class="homec-submit-form__heading">{{__('user.Total Area (Sq. Ft.)')}} </h4>
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
                                                    <div class="row" id="new_slider_image_preview_row">
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mg-top-20">
                                                <p class="homec-img-video-label mg-btm-10">
                                                    {{ __('user.Thumbnail Image') }}</p>
                                                <!-- Image Input -->
                                                <div class="homec-image-video-upload homec-border">
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
                                                <select name="country_id" class="homec-form-select homec-border" id="country_id" required>
                                                    <option value="">-- {{__('user.Select Country')}} --</option>
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
                                                <select name="city_id" class="homec-form-select homec-border" required>
                                                    <option value="">-- {{__('user.Select City')}} --</option>
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group homec-form-input">
                                            <h4 class="homec-submit-form__heading">{{__('user.Select Amenities')}}</h4>
                                            <select id="amenity_dropdown_select" class="homec-form-select select2" style="width: 100%;">
                                                <option value="">-- {{__('user.Select Amenities')}} --</option>
                                                @foreach ($aminities as $aminity)
                                                    <option value="{{ $aminity->id }}" data-name="{{ $aminity->aminity }}">{{ $aminity->aminity }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mg-top-20">
                                        <h4 class="homec-submit-form__heading" style="font-size: 13.5px; color: #64748b;">{{__('user.Selected Amenities')}}:</h4>
                                        <div id="selected_amenities_tags" class="d-flex flex-wrap align-items-center gap-2 p-3" style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 14px; min-height: 60px;">
                                            <!-- Badges will render here dynamically -->
                                        </div>
                                        <div id="hidden_amenities_inputs"></div>
                                    </div>
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
                            <div class="col-12 property-submit-btn-wrapper">
                                <button type="submit" class="property-submit-btn">
                                    <span>{{__('user.Submit Property')}}</span>
                                </button>
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





            var sliderDataTransferCreate = new DataTransfer();

            $("#slider_image_hideden_btn").on("click", function() {
                $('#slider_image_hideden_id').click();
            });

            $("#slider_image_hideden_id").on("change", function() {
                var input = this;
                if (input.files && input.files.length > 0) {
                    Array.from(input.files).forEach(function(file) {
                        sliderDataTransferCreate.items.add(file);
                    });
                    input.files = sliderDataTransferCreate.files;
                    renderCreateSliderPreviews();
                }
            });

            function renderCreateSliderPreviews() {
                var newPreviewContainer = $("#new_slider_image_preview_row");
                newPreviewContainer.empty();

                var count = sliderDataTransferCreate.files.length;
                if (count > 0) {
                    $("#slider_image_hideden_btn span").text(count + " Image(s) Selected");
                    $("#slider_image_hideden_btn").css({"background": "#16a34a", "color": "#ffffff"});

                    Array.from(sliderDataTransferCreate.files).forEach(function(file, index) {
                        if (file && file.type.startsWith('image/')) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = `
                                    <div class="col-lg-4 col-md-4 col-6 image-box mg-btm-15">
                                        <div class="homec-upload-images__single" style="border: 2px solid #16a34a; border-radius: 8px; overflow: hidden; position: relative; height: 110px;">
                                            <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">
                                            <button type="button" class="remove-create-preview-btn" data-index="${index}" style="position: absolute; top: 4px; right: 4px; background: rgba(220, 38, 38, 0.9); color: white; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 14px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; line-height: 1;">&times;</button>
                                            <span class="badge" style="position: absolute; bottom: 4px; right: 4px; font-size: 10px; background-color: #16a34a; color: #fff; padding: 2px 6px; border-radius: 4px;">Selected</span>
                                        </div>
                                    </div>
                                `;
                                newPreviewContainer.append(html);
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                } else {
                    $("#slider_image_hideden_btn span").text("{{ __('user.Upload New Image') }}");
                    $("#slider_image_hideden_btn").css({"background": "", "color": ""});
                }
            }

            $(document).on('click', '.remove-create-preview-btn', function() {
                var indexToRemove = parseInt($(this).data('index'));
                var newDt = new DataTransfer();
                Array.from(sliderDataTransferCreate.files).forEach(function(file, idx) {
                    if (idx !== indexToRemove) {
                        newDt.items.add(file);
                    }
                });
                sliderDataTransferCreate = newDt;
                var input = document.getElementById('slider_image_hideden_id');
                if (input) {
                    input.files = sliderDataTransferCreate.files;
                }
                renderCreateSliderPreviews();
            });

            // Amenities dropdown multi-select tag picker
            var selectedAmenities = new Map();

            function renderAmenityTags() {
                var tagsContainer = $('#selected_amenities_tags');
                var inputsContainer = $('#hidden_amenities_inputs');
                tagsContainer.empty();
                inputsContainer.empty();

                if (selectedAmenities.size === 0) {
                    tagsContainer.html('<span class="text-muted" style="font-size:13.5px; font-style:italic;">No amenities selected yet. Pick amenities from dropdown list above.</span>');
                    return;
                }

                selectedAmenities.forEach(function(name, id) {
                    var tagHtml = `<span class="amenity-tag-badge">
                        ${name}
                        <span class="amenity-tag-remove" data-id="${id}">&times;</span>
                    </span>`;
                    tagsContainer.append(tagHtml);

                    var inputHtml = `<input type="hidden" name="aminities[]" value="${id}">`;
                    inputsContainer.append(inputHtml);
                });
            }

            $('#amenity_dropdown_select').on('change', function() {
                var id = $(this).val();
                var name = $(this).find('option:selected').data('name');
                if (id && name) {
                    selectedAmenities.set(id.toString(), name);
                    renderAmenityTags();
                    $(this).val('').trigger('change.select2');
                }
            });

            $(document).on('click', '.amenity-tag-remove', function() {
                var id = $(this).data('id');
                if (id !== undefined && id !== null) {
                    selectedAmenities.delete(id.toString());
                    renderAmenityTags();
                }
            });

            renderAmenityTags();

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
