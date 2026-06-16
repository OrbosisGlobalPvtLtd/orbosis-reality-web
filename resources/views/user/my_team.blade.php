@extends('layout')

@section('title')
    <title>{{ __('user.My Team') }}</title>
@endsection

@section('meta')
    <meta name="title" content="{{ __('user.My Team') }}">
    <meta name="description" content="{{ __('user.My Team') }}">
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
                            <li class="active"><a href="{{ route('user.my-team') }}">{{ __('user.My Team') }}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{ __('user.My Team') }}</h2>
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
                            @if ($agents->count() > 0)
                            <div class="col-lg-9 col-md-8 col-12 mg-top-30">
                                <div class="homec-dashboard__inner  homec-border">
                                    <div class="homec-dashboard__inner_df">
                                        <h3 class="homec-dashboard__heading m-0">{{ __('user.My Team') }}</h3>
                                        <a href="{{ route('user.create-agent') }}" class="homec-btn">{{ __('user.Add Member') }}</a>
                                    </div>

                                    <div class="row">
                                        @foreach($agents ?? [] as $agent)
                                        <div class="col-lg-6 col-md-6 col-12 mg-top-30 aos-init aos-animate"
                                            data-aos="fade-in" data-aos-delay="400">
                                            <!-- Single agent-->
                                            <div class="homec-agent homec-agent__v2">

                                                <div class="homec-agent__body_btn">


                                                    <a href="javascript:;" onclick="deleteAgent({{ $agent->id }})" class="edit_btn delet_btn">
                                                        <span>
                                                            <svg width="15" height="15" viewBox="0 0 16 21" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M4.86625 0.952615C4.86628 0.803061 4.92128 0.659637 5.01915 0.55386C5.11703 0.448082 5.24978 0.388606 5.38824 0.388501L10.6078 0.388184C10.7462 0.38853 10.879 0.448171 10.9768 0.554033C11.0746 0.659895 11.1296 0.803342 11.1297 0.952933V2.34732H4.86625V0.952615ZM13.4482 19.9103C13.4348 20.1302 13.3442 20.3363 13.1949 20.4863C13.0455 20.6364 12.8487 20.7191 12.6447 20.7176H3.29125C3.08734 20.717 2.89117 20.6331 2.74216 20.4827C2.59315 20.3323 2.50232 20.1266 2.48791 19.9069L1.68751 7.2596H14.3024L13.4483 19.9102L13.4482 19.9103ZM15.5276 6.11414H0.46875V4.80382C0.468974 4.45629 0.596861 4.12307 0.824333 3.8773C1.05181 3.63154 1.36027 3.49333 1.682 3.49302L14.3142 3.49258C14.6359 3.49311 14.9442 3.63145 15.1717 3.87724C15.3991 4.12303 15.5269 4.4562 15.5272 4.8037V6.11402L15.5276 6.11414ZM5.57347 17.7026C5.57347 17.7778 5.58718 17.8523 5.61382 17.9217C5.64047 17.9912 5.67952 18.0543 5.72874 18.1075C5.77797 18.1607 5.83642 18.2029 5.90074 18.2317C5.96506 18.2604 6.03399 18.2753 6.10361 18.2753C6.17323 18.2753 6.24217 18.2604 6.30649 18.2317C6.37081 18.2029 6.42925 18.1607 6.47848 18.1075C6.52771 18.0543 6.56676 17.9912 6.5934 17.9217C6.62005 17.8523 6.63376 17.7778 6.63376 17.7026V9.67202C6.63264 9.521 6.57633 9.37657 6.47709 9.27018C6.37785 9.16379 6.24371 9.10407 6.10389 9.10402C5.96407 9.10397 5.82989 9.16359 5.73058 9.2699C5.63127 9.37621 5.57486 9.5206 5.57365 9.67163V17.7026H5.57347ZM9.35602 17.7026C9.35602 17.8545 9.41188 18.0002 9.51132 18.1076C9.61075 18.215 9.74562 18.2753 9.88624 18.2753C10.0269 18.2753 10.1617 18.215 10.2612 18.1076C10.3606 18.0002 10.4165 17.8545 10.4165 17.7026V9.67202C10.4153 9.52098 10.359 9.37652 10.2598 9.27012C10.1605 9.16372 10.0264 9.10399 9.88651 9.10394C9.74667 9.10389 9.61248 9.16352 9.51315 9.26984C9.41383 9.37617 9.35742 9.52058 9.3562 9.67163L9.35602 17.7026Z">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </a>

                                                    <form class="d-none" action="{{ route('user.agency-agent-destroy', $agent->id) }}" method="POST" id="remove_agent-{{ $agent->id }}">
                                                        @csrf
                                                        @method('DELETE')

                                                    </form>

                                                    <a href="{{ route('user.agency-agent-edit', ['id' => $agent->id]) }}" class="edit_btn">
                                                        <span>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M2.5 17.5H17.5M11.487 4.42643C11.487 4.42643 11.487 5.78861 12.8492 7.1508C14.2114 8.51299 15.5736 8.51299 15.5736 8.51299M6.09969 14.9901L8.96028 14.5814C9.37291 14.5225 9.7553 14.3313 10.05 14.0365L16.9358 7.1508C17.6881 6.39848 17.6881 5.17874 16.9358 4.42642L15.5736 3.06424C14.8213 2.31192 13.6015 2.31192 12.8492 3.06424L5.96347 9.94997C5.66873 10.2447 5.47754 10.6271 5.41859 11.0397L5.00994 13.9003C4.91913 14.536 5.464 15.0809 6.09969 14.9901Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                        </span>
                                                    </a>


                                                </div>
                                                <!-- Agent Head-->
                                                <div class="homec-agent__head">
                                                    <img src="{{ asset($agent->image) }}" alt="#">
                                                </div>
                                                <!-- Agent Body -->
                                                <div class="homec-agent__body">
                                                    <ul class="homec-agent__social list-none">
                                                        @if (isset($agent->linkedin))
                                                        <li><a href="{{ $agent->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                                    @endif

                                                    @if (isset($agent->twitter))
                                                        <li><a href="{{ $agent->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                                    @endif

                                                    @if (isset($agent->instagram))
                                                        <li><a href="{{ $agent->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                                    @endif

                                                    @if (isset($agent->facebook))
                                                        <li><a href="{{ $agent->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                                    @endif
                                                    </ul>
                                                    <a class="homec-agent__body--btn" href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => html_decode($agent->user_name)]) }}">{{ __('user.See') }}
                                                        {{ __('user.Properties') }}</a>
                                                <h4 class="homec-agent__title">
                                                    <a href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => html_decode($agent->user_name)]) }}">{{ $agent->name }}</a>
                                                    <span>{{$agent->designation}}</span></h4>
                                                </div>
                                                <!-- End Agent Body -->
                                            </div>
                                            <!-- End Single agent-->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-lg-9 col-md-8 col-12 mg-top-30">
                                <div class="homec-dashboard__inner homec-border">
                                    <h3 class="homec-dashboard__heading m-0">{{ __('user.Agent') }}</h3>

                                    <div class="add_agents_main mg-top-30">
                                        <div class="add_agents_thumb_main">
                                            <div class="add_agents_thumb_thumb">
                                                <img src="{{ asset('frontend/img/add-agent.png') }}" alt="thumb">
                                            </div>
                                        </div>

                                        <div class="add_agents_text">
                                            <h3>{{ __('user.Add Agent') }}</h3>
                                        </div>

                                        <div class="add_agents_btn">
                                            <a href="{{ route('user.create-agent') }}"
                                                class="homec-btn">{{ __('user.Add Agent') }}</a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Dashboard -->

    <script>
        "use strict";
        function deleteAgent(id){
            Swal.fire({
                title: "{{__('user.Are you realy want to delete this item ?')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('user.Yes, Delete It')}}",
                cancelButtonText: "{{__('user.Cancel')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#remove_agent-"+id).submit();
                }

            })
        }
    </script>
@endsection
