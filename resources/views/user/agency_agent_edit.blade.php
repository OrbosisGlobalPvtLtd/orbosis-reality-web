
@extends('layout')

@section('title')
    <title>{{__('user.Edit Agent')}}</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('user.Edit Agent')}}">
    <meta name="description" content="{{__('user.Edit Agent')}}">
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
                            <li class="active"><a href="{{ route('user.my-company') }}">{{__('user.Edit Agent')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Edit Agent')}}</h2>
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
                        <form action="{{ route('user.agency-agent-update', ['id' => $agent->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="homec-submit-form">
                                        <h4 class="homec-submit-form__title">{{__('user.Agent Information')}}</h4>
                                        <div class="homec-submit-form__inner">
                                            <div class="row">
                                                <div class="col-12">
                                                    <!-- Single Form Element -->
                                                    <div class="mg-top-20">
                                                        <h4 class="homec-submit-form__heading">{{__('user.Name')}}*</h4>
                                                        <div class="form-group homec-form-input">
                                                            <input type="text" placeholder="Name" value="{{$agent->name}}" name="name" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <!-- Single Form Element -->
                                                    <div class="mg-top-20">
                                                        <h4 class="homec-submit-form__heading">{{__('user.Designation')}}*</h4>
                                                        <div class="form-group homec-form-input">
                                                            <input type="text" placeholder="Real State Company" name="designation" value="{{$agent->designation}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.About')}}*</h4>
                                                <div class="form-group homec-form-input">
                                                    <textarea rows="3" name="about_me" placeholder="This is best agency">{{$agent->about_me}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="homec-submit-form">
                                        <h4 class="homec-submit-form__title">{{__('user.Agent Profile')}}</h4>
                                        <div class="homec-submit-form__inner">
                                            <div class="row">
                                                <div class="mg-top-20">
                                                    <p class="homec-img-video-label mg-btm-10">{{__('user.Image')}}*</span></p>
                                                    <!-- Image Input -->
                                                    <div class="homec-image-video-upload homec-border">
                                                        <input type="file" class="btn-check" id="input-video1" name="image">
                                                        <label class="homec-image-video-upload__label" for="input-video1">
                                                            <img src="{{ asset($agent->image) }}" alt="#">
                                                            <span class="homec-image-video-upload__title">{{__('user.Please')}} <span class="homec-primary-color">{{__('user.Choose File')}}</span> {{__('user.to upload')}} </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="homec-submit-form mg-top-40">
                                <h4 class="homec-submit-form__title">{{__('user.Contact Info')}}</h4>
                                <div class="homec-submit-form__inner">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.Email address')}}* </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="email" placeholder="test@email.com" name="email" value="{{$agent->email}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading"> {{__('user.Phone number')}}* </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="tel" placeholder="+880123456" name="phone" value="{{$agent->phone}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.Facebook')}} </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="www.facebook.com" name="facebook" value="{{$agent->facebook}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.Instagram')}} </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="www.instagram.com" name="instagram" value="{{$agent->instagram}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.Twitter')}} </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="www.twitter.com" name="twitter" value="{{$agent->twitter}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Single Form Element -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">{{__('user.Linkedin')}} </h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="www.linkedin.com" name="linkedin" value="{{$agent->linkedin}}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="homec-submit-form mg-top-40">
                                <h4 class="homec-submit-form__title">{{__('user.Agent Location')}}</h4>
                                <div class="homec-submit-form__inner">
                                    <div class="row">

                                    <div class="col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Address')}}*</h4>
                                            <div class="form-group homec-form-input">
                                                <textarea rows="3" name="address" placeholder="Usa, Calefornia">{{$agent->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>

                            <div class="admin-item">
                                <div class="admin-item_text">
                                    <p>{{__('user.Agent Status')}}</p>
                                </div>

                                <label class="homeco__item-switch">
                                    <input type="checkbox"  {{ $agent->status == 1 ? 'checked' : '' }}  name="status">
                                    <span class="homeco__item-switch--slide homeco__item-switch--round"></span>
                                </label>
                                <p class="homeco-switcher-group__text">{{__('user.Enable / Disable')}}</p>
                            </div>

                            <div class="row h-b-t">
                                <div class="col-12  d-flex justify-content-end p-0">
                                    <button type="submit" class="homec-btn homec-btn__second"><span>{{__('user.Update')}}</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</section>
		<!-- End Dashboard -->

@endsection
