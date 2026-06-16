@extends('layout')

@section('title')
    <title>{{ __('user.My Company') }}</title>
@endsection

@section('meta')
    <meta name="title" content="{{ __('user.My Company') }}">
    <meta name="description" content="{{ __('user.My Company') }}">
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
                            <li class="active"><a href="{{ route('user.my-company') }}">{{ __('user.My Company') }}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{ __('user.My Company') }}</h2>
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
                    <div class="homec-dashboard__middle">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-12 mg-top-30">
                                @include('user.sidebar')
                            </div>
                            <div class="col-lg-9 col-md-8 col-12 mg-top-30">
                                <div class="homec-dashboard__inner homec-border">
                                    <h3 class="homec-dashboard__heading m-0">@if($user->is_agency == 0 || $user->is_agency == 2){{ __('user.Apply for agency') }} @elseif($user->is_agency == 1) {{ __('user.My Company') }} @endif @if($user->is_agency == 2) <span class="text-danger">({{ __('user.You Already Applied For Agency') }})</span> @endif</h3>
                                    @if ($user->is_agency == 0)
                                        <div class="add_agents_main mg-top-30">
                                            <div class="add_agents_thumb_main">
                                                <div class="add_agents_thumb_thumb">
                                                    <img src="{{ asset('frontend/img/add-agent.png') }}" alt="thumb">
                                                </div>
                                            </div>

                                            <div class="add_agents_text">
                                                <h3>{{ __('user.Add Company') }}</h3>
                                            </div>

                                            <div class="add_agents_btn">
                                                <a href="{{ route('user.create-company') }}"
                                                    class="homec-btn">{{ __('user.Add Company') }}</a>
                                            </div>

                                        </div>
                                    @else
                                    <div class="add_agents_main mg-top-30">
                                        <div class="add_agents_thumb_main">
                                            <div class="add_agents_thumb_thumb">
                                                <img src="{{ asset('frontend/img/add-agent.png') }}" alt="thumb">
                                            </div>
                                        </div>
                                        @if(!$user->is_agency == 2)
                                            <div class="add_agents_text">
                                                <h3>{{ __('user.Add Company') }}</h3>
                                            </div>

                                            <div class="add_agents_btn">
                                                <a href="{{ route('user.create-company') }}"
                                                    class="homec-btn">{{ __('user.Add Company') }}</a>
                                            </div>
                                        @endif

                                    </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Dashboard -->
@endsection
