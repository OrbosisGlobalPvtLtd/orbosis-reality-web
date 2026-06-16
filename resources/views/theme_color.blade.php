
@php
    $primary_color = $setting->theme_one_color;
    $secondary_color = $setting->theme_two_color;
@endphp
<style>

.homec-bg-primary-color {
	background-color: {{ $primary_color }};
}
.homec-bg-second-color{
	background-color: #111111;
}
.homec-bg-third-color{
    background-color: #F7F7FD;
}
.homec-default-color{
   color:#111111;
}
.homec-primary-color {
	color: {{ $primary_color }} !important;
}
.homec-second-color{
    color: {{ $secondary_color }};
}
.homec-check-color{
    color:#47CE85;
}
.homec-remove-color{
    color:#E31521;
}


    .homec-header__icon {
        border: 1px solid {{ $primary_color }};
        color: {{ $primary_color }};
    }

    .homec-header__icon:hover {
        background-color: {{ $primary_color }};
        color: #fff;
    }

    .homec-btn:hover {
        color: {{ $primary_color }};
    }

    .homec-btn {
        background: {{ $primary_color }} ;
    }

    .homec-iconic-list.homec-iconic-list__v2 li i {
        color: {{ $primary_color }};
    }

    .swiper-pagination.swiper-pagination__v2 span.swiper-pagination-bullet-active, .swiper-pagination.swiper-pagination__v2 span:hover {
        background: {{ $primary_color }} !important;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable, .select2-results__option.select2-results__option--selectable.select2-results__option--selected {
        background-color: {{ $primary_color }};
    }

    .select2-results__option {
        color: {{ $primary_color.'0.8' }};
    }

    .homec-listing__inner:hover .homec-listing__title,
    .breadcrumb__menu li a,
    .homec-property__card .homec-property__price {
        color: {{ $secondary_color }};
    }

    .homec-btn.homec-btn__second,
    .homec-amount-card.homec-amount-card__sticky {
        background:  {{ $secondary_color }};
    }

    .homec-funfact__icon,
    .homec-accordion__single:before,
    .homec-support-img__content {
        background: {{ $primary_color }};
    }

    .homec-focus-content p,
    .homec-heart,
    .homec-property__price,
    .homec-property:hover .homec-property__title a,
    .homec-agent__body--btn:hover,
    .homec-agent:hover .homec-agent__title a,
    .homec-agent__social li a,
    .homec-accordion__single.active .homec-accordion__heading,
    .homec-accordion__single:hover .homec-accordion__heading,
    .download__app-button .homec-btn:hover,
    .homec-blog:hover .homec-blog__title,
    .homec-blog__btn:hover,
    .homec-form__label,
    .pd-features__text {
        color: {{ $primary_color }};
    }

    .homec-psingle.homec-psingle__active .homec-psingle__amount, .homec-psingle.homec-psingle__active .homec-btn, .homec-psingle:hover .homec-psingle__amount, .homec-psingle:hover .homec-btn {
        background: {{ $primary_color }};
    }

    .homec-agent__social li a:hover {
        background: {{ $primary_color }};
        color: #fff;
    }

    input:hover {
        color: {{ $primary_color }} !important;
    }

    .homec-form__form input {
        color: {{ $primary_color }};
    }

    .homec-form__form input::placeholder {
        color: {{ $primary_color }} !important;
    }

    .homec-form__form input::-ms-input-placeholder {
        color: {{ $primary_color }} !important;
    }

    .homec-psingle.homec-psingle__active, .homec-psingle:hover {
        border-color: {{ $primary_color }};
    }

    .homec-social.homec-social__v2 li a:hover {
        background-color: {{ $primary_color }} !important;
    }

    .homec-social.homec-social__v2 li a {
        color: {{ $primary_color }} !important;
        background: #ECEAFF;
    }

    .single-widget li a:hover,
    .homec-ptdetails-features__title,
    .homec-location-card__icon,
    .homec-blog-detail__tag a:hover,
    .homec-blog-comments__title span,
    .homec-iconic-list.homec-iconic-list--v3 li i,
    .homec-modal__list.homec-modal__list--v2 li,
    .scrollToTop {
        color: {{ $primary_color }};
    }

    #homec-tabs a:hover, #homec-tabs a.active,
    input[type="checkbox"]:checked,
    .price-filter .ui-slider-range,
    .pd-features__single:hover,
    .homec-comments-form,
    .homec-features__single:hover,
    .homec-iconic-list li i,
    .homec-section-bottom-shape,
    .swiper-pagination span::before {
        background: {{ $primary_color }};
    }

    .homec-agent-card {
        background-color: {{ $primary_color }};
    }

    .flex-direction-nav li a {
        background: {{ $primary_color }} !important;
        opacity: 0.8;
    }

    .homec-list-tabs.homec-list-tabs--v2 a.active,
    .homec-list-tabs.homec-list-tabs--v2 a:hover {
        color: {{ $primary_color }} !important;
        border-bottom-color: {{ $primary_color }};
    }

    .homec-list-tabs.homec-list-tabs--v2 a::before {
        border-bottom: 2px solid {{ $primary_color }};
    }

    .homec-location-card:hover .homec-location-card__icon {
        background: {{ $primary_color }};
        color: #fff;
    }

    .homec-property-ag {
        background-color: {{ $primary_color }};
    }

    .homec-agent__social.homec-agent__social--inline li a:hover {
        background: {{ $primary_color }};
    }

    .homec-social a {
        color: {{ $primary_color }} !important;
    }

    .homec-social.homec-social__sidebar a:hover {
        background: {{ $primary_color }};
    }

    .homec-funfact__single:hover {
        border-color: {{ $primary_color }};
    }

    .homec-funfact__single:hover {
        background-color: {{ $primary_color }};
    }

    .homec-pagination ul li a:hover,
    .homec-pagination ul li.active a {
        background: {{ $primary_color }};
        color: #fff !important;
    }

    .homec-pagination ul .homec-pagination__button:hover a {
        color: {{ $primary_color }} !important;
    }

    .swiper-pagination.swiper-pagination--v3 span:before {
        background: {{ $secondary_color }};
    }

    .homec-form-input input:hover, .homec-form-input select:hover, .homec-form-input .homec-form-select:hover, .homec-form-input textarea:hover {
        border-color: {{ $primary_color }};
    }

    .homec-dashboard__single:hover {
        background: {{ $primary_color }};
    }

    .homec-list-tabs.homec-list-tabs--v3 .list-group-item.active,
    .homec-list-tabs.homec-list-tabs--v3 .list-group-item:hover {
        border-bottom-color: {{ $primary_color }};
    }

    .homec-list-tabs.homec-list-tabs--v3 .list-group-item:hover .homec-dashboard__list--icon, .homec-list-tabs.homec-list-tabs--v3 .list-group-item.active .homec-dashboard__list--icon {
        background: {{ $primary_color }};
    }

    .homec-dashboard-property__buttons a:hover,
    .homec-invoice-table--btn {
        background: {{ $primary_color }};
    }

    .ecom-wc__form-main .form-group input:hover, .ecom-wc__form-main .form-group textarea:hover {
        border-color: {{ $primary_color }};
    }

    .ecom-wc__form-main .form-group input:hover, .ecom-wc__form-main .form-group textarea:hover {
        border-color: {{ $primary_color }};
    }

    .ecom-wc__countdown--title {
        background: {{ $secondary_color }};
    }

    .scrollToTop:hover {
        background-color: {{ $primary_color }} !important;
        color: #fff !important;
    }
</style>
