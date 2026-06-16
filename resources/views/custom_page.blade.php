@extends('layout')
@section('title')
    <title>{{ $page->page_name }}</title>
@endsection
@section('meta')
    <meta name="title" content="{{ $page->page_name }}">
    <meta name="description" content="{{ $page->page_name }}">
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
                        <li class="active"><a href="javascript:;">{{ $page->page_name }}</a></li>
                    </ul>
                    <h2 class="breadcrumb__title m-0">{{ $page->page_name }}</h2>
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
                    {!! clean($page->description) !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Single Sidebar -->

@endsection
