@php
    $setting = App\Models\Setting::first();
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">{{ $setting->app_name }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">{{ $setting->app_name }}</a>
      </div>
      <ul class="sidebar-menu">
          <li class="{{ Route::is('admin.dashboard')  ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> <span>{{__('admin.Dashboard')}}</span></a></li>

          <li class="nav-item dropdown {{ Route::is('admin.pricing-plan.*') || Route::is('admin.assign-pricing-plan') || Route::is('admin.purchase-history') || Route::is('admin.show-purchase-history') || Route::is('admin.pending-payment') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Pricing Plan')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.pricing-plan.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pricing-plan.index') }}">{{__('admin.Pricing Plan')}}</a></li>

                <li class="{{ Route::is('admin.assign-pricing-plan') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.assign-pricing-plan') }}">{{__('admin.Assign Pricing Plan')}}</a></li>

                <li class="{{ Route::is('admin.purchase-history') || Route::is('admin.show-purchase-history')  ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.purchase-history') }}">{{__('admin.Purchase history')}}</a></li>

                <li class="{{ Route::is('admin.pending-payment')  ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-payment') }}">{{__('admin.Pending Payment')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.category.*') || Route::is('admin.property.booking') || Route::is('admin.nearest-location.*') || Route::is('admin.aminity.*') || Route::is('admin.property.*') || Route::is('admin.agent-property') || Route::is('admin.agent-pending-property') || Route::is('admin.assign-slider-property') || Route::is('admin.agent-reject-property') || Route::is('admin.review-list') || Route::is('admin.show-review') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas far fa-building"></i><span>{{__('admin.Real Estate')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.property.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.property.create') }}">{{__('admin.Create Property')}}</a></li>

                <li class="{{ Route::is('admin.property.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.property.index') }}">{{__('admin.Own Properties')}}</a></li>
                <li class="{{ Route::is('admin.property.booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.property.booking') }}">{{__('admin.Own Booking')}}</a></li>

                <li class="{{ Route::is('admin.agent-property') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.agent-property') }}">{{__('Associates All Properties')}}</a></li>

                <li class="{{ Route::is('admin.agent-pending-property') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.agent-pending-property') }}">{{__('admin.Awaiting for approval')}}</a></li>

                <li class="{{ Route::is('admin.agent-reject-property') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.agent-reject-property') }}">{{__('Associates Reject Property')}}</a></li>

                <li class="{{ Route::is('admin.assign-slider-property') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.assign-slider-property') }}">{{__('admin.Assign Slider Property')}}</a></li>


                <li class="{{ Route::is('admin.coupon.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.category.index') }}">{{__('admin.Property Type')}}</a></li>

                <li class="{{ Route::is('admin.nearest-location.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.nearest-location.index') }}">{{__('admin.Nearest Location')}}</a></li>

                <li class="{{ Route::is('admin.aminity.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.aminity.index') }}">{{__('admin.Aminities')}}</a></li>

                <li class="{{ Route::is('admin.review-list') || Route::is('admin.show-review') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.review-list') }}">{{__('admin.Review List')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.country.*') || Route::is('admin.country-import-page') || Route::is('admin.city.*') || Route::is('admin.city-import-page') || Route::is('admin.assign-homepage-city') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i><span>{{__('admin.Locations')}}</span></a>
            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.country.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.country.create') }}">{{__('admin.Create Country')}}</a></li>
                <li class="{{ Route::is('admin.country.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.country.index') }}">{{__('admin.Country')}}</a></li>
                <li class="{{ Route::is('admin.country-import-page') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.country-import-page') }}">{{__('admin.Country Bulk Import')}}</a></li>

                <li><a class="nav-link" href="{{ route('admin.city.create') }}">{{__('admin.Create city')}}</a></li>
                <li class="{{ Route::is('admin.city.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.city.index') }}">{{__('admin.City')}}</a></li>
                <li><a class="nav-link" href="{{ route('admin.city-import-page') }}">{{__('admin.City Bulk Import')}}</a></li>

                <li class="{{ Route::is('admin.assign-homepage-city') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.assign-homepage-city') }}">{{__('admin.Assign homepage city')}}</a></li>

            </ul>
          </li>

          <!-- Users Menu -->
          <li class="nav-item dropdown {{  Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.pending-customer-list') || Route::is('admin.send-email-to-all-customer') || Route::is('admin.create-customer') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Users')}}</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.create-customer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.create-customer') }}">{{__('admin.Create Customer')}}</a></li>
                <li class="{{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.customer-list') }}">{{__('admin.User List')}}</a></li>
                <li class="{{ Route::is('admin.pending-customer-list') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-customer-list') }}">{{__('admin.Pending User')}}</a></li>
            </ul>
          </li>

          <!-- Associates Menu -->
          <li class="nav-item dropdown {{  Route::is('admin.agent') || Route::is('admin.send-email-to-all-agent') || Route::is('admin.send-email-to-agent') || Route::is('admin.agent-show') || Route::is('admin.create-agent') || Route::is('admin.agency') || Route::is('admin.agency-show') || Route::is('admin.pending-agent-requests') || Route::is('admin.pending-agent-requests.*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('Associates')}}</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.agent') || Route::is('admin.agent-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.agent') }}">{{__('admin.Agent List')}}</a></li>
                <li class="{{ Route::is('admin.agency') && ! request()->get('type') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.agency') }}">{{__('admin.Agency List')}}</a></li>
                <li class="{{ Route::is('admin.pending-agent-requests') || Route::is('admin.pending-agent-requests.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-agent-requests') }}">{{__('admin.Pending Agent Requests')}}</a></li>
                <li class="{{ Route::is('admin.agency') && request()->get('type') === 'pending' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.agency', ['type' => 'pending']) }}">{{__('admin.Pending Agencies')}}</a></li>
            </ul>
          </li>

          <!-- Builders Menu -->
          <li class="nav-item dropdown {{  Route::is('admin.builder') || Route::is('admin.builder-show') ? 'active' : ''}}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Builders')}}</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.builder') && ! request()->get('type') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.builder') }}">{{__('admin.Builder List')}}</a></li>
                <li class="{{ Route::is('admin.builder') && request()->get('type') === 'pending' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.builder', ['type' => 'pending']) }}">{{__('admin.Pending Builders')}}</a></li>
            </ul>
          </li>

        @if (Module::isEnabled('SupportTicket'))
            @include('supportticket::admin.sidebar')
        @endif

          @if (Module::isEnabled('Kyc'))
            @include('kyc::Admin.sideber')
          @endif

          <li class="nav-item dropdown {{ Route::is('admin.maintainance-mode') || Route::is('admin.banner-image.index') || Route::is('admin.seo-setup') ||  Route::is('admin.default-avatar') || Route::is('admin.default-placeholder') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-globe"></i><span>{{__('admin.Manage Website')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.seo-setup') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seo-setup') }}">{{__('admin.SEO Setup')}}</a></li>

                <li class="{{ Route::is('admin.maintainance-mode') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.maintainance-mode') }}">{{__('admin.Maintainance Mode')}}</a></li>

                <li class="{{ Route::is('admin.banner-image.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.banner-image.index') }}">{{__('admin.Banner Image')}}</a></li>

                <li class="{{ Route::is('admin.default-avatar') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.default-avatar') }}">{{__('admin.Default Avatar')}}</a></li>

                <li class="{{ Route::is('admin.default-placeholder') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.default-placeholder') }}">{{__('admin.Default Placeholder')}}</a></li>

            </ul>
          </li>

          <li class="{{ Route::is('admin.mobile-app-setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.mobile-app-setting') }}"><i class="fas fa-mobile"></i> <span>{{__('admin.Mobile App Setting')}}</span></a></li>


          <li class="nav-item dropdown {{ Route::is('admin.mobile-slider.*') || Route::is('admin.slider.*') || Route::is('admin.counter.*') || Route::is('admin.testimonial.*') || Route::is('admin.mobile-app') || Route::is('admin.partner.*') || Route::is('admin.why-choose-us.*') || Route::is('admin.home2-about-us') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.All Section')}}</span></a>
            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.slider.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.slider.index' , ['lang_code' => admin_lang()]) }}">{{__('admin.Intro section')}}</a></li>

                <li class="{{ Route::is('admin.home2-about-us') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.home2-about-us', ['lang_code' => admin_lang()]) }}">{{__('admin.Home2 About Us')}}</a></li>

                <li class="{{ Route::is('admin.partner.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.partner.index') }}">{{__('admin.Partner')}}</a></li>

                <li class="{{ Route::is('admin.mobile-app') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.mobile-app', ['lang_code' => admin_lang()]) }}">{{__('admin.Mobile App')}}</a></li>

                <li class="{{ Route::is('admin.testimonial.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.testimonial.index' , ['lang_code' => admin_lang()]) }}">{{__('admin.Testimonial')}}</a></li>

                <li class="{{ Route::is('admin.counter.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.counter.index', ['lang_code' => admin_lang()]) }}">{{__('admin.Counter')}}</a></li>

                <li class="{{ Route::is('admin.why-choose-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.why-choose-us.index', ['lang_code' => admin_lang()]) }}">{{__('admin.Why choose us')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.footer.*') || Route::is('admin.social-link.*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Header & Footer')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.footer.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.footer.index' , ['lang_code' => admin_lang()]) }}">{{__('admin.Footer')}}</a></li>

                <li class="{{ Route::is('admin.social-link.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.social-link.index') }}">{{__('admin.Social Link')}}</a></li>

            </ul>
          </li>

          <li class="{{ Route::is('admin.payment-method') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.payment-method') }}"><i class="fas fa-dollar-sign"></i> <span>{{__('admin.Payment Method')}}</span></a></li>

          <li class="nav-item dropdown {{ Route::is('admin.about-us.*') || Route::is('admin.custom-page.*') || Route::is('admin.terms-and-condition.*') || Route::is('admin.privacy-policy.*') || Route::is('admin.faq.*') || Route::is('admin.error-page.*') || Route::is('admin.contact-us.*') || Route::is('admin.login-page') || Route::is('admin.homepage') || Route::is('admin.create-property') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i><span>{{__('admin.Pages')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.homepage') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.homepage', ['lang_code' => admin_lang()]) }}">{{__('admin.Homepage')}}</a></li>

                <li class="{{ Route::is('admin.about-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about-us.index',['lang_code' => admin_lang()]) }}">{{__('admin.About Us')}}</a></li>

                <li class="{{ Route::is('admin.create-property') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.create-property' , ['lang_code' => admin_lang()]) }}">{{__('admin.Create Property')}}</a></li>

                <li class="{{ Route::is('admin.contact-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.contact-us.index') }}">{{__('admin.Contact Us')}}</a></li>

                <li class="{{ Route::is('admin.custom-page.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.custom-page.index') }}">{{__('admin.Custom Page')}}</a></li>

                <li class="{{ Route::is('admin.terms-and-condition.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.terms-and-condition.index' , ['lang_code' => admin_lang()]) }}">{{__('admin.Terms And Conditions')}}</a></li>

                <li class="{{ Route::is('admin.privacy-policy.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.privacy-policy.index' , ['lang_code' => admin_lang()]) }}">{{__('admin.Privacy Policy')}}</a></li>

                <li class="{{ Route::is('admin.faq.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.faq.index' , ['lang_code' => admin_lang()]) }}">{{__('admin.FAQ')}}</a></li>

                <li class="{{ Route::is('admin.login-page') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.login-page' , ['lang_code' => admin_lang()]) }}">{{__('admin.Login Page')}}</a></li>

                <li class="{{ Route::is('admin.error-page.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.error-page.index' , ['lang_code' => admin_lang()]) }}">{{__('admin.Error Page')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') || Route::is('admin.popular-blog.*') || Route::is('admin.blog-comment.*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Blogs')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.blog-category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog-category.index') }}">{{__('admin.Categories')}}</a></li>

                <li class="{{ Route::is('admin.blog.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog.index') }}">{{__('admin.Blogs')}}</a></li>

                <li class="{{ Route::is('admin.popular-blog.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.popular-blog.index') }}">{{__('admin.Popular Blogs')}}</a></li>

                <li class="{{ Route::is('admin.blog-comment.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog-comment.index') }}">{{__('admin.Comments')}}</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.email-configuration') || Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i><span>{{__('admin.Email Configuration')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.email-configuration') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.email-configuration') }}">{{__('admin.Setting')}}</a></li>

                <li class="{{ Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.email-template') }}">{{__('admin.Email Template')}}</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown {{ Route::is('admin.language') || Route::is('admin.admin-language') || Route::is('admin.admin-validation-language') || Route::is('admin.website-language') || Route::is('admin.website-validation-language') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Language')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.language') }}">{{__('admin.Language')}}</a></li>

                <li class="{{ Route::is('admin.admin-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin-language',['lang_code' => admin_lang()]) }}">{{__('admin.Admin Language')}}</a></li>

                <li class="{{ Route::is('admin.admin-validation-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin-validation-language',['lang_code' => admin_lang()]) }}">{{__('admin.Admin Validation')}}</a></li>

                <li class="{{ Route::is('admin.website-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.website-language',['lang_code' => admin_lang()]) }}">{{__('admin.Frontend Language')}}</a></li>
                <li class="{{ Route::is('admin.website-validation-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.website-validation-language',['lang_code' => admin_lang()]) }}">{{__('admin.Frontend Validation')}}</a></li>
            </ul>
          </li>

          @if (Module::isEnabled('Currency'))
                @include('currency::sidebar')
            @endif

          <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.general-setting') }}"><i class="fas fa-cog"></i> <span>{{__('admin.Setting')}}</span></a></li>

          @php
              $logedInAdmin = Auth::guard('admin')->user();
          @endphp
          @if ($logedInAdmin->admin_type == 1)
          <li  class="{{ Route::is('admin.clear-database') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.clear-database') }}"><i class="fas fa-trash"></i> <span>{{__('admin.Clear Database')}}</span></a></li>
          @endif

          <li  class="{{ Route::is('admin.clear-cache') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.clear-cache') }}"><i class="fas fa-undo"></i> <span>{{__('admin.Cache Clear')}}</span></a></li>

          <li class="{{ Route::is('admin.subscriber') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.subscriber') }}"><i class="fas fa-fire"></i> <span>{{__('admin.Subscribers')}}</span></a></li>

          <li class="{{ Route::is('admin.contact-message') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.contact-message') }}"><i class="fas fa-fa fa-envelope"></i> <span>{{__('admin.Contact Message')}}</span></a></li>

          @if ($logedInAdmin->admin_type == 1)
            <li class="{{ Route::is('admin.admin.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin.index') }}"><i class="fas fa-user"></i> <span>{{__('admin.Admin list')}}</span></a></li>
          @endif

        </ul>
    </aside>
  </div>