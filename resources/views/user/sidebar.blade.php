@php
    $user = Auth::guard('web')->user();
    $user_company = \App\Models\CompanyProfile::where('user_id', $user->id)->first();
@endphp

<style>
    .homec-list-tabs.homec-list-tabs--v3 .list-group-item {
        padding: 12px 18px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        gap: 12px !important;
        border-bottom: 1px solid #f1f3f7 !important;
        transition: all 0.2s ease-in-out !important;
        border-radius: 8px !important;
        margin-bottom: 4px !important;
        color: #475569 !important;
    }
    .homec-list-tabs.homec-list-tabs--v3 .list-group-item:hover,
    .homec-list-tabs.homec-list-tabs--v3 .list-group-item.active {
        background: linear-gradient(135deg, #48aadf 0%, #008cc7 100%) !important;
        color: #ffffff !important;
        border-color: transparent !important;
        box-shadow: 0 4px 12px rgba(72, 170, 223, 0.25) !important;
    }
    .homec-dashboard__list--icon {
        width: 32px !important;
        height: 32px !important;
        min-width: 32px !important;
        background: #f1f5f9 !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.2s ease-in-out !important;
    }
    .homec-list-tabs.homec-list-tabs--v3 .list-group-item:hover .homec-dashboard__list--icon,
    .homec-list-tabs.homec-list-tabs--v3 .list-group-item.active .homec-dashboard__list--icon {
        background: rgba(255, 255, 255, 0.25) !important;
    }
    .homec-dashboard__list--icon i {
        font-size: 14px !important;
        color: #48aadf !important;
        transition: all 0.2s ease-in-out !important;
    }
    .homec-list-tabs.homec-list-tabs--v3 .list-group-item:hover i,
    .homec-list-tabs.homec-list-tabs--v3 .list-group-item.active i {
        color: #ffffff !important;
    }
    .sidebar-section-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        padding: 12px 18px 4px 18px;
        margin-top: 6px;
    }
</style>

<div class="list-group homec-list-tabs homec-list-tabs--v3 homec-border p-2 bg-white rounded-4 shadow-sm">
    
    <!-- DASHBOARD -->
    <a href="{{ route('user.dashboard') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.dashboard') || Route::is('agent.dashboard') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-chart-pie"></i>
        </div>
        <span>Dashboard</span>
    </a>

    <!-- PROPERTY SECTION -->
    <div class="sidebar-section-title">Property</div>

    <a href="{{ route('user.property.index') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.property.*') && !Route::is('user.choose-property-type') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-building"></i>
        </div>
        <span>My Properties</span>
    </a>

    <a href="{{ route('user.choose-property-type') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.choose-property-type') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-circle-plus"></i>
        </div>
        <span>Add Property</span>
    </a>

    <!-- ACTIVITY / BUSINESS SECTION -->
    <div class="sidebar-section-title">{{ $user->login_type === 'user' ? 'Activity' : 'Business' }}</div>

    <a href="{{ route('user.property-booking') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.property-booking') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
        <span>{{ $user->login_type === 'user' ? 'My Enquiries' : 'Booking Requests' }}</span>
    </a>

    <a href="{{ route('user.my-booking') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.my-booking') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <span>My Booking</span>
    </a>

    <a href="{{ route('user.wishlist') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.wishlist') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-heart"></i>
        </div>
        <span>Wishlist</span>
    </a>

    <a href="{{ route('user.compare') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.compare') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-code-compare"></i>
        </div>
        <span>Compare</span>
    </a>

    <a href="{{ route('user.my-reviews') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.my-reviews') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-star"></i>
        </div>
        <span>My Reviews</span>
    </a>

    <!-- COMPANY / PROFESSIONAL SECTION -->
    @if ($user->login_type === 'agent' || $user->is_agency == 1 || $user_company)
        <div class="sidebar-section-title">Company & Team</div>

        @if ($user_company || $user->is_agency == 1)
            <a href="{{ $user->profile ? route('user.edit-agency-information', ['id' => $user->profile->id]) : route('user.my-company') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.my-company') || Route::is('user.edit-agency-information') ? 'active' : '' }}">
                <div class="homec-dashboard__list--icon">
                    <i class="fa-solid fa-building-user"></i>
                </div>
                <span>Company Profile</span>
            </a>

            <a href="{{ route('user.my-team') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.my-team') ? 'active' : '' }}">
                <div class="homec-dashboard__list--icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <span>My Team</span>
            </a>
        @else
            <a href="{{ route('user.my-company') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.my-company') ? 'active' : '' }}">
                <div class="homec-dashboard__list--icon">
                    <i class="fa-solid fa-plus-square"></i>
                </div>
                <span>Add Company</span>
            </a>
        @endif
    @elseif ($user->login_type === 'user' && ($user->is_agency == 0 || $user->is_agency == 2))
        <div class="sidebar-section-title">Professional</div>
        <a href="{{ route('user.become-agent') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.become-agent') ? 'active' : '' }}">
            <div class="homec-dashboard__list--icon">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <span>Become an Agent</span>
        </a>
    @endif

    <!-- MEMBERSHIP SECTION -->
    <div class="sidebar-section-title">Membership</div>

    <a href="{{ route('pricing-plan') }}" class="list-group-item d-flex align-items-center {{ Route::is('pricing-plan') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-gem"></i>
        </div>
        <span>Membership Plans</span>
    </a>

    <a href="{{ route('user.orders') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.orders') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-receipt"></i>
        </div>
        <span>Purchase History</span>
    </a>

    <!-- ACCOUNT SECTION -->
    <div class="sidebar-section-title">Account</div>

    <a href="{{ route('user.my-profile') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.my-profile') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-user-gear"></i>
        </div>
        <span>My Profile</span>
    </a>

    <a href="{{ route('user.change-password') }}" class="list-group-item d-flex align-items-center {{ Route::is('user.change-password') ? 'active' : '' }}">
        <div class="homec-dashboard__list--icon">
            <i class="fa-solid fa-key"></i>
        </div>
        <span>Change Password</span>
    </a>

    <a href="{{ route('user.logout') }}" class="list-group-item d-flex align-items-center text-danger">
        <div class="homec-dashboard__list--icon text-danger" style="background: #fef2f2 !important;">
            <i class="fa-solid fa-right-from-bracket text-danger"></i>
        </div>
        <span>Logout</span>
    </a>
</div>
