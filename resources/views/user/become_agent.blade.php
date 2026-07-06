@extends('layout')

@section('title')
    <title>Become an Agent</title>
@endsection

@section('meta')
    <meta name="title" content="Become an Agent">
    <meta name="description" content="Submit your agency details and start listing properties after admin approval.">
@endsection

@section('frontend-content')
    <!-- Breadcrumbs -->
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
        <div class="container">
            <div class="row">
                <!-- Breadcrumb-Content -->
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{ __('user.Home') }}</a></li>
                            <li class="active"><a href="{{ route('user.become-agent') }}">Become an Agent</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">Become an Agent</h2>
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
                <div class="col-lg-3 col-md-4 col-12 mg-top-30">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-9 col-md-8 col-12 mg-top-30">
                    <div class="mg-btm-30">
                        <h2 style="font-weight: 700; color: #1b2a47; margin-bottom: 5px;">Become an Agent</h2>
                        <p style="color: #666; font-size: 15px;">Submit your agency details and start listing properties after admin approval.</p>
                    </div>

                    <!-- Benefits Info Card -->
                    <div class="card homec-border mg-btm-30" style="border: none; border-radius: 8px; background: #eef2f7; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <div class="card-body" style="padding: 20px;">
                            <h5 style="color: #1b2a47; font-weight: 700; margin-bottom: 12px; font-size: 16px;"><i class="fas fa-gem" style="color: #7065f0; margin-right: 8px;"></i> Agent Account Benefits</h5>
                            <div class="row">
                                <div class="col-sm-6 col-12 mb-2">
                                    <div style="font-size: 14px; font-weight: 500; color: #495057;"><span style="color: #28a745; margin-right: 8px; font-weight: bold;">✓</span> Add Properties</div>
                                </div>
                                <div class="col-sm-6 col-12 mb-2">
                                    <div style="font-size: 14px; font-weight: 500; color: #495057;"><span style="color: #28a745; margin-right: 8px; font-weight: bold;">✓</span> Manage Listings</div>
                                </div>
                                <div class="col-sm-6 col-12 mb-2">
                                    <div style="font-size: 14px; font-weight: 500; color: #495057;"><span style="color: #28a745; margin-right: 8px; font-weight: bold;">✓</span> Handle Enquiries</div>
                                </div>
                                <div class="col-sm-6 col-12 mb-2">
                                    <div style="font-size: 14px; font-weight: 500; color: #495057;"><span style="color: #28a745; margin-right: 8px; font-weight: bold;">✓</span> Manage Bookings</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (auth()->user()->is_agency == 2)
                        <div class="homec-submit-form text-center" style="padding: 50px 30px; border-radius: 8px; background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #eceaff;">
                            <div style="font-size: 54px; color: #ffc107; margin-bottom: 20px;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 style="font-weight: 700; color: #1b2a47; margin-bottom: 10px;">Your agent application is under review.</h3>
                            <p style="color: #666; font-size: 16px; margin-bottom: 0;">Our administrative team is verifying your agency credentials. We will notify you once approved.</p>
                        </div>
                    @else
                        <form action="{{ route('user.become-agent.submit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="homec-submit-form">
                                <h4 class="homec-submit-form__title">Agency Information</h4>
                                <div class="homec-submit-form__inner">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Company Name -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">Company Name *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="e.g. Acme Corporation" value="{{ old('company_name') }}" name="company_name" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Agency Name -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">Agency Name *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="e.g. Premier Reality" name="agency_name" value="{{ old('agency_name') }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Phone -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">Phone *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="+1234567890" name="phone" value="{{ old('phone') }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- State -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">State *</h4>
                                                <div class="form-group homec-form-input">
                                                    <select name="state_id" class="homec-form-select homec-border" style="width: 100%; height: 50px; padding: 10px;" required>
                                                        <option value="">Select State</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- City -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">City *</h4>
                                                <div class="form-group homec-form-input">
                                                    <select name="city_id" class="homec-form-select homec-border" style="width: 100%; height: 50px; padding: 10px;" required>
                                                        <option value="">Select City</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- RERA Number -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">RERA Number (Optional)</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="RERA-12345" name="rera_number" value="{{ old('rera_number') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- GST Number -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">GST Number (Optional)</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="text" placeholder="GST-998877" name="gst_number" value="{{ old('gst_number') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <!-- Address -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">Address *</h4>
                                                <div class="form-group homec-form-input">
                                                    <textarea rows="3" name="address" placeholder="Agency street address..." required>{{ old('address') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <!-- About Agency -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">About Agency *</h4>
                                                <div class="form-group homec-form-input">
                                                    <textarea rows="4" name="about_agency" placeholder="Tell us about your agency..." required>{{ old('about_agency') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <!-- Logo Upload -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">Logo Upload *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="file" name="logo" class="pt-2" accept="image/*" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <!-- ID Proof -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">ID Proof *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="file" name="id_proof" class="pt-2" accept=".pdf,image/*" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <!-- Business Documents -->
                                            <div class="mg-top-20">
                                                <h4 class="homec-submit-form__heading">Business Documents *</h4>
                                                <div class="form-group homec-form-input">
                                                    <input type="file" name="business_documents" class="pt-2" accept=".pdf,image/*,.doc,.docx,.zip" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row h-b-t mg-top-30">
                                <div class="col-12 d-flex justify-content-end p-0">
                                    <button type="submit" class="homec-btn homec-btn__second">
                                        <span>Submit Application</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
