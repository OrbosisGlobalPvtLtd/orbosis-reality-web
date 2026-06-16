@extends('layout')
@section('title')
    <title>{{__('user.Privacy Policy')}}</title>
@endsection
@section('meta')
    <meta name="title" content="{{__('user.Privacy Policy')}}">
     <meta name="description" content="{{__('user.Privacy Policy')}}">
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
                        <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                        <li class="active"><a href="{{ route('privacy-policy') }}">{{__('user.Privacy Policy')}}</a></li>
                    </ul>
                    <h2 class="breadcrumb__title m-0">{{__('user.Privacy Policy')}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

    <!-- Blog Single Sidebar -->
    <section class="blog-single pd-top-70 pd-btm-100">
        <div class="container">
            <div class="row">
                <div class="col-12 mg-top-30">
                    <div class="homec-blog-content">
                        @if ($privacyPolicy)
                            {!! clean($privacyPolicy) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End Blog Single Sidebar -->

@endsection
