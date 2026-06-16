@extends('admin.master_layout')
@section('title')
    <title>{{ __('admin.Create property') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('admin.Create property') }}</h1>
            </div>
            <div class="section-body property_box">
                <div id="hidden-location-box" class="d-none">
                    <div class="delete-dynamic-location">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ __('admin.Nearest Location') }}</label>
                                    <select name="nearest_locations[]" id="" class="form-control">
                                        <option value="">{{ __('admin.Select') }}</option>
                                        @foreach ($nearest_locations as $nearest_location)
                                            <option value="{{ $nearest_location->id }}">{{ $nearest_location->location }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('admin.Distance(km)') }}</label>
                                    <input type="text" class="form-control" name="distances[]">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button"
                                    class="btn btn-danger nearest-row-btn removeNearestPlaceRow plus_btn"><i
                                        class="fas fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="hidden-addition-box" class="d-none">
                    <div class="delete-dynamic-additio">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ __('admin.Key') }}</label>
                                    <input type="text" class="form-control" name="add_keys[]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('admin.Value') }}</label>
                                    <input type="text" class="form-control" name="add_values[]">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger nearest-row-btn removeAdditioanRow plus_btn"><i
                                        class="fas fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="hidden-plan-box" class="d-none">
                    <div class="delete-dynamic-plan">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ __('admin.Image') }}</label>
                                    <input type="file" class="form-control-file" name="plan_images[]">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger nearest-row-btn removePlanRow plus_btn"><i
                                        class="fas fa-trash" aria-hidden="true"></i> {{ __('admin.Remove Plan') }}</button>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">{{ __('admin.Title') }}</label>
                                    <input type="text" class="form-control" name="plan_titles[]">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">{{ __('admin.Description') }}</label>
                                    <textarea name="plan_descriptions[]" id="" class="form-control text-area-5" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.property.index') }}" class="btn btn-primary"><i class="fas fa-list"></i>
                    {{ __('admin.Own Properties') }}</a>
                <form id="property_form" action="{{ route('admin.property.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row mt-4">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body" data-select2-id="select2-data-46-mub9">
                                    <h4>{{ __('admin.Basic Information') }}</h4>
                                    <hr>

                                    <div class="form-group">
                                        <label for="title">{{ __('admin.Property Owner') }}<span
                                                class="text-danger">*</span></label>
                                        <select name="owner_id" id="owner_id" class="form-control select2">
                                            <option value="0">{{ __('admin.Own Property') }}</option>
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->name }} -
                                                    {{ $agent->phone }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">{{ __('admin.Title') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" id="title"
                                            value="{{ old('title') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">{{ __('admin.Slug') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="slug" class="form-control" id="slug"
                                            value="{{ old('slug') }}">
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Property Type') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="property_type_id" id="property_type_id"
                                                    class="form-control select2">
                                                    <option value="">{{ __('admin.Select') }}</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="purpose">{{ __('admin.Purpose') }} <span
                                                    class="text-danger">*</span></label>
                                                <select name="purpose" id="purpose" class="form-control" required>
                                                    <option value="">Select Purpose</option>
                                                    <option value="buy">{{ __('For Buy') }}</option>
                                                    <option value="sale">{{ __('admin.For Sale') }}</option>
                                                    <option value="rent">{{ __('admin.For Rent') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 d-none" id="rend_period_box">
                                            <div class="form-group">
                                                <label for="rent_period">{{ __('admin.Rent Period') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="rent_period" id="rent_period" class="form-control">
                                                    <option value="daily">{{ __('admin.Daily') }}</option>
                                                    <option value="monthly">{{ __('admin.Monthly') }}</option>
                                                    <option value="yearly">{{ __('admin.Yearly') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">{{ __('admin.Price') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="price" class="form-control"
                                                    value="{{ old('price') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Total Area(m2)') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="total_area" class="form-control"
                                                    value="{{ old('total_area') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Total Unit') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="total_unit" class="form-control"
                                                    value="{{ old('total_unit') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Total Bedroom') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="total_bedroom" class="form-control"
                                                    value="{{ old('total_bedroom') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Total Bathroom') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="total_bathroom" class="form-control"
                                                    value="{{ old('total_bathroom') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Total Garage') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="total_garage" class="form-control"
                                                    value="{{ old('total_garage') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Total Kitchen') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="total_kitchen" class="form-control"
                                                    value="{{ old('total_kitchen') }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="description">{{ __('admin.Description') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="description" id="description" cols="30" rows="10" class="summernote">{{ html_decode(old('description')) }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body" data-select2-id="select2-data-46-mub9">
                                    <h4>{{ __('admin.Location') }}</h4>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Country') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="country_id" id="country_id" class="form-control select2">
                                                    <option value="">{{ __('admin.Select') }}</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.City') }} <span
                                                        class="text-danger">*</span></label>
                                                <div id="country_selector">
                                                    <select name="city_id" id="city_id" class="form-control select2">
                                                        <option value="">{{ __('admin.Select') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="address">{{ __('admin.Address') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="address" class="form-control" id="address"
                                                    required>
                                                <ul id="results-list"></ul> <!-- Results list -->
                                            </div>
                                        </div>

                                        @if ($setting->live_map == 'yes')
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="google_map">{{ __('admin.Map') }} <span
                                                            class="text-danger">*</span></label>
                                                    <div id="map">

                                                    </div>
                                                    <input type="hidden" id="lat" name="lat" value="">
                                                    <input type="hidden" id="lng" name="lng" value="">
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="google_map">{{ __('admin.Google Map') }} <span
                                                            class="text-danger">*</span></label>
                                                    <textarea name="google_map" class="form-control text-area-5" id="" cols="30" rows="10">{{ old('google_map') }}</textarea>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="address_description">{{ __('admin.Address Details') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="address_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ old('address_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4>{{ __('admin.Image and Video') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Thumbnail Image') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" name="thumbnail_image" class="form-control-file">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Slider Image') }}
                                                    ({{ __('admin.Multiple') }}) <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" name="slider_images[]" multiple
                                                    class="form-control-file">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Video Thumbnail Image') }}</label>
                                                <input type="file" name="video_thumbnail" class="form-control-file">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Youtube video id') }} </label>
                                                <input type="text" name="video_id" class="form-control"
                                                    value="{{ old('video_id') }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Video description') }} </label>
                                                <textarea name="video_description" class="form-control text-area-3" id="" cols="30" rows="10">{{ old('video_description') }}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4>{{ __('admin.Aminities') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <div>

                                                    @foreach ($aminities as $aminity)
                                                        <input value="{{ $aminity->id }}" type="checkbox"
                                                            name="aminities[]" id="aminity{{ $aminity->id }}">

                                                        <label class="mx-1"
                                                            for="aminity{{ $aminity->id }}">{{ $aminity->aminity }}</label>
                                                    @endforeach

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4>{{ __('admin.Nearest Location') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12" id="nearest-place-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('admin.Nearest Location') }}</label>
                                                        <select name="nearest_locations[]" id=""
                                                            class="form-control">
                                                            <option value="">{{ __('admin.Select') }}</option>
                                                            @foreach ($nearest_locations as $nearest_location)
                                                                <option value="{{ $nearest_location->id }}">
                                                                    {{ $nearest_location->location }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">{{ __('admin.Distance(km)') }}</label>
                                                        <input type="text" class="form-control" name="distances[]">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button id="addNearestPlaceRow" type="button"
                                                        class="btn btn-success nearest-row-btn plus_btn"><i
                                                            class="fas fa-plus" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4>{{ __('admin.Additional Information') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12" id="additional-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('admin.Key') }}</label>
                                                        <input type="text" class="form-control" name="add_keys[]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">{{ __('admin.Value') }}</label>
                                                        <input type="text" class="form-control" name="add_values[]">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button id="addAdditionalRow" type="button"
                                                        class="btn btn-success nearest-row-btn plus_btn"><i
                                                            class="fas fa-plus" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4>{{ __('admin.Property Plan') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12" id="plan-box">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('admin.Image') }}</label>
                                                        <input type="file" class="form-control-file"
                                                            name="plan_images[]">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <button id="addNewPlan" type="button"
                                                        class="btn btn-success nearest-row-btn plus_btn"><i
                                                            class="fas fa-plus" aria-hidden="true"></i>
                                                        {{ __('admin.New Plan') }}</button>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="">{{ __('admin.Title') }}</label>
                                                        <input type="text" class="form-control" name="plan_titles[]">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="">{{ __('admin.Description') }}</label>
                                                        <textarea name="plan_descriptions[]" id="" class="form-control text-area-5" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4>{{ __('admin.SEO Information and Others') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('admin.Status') }}</div>
                                                <label class=" mt-2">
                                                    <input type="checkbox" name="status" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span
                                                        class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12" id="featured_box">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('admin.Featured') }}</div>
                                                <label class=" mt-2">
                                                    <input type="checkbox" name="is_featured"
                                                        class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span
                                                        class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12" id="top_box">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('admin.Top Property') }}</div>
                                                <label class=" mt-2">
                                                    <input type="checkbox" name="is_top" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span
                                                        class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12" id="urgent_box">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('admin.Urgent Property') }}</div>
                                                <label class=" mt-2">
                                                    <input type="checkbox" name="is_urgent" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span
                                                        class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.SEO Title') }} </label>
                                                <input type="text" name="seo_title" class="form-control"
                                                    value="{{ old('seo_title') }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.SEO Meta Description') }} </label>
                                                <textarea name="seo_meta_description" class="form-control text-area-5" id="" cols="30"
                                                    rows="10">{{ old('seo_meta_description') }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary save_btn">{{ __('admin.Save') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>

    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                // check agent package availability

                $("#owner_id").on("change", function() {
                    let owner_id = $(this).val();

                    if (owner_id != 0) {
                        $.ajax({
                            type: "get",
                            url: "{{ url('/admin/agent-plan-availability/') }}" + "/" +
                                owner_id,
                            success: function(response) {

                                if (response.top_property == 'disable') {
                                    $("#top_box").addClass('d-none');
                                } else {
                                    $("#top_box").removeClass('d-none');
                                }

                                if (response.urgent_property == 'disable') {
                                    $("#urgent_box").addClass('d-none');
                                } else {
                                    $("#urgent_box").removeClass('d-none');
                                }

                                if (response.featured_property == 'disable') {
                                    $("#featured_box").addClass('d-none');
                                } else {
                                    $("#featured_box").removeClass('d-none');
                                }

                            },
                            error: function(err) {
                                if (err.status == 403) {
                                    toastr.error(err.responseJSON.message);

                                    $("#top_box").addClass('d-none');
                                    $("#urgent_box").addClass('d-none');
                                    $("#featured_box").addClass('d-none');

                                }
                            }
                        })
                    } else {
                        $("#top_box").removeClass('d-none');
                        $("#urgent_box").removeClass('d-none');
                        $("#featured_box").removeClass('d-none');
                    }

                })

                // check agent package availability

                // slug generate and check

                $("#title").on("keyup", function(e) {
                    let slug = convertToSlug($(this).val());
                    $("#slug").val(slug);

                    $.ajax({
                        type: "get",
                        url: "{{ url('/admin/check-slug/') }}" + "/" + slug,
                        success: function(response) {

                        },
                        error: function(err) {
                            if (err.status == 403) {
                                toastr.error(err.responseJSON.message);
                            }
                        }
                    })
                })

                // slug generate and check

                // rent box handle

                $("#purpose").on("change", function() {
                    var purpose = $(this).val()
                    if (purpose == 'rent') {
                        $("#rend_period_box").removeClass('d-none');
                    } else {
                        $("#rend_period_box").addClass('d-none');
                    }
                })

                // rent box handle

                //start dynamic nearest place add and remove

                $("#addNearestPlaceRow").on("click", function() {
                    var new_row = $("#hidden-location-box").html();
                    $("#nearest-place-box").append(new_row)
                })

                $(document).on('click', '.removeNearestPlaceRow', function() {
                    $(this).closest('.delete-dynamic-location').remove();
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

                //end additonal information add and remove

                //start dynamic plan add and remove

                $("#addNewPlan").on("click", function() {
                    var new_row = $("#hidden-plan-box").html();
                    $("#plan-box").append(new_row)
                })

                $(document).on('click', '.removePlanRow', function() {
                    $(this).closest('.delete-dynamic-plan').remove();
                });

                //end dynamic plan  add and remove

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
            let route = "{{ url('/admin/property/city/list/') }}/" + id;
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
                                                    currentMarker); // Remove existing marker
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
