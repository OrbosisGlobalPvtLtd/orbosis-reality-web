@extends('layout')
@section('title')
    <title>{{__('user.Terms and conditions')}}</title>
@endsection
@section('meta')
    <meta name="title" content="{{__('user.Terms and conditions')}}">
    <meta name="description" content="{{__('user.Terms and conditions')}}">
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
                        <li class="active"><a href="{{ route('terms-and-conditions') }}">{{__('user.Terms and conditions')}}</a></li>
                    </ul>
                    <h2 class="breadcrumb__title m-0">{{__('user.Terms and conditions')}}</h2>
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
                            @if ($terms_conditions)
                                {!! clean($terms_conditions) !!}
                            @endif
                        </div>
					</div>
				</div>
			</div>
		</section>
	<!-- End Blog Single Sidebar -->

@endsection
