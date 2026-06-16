@extends('admin.master_layout')
@section('title')
    <title>{{ __('admin.About Us') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('admin.About Us') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('admin.Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('admin.About Us') }}</div>
                </div>
            </div>

            @include('template-part.admin_lang_switcer')

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('admin.update-about-us') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="lang_code"
                                        value="{{ request('lang_code') ?? admin_lang() }}">

                                    @if (admin_lang() === 'en')
                                        <div class="form-group">
                                            <label for="">{{ __('admin.Background Image') }}</label>
                                            <div>
                                                <img class="w_220" src="{{ asset($about->background_image) }}"
                                                    alt="">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="">{{ __('admin.New background') }}</label>
                                            <input type="file" name="background_image" class="form-control-file">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Experience text') }}</label>

                                        <input type="text" class="form-control" name="experience_text_1"
                                            value="{{ $about->experience_text_1 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('admin.Experience text') }}</label>
                                        <input type="text" class="form-control" name="experience_text_2"
                                            value="{{ $about->experience_text_2 }}">
                                    </div>

                                    @if (admin_lang() === 'en')
                                        <div class="form-group">
                                            <label for="">{{ __('admin.Author Image') }}</label>
                                            <div>
                                                <img class="w_220" src="{{ asset($about->author_image) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('admin.New Image') }}</label>
                                            <input type="file" name="author_image" class="form-control-file">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Author name') }}</label>
                                        <input type="text" class="form-control" name="author_name"
                                            value="{{ $about->author_name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('admin.Author designation') }}</label>
                                        <input type="text" class="form-control" name="author_designation"
                                            value="{{ $about->author_designation }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('admin.Short title') }}</label>
                                        <input type="text" class="form-control" name="short_title"
                                            value="{{ $about->short_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('admin.Long Title') }}</label>
                                        <input type="text" class="form-control" name="long_title"
                                            value="{{ $about->long_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('admin.Description one') }}</label>
                                        <textarea name="description_1" class="form-control text-area-5" cols="30" rows="10">{{ $about->description_1 }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('admin.Description two') }}</label>
                                        <textarea name="description_2" class="form-control text-area-5" cols="30" rows="10">{{ $about->description_2 }}</textarea>
                                    </div>

                                    @if (admin_lang() === 'en')
                                        <div class="form-group">
                                            <label for="">{{ __('admin.Item one icon') }}</label>

                                            <div>
                                                <img src="{{ asset($about->item1_icon) }}" alt="" class="w_80">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('admin.New icon') }}</label>
                                            <input type="file" class="form-control-file" name="item1_icon">
                                        </div>
                                    @endif
                                    <div class="row">
                                        @if (admin_lang() === 'en')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{ __('admin.Item one number') }}</label>
                                                    <input type="text" class="form-control" name="item1_title"
                                                        value="{{ $about->item1_title }}">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Item one title') }}</label>
                                                <input type="text" class="form-control" name="item1_title2"
                                                    value="{{ $about->item1_title2 }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label for="">{{ __('admin.Item one description') }}</label>
                                        <input type="text" class="form-control" name="item1_description"
                                            value="{{ $about->item1_description }}">
                                    </div>
                                    @if (admin_lang() === 'en')
                                        <div class="form-group">
                                            <label for="">{{ __('admin.Item two icon') }}</label>

                                            <div>
                                                <img src="{{ asset($about->item2_icon) }}" alt=""
                                                    class="w_80">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('admin.New icon') }}</label>
                                            <input type="file" class="form-control-file" name="item2_icon">
                                        </div>
                                    @endif

                                    <div class="row">
                                        @if (admin_lang() === 'en')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{ __('admin.Item two number') }}</label>
                                                    <input type="text" class="form-control" name="item2_title"
                                                        value="{{ $about->item2_title }}">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('admin.Item two title') }}</label>
                                                <input type="text" class="form-control" name="item2_title2"
                                                    value="{{ $about->translate(admin_lang(), 'item2_title2') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('admin.Item two description') }}</label>
                                        <input type="text" class="form-control" name="item2_description"
                                            value="{{ $about->translate(admin_lang(), 'item2_description') }}">
                                    </div>

                                    <button class="btn btn-primary">{{ __('admin.Update') }}</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
