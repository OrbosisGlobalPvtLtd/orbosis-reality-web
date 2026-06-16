@extends('admin.master_layout')
@section('title')
    <title>{{ __('admin.Edit Property Type') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('admin.Edit Property Type') }}</h1>
            </div>
            @include('template-part.admin_lang_switcer')
            <div class="section-body">
                <a href="{{ route('admin.category.index') }}" class="btn btn-primary"><i class="fas fa-list"></i>
                    {{ __('admin.Property Type') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.category.update', $category->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="lang_code" value="{{ admin_lang() }}">

                                    <div class="row">
                                        @if (admin_lang() === 'en')
                                            <div class="form-group col-12">
                                                <label>{{ __('admin.Existing Icon') }}</label>
                                                <div>
                                                    <img src="{{ asset($category->icon) }}" class="w_80" alt="">
                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('admin.Icon') }}</label>
                                                <input type="file" class="form-control-file" name="icon">
                                            </div>
                                        @endif
                                        <div class="form-group col-12">
                                            <label>{{ __('admin.Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ $category->name }}">
                                        </div>
                                        @if (admin_lang() === 'en')
                                            <div class="form-group col-12">
                                                <label>{{ __('admin.Slug') }} <span class="text-danger">*</span></label>
                                                <input type="text" id="slug" class="form-control" name="slug"
                                                    value="{{ $category->slug }}">
                                            </div>


                                            <div class="form-group col-12">
                                                <label>{{ __('admin.Status') }} <span class="text-danger">*</span></label>
                                                <select name="status" class="form-control">
                                                    <option {{ $category->status == 1 ? 'selected' : '' }} value="1">
                                                        {{ __('admin.Active') }}</option>
                                                    <option {{ $category->status == 0 ? 'selected' : '' }} value="0">
                                                        {{ __('admin.InActive') }}</option>
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary">{{ __('admin.Update') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#name").on("focusout", function(e) {
                    $("#slug").val(convertToSlug($(this).val()));
                })
            });
        })(jQuery);

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    </script>
@endsection
