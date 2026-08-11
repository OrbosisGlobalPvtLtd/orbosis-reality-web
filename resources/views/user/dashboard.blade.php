@extends('layout')

@section('title')
    <title>{{__('user.Dashboard')}} - Orbosis Reality</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('user.Dashboard')}}">
    <meta name="description" content="{{__('user.Dashboard')}}">
@endsection

@section('frontend-content')
    <!-- Breadcrumbs -->
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }}); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                            <li class="active"><a href="{{ route('user.dashboard') }}">{{__('user.Dashboard')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Dashboard')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <section class="homec-dashboard pd-top-60 pd-btm-100 homec-bg-third-color">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12 mg-top-30">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-9 col-md-8 col-12 mg-top-30">
                    <div class="homec-dashboard__inner homec-border p-4 bg-white shadow-sm" style="border-radius: 16px;">
                        
                        @if (auth()->user()->is_agency == 2)
                            <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center mb-4" style="border-radius: 12px; background: #fff8e6; color: #8a6d3b;">
                                <i class="fa fa-info-circle me-3 fs-4 text-warning"></i>
                                <div>
                                    <strong>Agent Request Pending:</strong> Your application to become an Agent is currently under admin review.
                                </div>
                            </div>
                        @endif

                        <!-- 1. Welcome Section matching Header UI -->
                        <div class="welcome-banner p-4 mb-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #48aadf 0%, #008cc7 100%); color: #fff;">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bold mb-1 text-white">Welcome back, {{ auth()->user()->name }} 👋</h3>
                                    <p class="mb-0 text-white-50" style="font-size: 14px;">Manage your properties, enquiries, and membership allowance from one place.</p>
                                </div>
                                <div class="mt-3 mt-md-0">
                                    <a href="{{ route('user.choose-property-type') }}" class="btn btn-light fw-bold px-4 py-2 rounded-pill shadow-sm" style="color: #008cc7 !important;">
                                        <i class="fa fa-plus-circle me-1"></i> Post New Property
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Quota & Membership Cards Row -->
                        <div class="row g-3 mb-4">
                            <!-- Free Listing Allowance Card -->
                            <div class="col-lg-6 col-12">
                                <div class="card h-100 border-0 shadow-sm rounded-4 p-4" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold m-0 text-dark">
                                            <i class="fa fa-gift me-2" style="color: #48aadf;"></i> Free Listing Allowance
                                        </h5>
                                        <span class="badge fw-bold px-3 py-1 rounded-pill" style="background: #e6f6ff; color: #008cc7;">Lifetime Free</span>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-between align-items-center">
                                        <span class="text-muted fs-6">Used: <strong>{{ $free_listings_used }} / 5</strong></span>
                                        <span class="fw-bold" style="color: {{ $free_listings_remaining > 0 ? '#008cc7' : '#dc3545' }};">
                                            {{ $free_listings_remaining }} Remaining
                                        </span>
                                    </div>
                                    
                                    <div class="progress mb-3" style="height: 10px; border-radius: 6px; background: #e2e8f0;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ min(100, ($free_listings_used / 5) * 100) }}%; border-radius: 6px; background: linear-gradient(135deg, #48aadf 0%, #008cc7 100%);" aria-valuenow="{{ $free_listings_used }}" aria-valuemin="0" aria-valuemax="5"></div>
                                    </div>

                                    @if ($free_listings_used >= 5)
                                        <p class="small text-danger mb-3 fw-medium">
                                            <i class="fa fa-exclamation-circle me-1"></i> Your 5 lifetime free listings are finished. Purchase a membership plan to post more properties.
                                        </p>
                                        <a href="{{ route('pricing-plan') }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-bold" style="border-color: #48aadf; color: #008cc7;">
                                            View Membership Plans
                                        </a>
                                    @else
                                        <p class="small text-muted mb-0">
                                            Every user gets 5 lifetime free property listings.
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Current Membership Card -->
                            <div class="col-lg-6 col-12">
                                <div class="card h-100 border-0 shadow-sm rounded-4 p-4" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold m-0 text-dark">
                                            <i class="fa fa-id-card text-warning me-2"></i> Current Membership
                                        </h5>
                                        @if ($active_order && !$is_plan_expired)
                                            <span class="badge bg-success text-white fw-bold px-3 py-1 rounded-pill">Active</span>
                                        @else
                                            <span class="badge bg-secondary text-white fw-bold px-3 py-1 rounded-pill">Basic Free</span>
                                        @endif
                                    </div>

                                    @if ($active_order && !$is_plan_expired)
                                        <div class="mb-2">
                                            <h4 class="fw-bold mb-1" style="color: #008cc7;">{{ $active_order->plan_name }} Plan</h4>
                                            <p class="small text-muted mb-2">
                                                Expiry: <strong>{{ $active_order->expiration_date == 'lifetime' ? 'Lifetime' : \Carbon\Carbon::parse($active_order->expiration_date)->format('M d, Y') }}</strong>
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="small text-muted">Paid Quota Used:</span>
                                            <span class="fw-bold small">{{ $paid_listings_used }} / {{ $paid_listings_limit == -1 ? 'Unlimited' : $paid_listings_limit }}</span>
                                        </div>
                                        @if ($paid_listings_limit != -1)
                                            <div class="progress mb-3" style="height: 8px; border-radius: 6px; background: #e2e8f0;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ min(100, ($paid_listings_used / max(1, $paid_listings_limit)) * 100) }}%; border-radius: 6px;"></div>
                                            </div>
                                        @endif
                                        <a href="{{ route('pricing-plan') }}" class="btn btn-sm w-100 rounded-pill fw-bold text-white mt-2 shadow-sm" style="background: linear-gradient(135deg, #48aadf 0%, #008cc7 100%);">
                                            Manage / Upgrade Plan
                                        </a>
                                    @else
                                        <p class="text-muted small mb-3">You are on the <strong>Basic Free Plan</strong>. Upgrade to Silver, Gold, or Premium to get extra listing quotas.</p>
                                        <a href="{{ route('pricing-plan') }}" class="btn btn-warning text-dark btn-sm w-100 rounded-pill fw-bold mt-auto shadow-sm">
                                            Upgrade Membership
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- 3. Real DB Property Statistics -->
                        <h5 class="fw-bold text-dark mb-3"><i class="fa fa-building me-2" style="color: #48aadf;"></i> Property Overview</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4 col-12">
                                <div class="p-3 rounded-4 shadow-sm text-center" style="background: #e6f6ff; border: 1px solid #b3e5ff;">
                                    <div class="fs-2 fw-bold" style="color: #008cc7;">{{ $publish_property }}</div>
                                    <div class="text-muted small fw-semibold">Published Properties</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="p-3 rounded-4 shadow-sm text-center" style="background: #fffbe6; border: 1px solid #ffe58f;">
                                    <div class="fs-2 fw-bold text-warning">{{ $awaiting_property }}</div>
                                    <div class="text-muted small fw-semibold">Awaiting Approval</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="p-3 rounded-4 shadow-sm text-center" style="background: #fff1f0; border: 1px solid #ffccc7;">
                                    <div class="fs-2 fw-bold text-danger">{{ $reject_property }}</div>
                                    <div class="text-muted small fw-semibold">Rejected Properties</div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Real DB User Activity -->
                        <h5 class="fw-bold text-dark mb-3"><i class="fa fa-chart-line text-success me-2"></i> Activity & Engagement</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3 col-6">
                                <div class="p-3 rounded-4 bg-light text-center border">
                                    <i class="fa fa-heart text-danger fs-4 mb-2"></i>
                                    <div class="fw-bold fs-4 text-dark">{{ $total_wishlist }}</div>
                                    <div class="text-muted extra-small">Wishlist</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3 rounded-4 bg-light text-center border">
                                    <i class="fa fa-calendar-check text-success fs-4 mb-2"></i>
                                    <div class="fw-bold fs-4 text-dark">{{ $total_bookings }}</div>
                                    <div class="text-muted extra-small">Bookings</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3 rounded-4 bg-light text-center border">
                                    <i class="fa fa-star text-warning fs-4 mb-2"></i>
                                    <div class="fw-bold fs-4 text-dark">{{ $total_review }}</div>
                                    <div class="text-muted extra-small">Reviews</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3 rounded-4 bg-light text-center border">
                                    <i class="fa fa-receipt text-info fs-4 mb-2"></i>
                                    <div class="fw-bold fs-4 text-dark">{{ $total_purchase }}</div>
                                    <div class="text-muted extra-small">Orders</div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Recent Bookings Table -->
                        @if (count($recent_bookings) > 0)
                            <h5 class="fw-bold text-dark mb-3"><i class="fa fa-history me-2" style="color: #48aadf;"></i> Recent Booking Requests</h5>
                            <div class="table-responsive rounded-3 border">
                                <table class="table table-hover align-middle m-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Property</th>
                                            <th>Date</th>
                                            <th>Time Slot</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_bookings as $booking)
                                            <tr>
                                                <td class="fw-semibold text-dark">{{ $booking->property->title ?? 'Property Item' }}</td>
                                                <td>{{ $booking->booking_date ?? 'N/A' }}</td>
                                                <td>{{ $booking->booking_time ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $booking->status == 'approved' ? 'success' : 'warning' }} px-2 py-1">
                                                        {{ ucfirst($booking->status ?? 'pending') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
