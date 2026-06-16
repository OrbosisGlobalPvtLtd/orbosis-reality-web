@extends('layout')
@section('title')
    <title>{{ $blog->title }}</title>
@endsection
@section('meta')
    <meta name="title" content="{{ $blog->seo_title }}">
    <meta name="description" content="{{ $blog->seo_description }}">
    <meta name="keywords" content="{{ $blog->seo_title }}">
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
                            <li class="active"><a href="{{ route('blogs') }}">{{__('user.Blogs')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Blog Details')}}</h2>
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
					<div class="col-lg-8 col-12 mg-top-30">
						<div class="homec-blog-meta">
                            <ul class="homec-blog-meta__list list-none">
								<li><img src="{{ asset('frontend/img/user-icon.svg') }}" alt="user"> <a href="javascript:;">{{ $blog->admin->name }}</a></li>
								<li><img src="{{ asset('frontend/img/calendar.svg') }}" alt="calendar"> {{ $blog->created_at->format('M d, Y') }}</li>
                                <li><img src="{{ asset('frontend/img/comment.svg') }}" alt="comment"> {{ $blog->total_comment }} {{__('user.Comment')}}</li>
                            </ul>
                        </div>
                        <div class="homec-blog-content">
                            <div>
                                <img src="{{ ($blog->image)? asset($blog->image) : asset($setting->default_placeholder)}}" alt="">
                            </div>
                            <h1 class="homec-blog-content__title">{{ $blog->title }}</h1>

                            {!! clean($blog->description) !!}
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="homec-blog-detail__bar">
                                    <div class="homec-blog-detail__meta">
                                        <h4 class="homec-blog-detail__meta--title m-0">{{__('user.Tags')}}:</h4>
                                        <ul class="homec-blog-detail__tag list-none">
                                            @foreach ($blog_tag_array as $blog_tag)
                                            <li><a href="javascript:;">#{{ $blog_tag }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="homec-blog-detail__meta">
                                        <h4 class="homec-blog-detail__meta--title m-0">{{__('user.Share')}}:</h4>
										<ul class="homec-social homec-social__sidebar homec-social__sidebar--v2">
											<li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('blog', $blog->slug) }}&title={{ $blog->title }}"><i class="fab fa-linkedin-in"></i></a></li>
											<li><a href="https://twitter.com/share?text={{ $blog->title }}&url={{ route('blog', $blog->slug) }}"><i class="fab fa-twitter"></i></a></li>
											<li><a href="https://www.pinterest.com/pin/create/button/?description={{ $blog->title }}&media=&url={{ route('blog', $blog->slug) }}"><i class="fab fa-pinterest"></i></a></li>
											<li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog', $blog->slug) }}&t={{ $blog->title }}"><i class="fab fa-facebook-f"></i></a></li>
										</ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mg-top-60">
                                <div class="homec-blog-comments">
                                    <h2 class="homec-blog-detail__title m-0">{{ $blog->total_comment }} {{__('user.Comment')}}</h2>

                                    @foreach ($blog_comments as $blog_comment)
                                    <!-- Single Comment -->
                                    <div class="homec-blog-comments__single mg-top-30">
                                        <img src="http://www.gravatar.com/avatar" alt="avatar">
                                        <div class="homec-blog-comments__detail">
                                            <h4 class="homec-blog-comments__title">{{ html_decode($blog_comment->name) }} <span><i class="fa-solid fa-clock"></i> {{ $blog_comment->created_at->format('d M Y, h:iA') }}</span> </h4>
                                            <p class="homec-blog-comments__text">{{ html_decode($blog_comment->comment) }}</p>
                                        </div>
                                    </div>
                                    <!-- End Single Comment -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="homec-comments-form mg-top-60">
                                    <h2 class="homec-comments-form__title m-0">{{__('user.Submit new comment')}}</h2>
									<p class="homec-comments-form__text">{{__('user.Your email address will not be published. Required fields are marked')}} *</p>
                                    <form id="blogCommentForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group homec-form-input">
                                                    <input class="ecom-wc__form-input" type="text" name="name" placeholder="{{__('user.Name')}} *">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group homec-form-input">
                                                    <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('user.Email')}} *">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group homec-form-input">
                                                    <textarea class="ecom-wc__form-input" name="comment" placeholder="{{__('user.Type here')}} *"></textarea>
                                                </div>
                                            </div>

                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                                            @if($recaptcha_setting->status==1)
                                                <div class="col-12">
                                                    <div class="form-group homec-form-input">
                                                        <div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-12 d-flex mg-top-20">
                                                <button type="submit" class="homec-btn homec-btn__second"><span>{{__('user.Submit Now')}}</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-lg-4 col-12">
                        <div class="homec-sidebar">
							<!-- Blog Single Sidebar -->
							<div class="homec-sidebar__single blog-search mg-top-30">
								<form action="{{ route('blogs') }}">
                                    <div class="form">
                                        <input type="text" name="search" placeholder="{{__('user.Search Here')}}...">
                                        <button class="button" type="submit"><i class="fa fa-search"></i> </button>
                                    </div>
                                </form>
							</div>

							<!-- Blog Single Sidebar -->
							<div class="homec-sidebar__single recent-post">
								<h3 class="homec-sidebar__title">{{__('user.Popular Blog')}}</h3>
                                @foreach ($popular_blogs as $popular_blog)
                                    <!-- Sidebar Post -->
                                    <div class="homec-sidebar__post">
                                        <div class="homec-sidebar__img"><img src="{{ ($popular_blog->image)? asset($popular_blog->image) : asset($setting->default_placeholder)}}" alt="image"></div>
                                        <div class="homec-sidebar__content">
                                            <h5 class="homec-sidebar__content--title"><a href="{{ route('blog', $popular_blog->slug) }}">{{ $popular_blog->title }}</a></h5>
                                            <div class="homec-sidebar__content--date"><img src="{{ asset('frontend/img/calendar.svg') }}" alt="calendar">{{ $popular_blog->created_at->format('M d, Y') }} </div>
                                        </div>
                                    </div>
                                    <!-- End Sidebar Post -->
                                @endforeach

						   </div>
						   <!-- Blog Single Sidebar -->
						   <div class="homec-sidebar__single">
							  <h3 class="homec-sidebar__title">{{__('user.Blog Categories')}}</h3>
							  <ul class="homec-sidebar__category list-none">
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('blogs',['category' => $category->slug]) }}">{{ $category->name }}<span>({{ $category->totalBlog }})</span></a></li>
                                @endforeach
							  </ul>
						   </div>
						   <!-- Blog Single Sidebar -->
						   <div class="homec-sidebar__single side-tags">
							  <h3 class="homec-sidebar__title">{{__('user.Follow Us')}}</h3>
								<ul class="homec-social homec-social__sidebar">
                                    @foreach ($social_links as $social_link)
                                        <li><a href="{{ $social_link->link }}"><i class="{{ $social_link->icon }}"></i></a></li>
                                    @endforeach
								</ul>
						   </div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Blog Single Sidebar -->

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
            (function($) {
                "use strict";
                $(document).ready(function () {
                    $("#blogCommentForm").on('submit', function(e){
                        e.preventDefault();
                        var isDemo = "{{ env('APP_MODE') }}"
                        if(isDemo == 'DEMO'){
                            toastr.error('This Is Demo Version. You Can Not Change Anything');
                            return;
                        }
                        $.ajax({
                            type: 'POST',
                            data: $('#blogCommentForm').serialize(),
                            url: "{{ route('blog-comment') }}",
                            success: function (response) {
                                if(response.status == 1){
                                    toastr.success(response.message)
                                    $("#blogCommentForm").trigger("reset");
                                }
                            },
                            error: function(response) {
                                if(response.responseJSON.errors.name)toastr.error(response.responseJSON.errors.name[0])
                                if(response.responseJSON.errors.email)toastr.error(response.responseJSON.errors.email[0])
                                if(response.responseJSON.errors.comment)toastr.error(response.responseJSON.errors.comment[0])

                                if(!response.responseJSON.errors.name && !response.responseJSON.errors.email && !response.responseJSON.errors.comment){
                                    toastr.error("{{__('user.Please complete the recaptcha to submit the form')}}")
                                }
                            }
                        });
                    })

                });
            })(jQuery);

        </script>

@endsection
