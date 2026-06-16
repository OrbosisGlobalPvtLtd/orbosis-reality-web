@if (!empty($language_list) && count($language_list) > 1)
    <div class="section-header admin-language-switcer language-switcer-dropdown">
        <select
            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"
            class="select2_for_lang" data-width="fit" >

            @foreach ($language_list as $lang)
                @php
                    $lang_code = request()->is('admin*') ? admin_lang() : front_lang();
                    $is_default = $lang_code === ($lang->lang_code ?? '');
                @endphp

                <option
                    value="{{ route(Route::currentRouteName(), array_merge(request()->route()->parameters(), ['lang_code' => $lang->lang_code ?? ''])) }}"
                    data-content='<span class="flag-icon flag-icon-{{ mb_strtolower($lang->country_code ?? '') }}"></span>'
                    {{ $is_default ? 'selected' : '' }}>{{ $lang->lang_name ?? '' }} </option>
            @endforeach



        </select>
    </div>



    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css" />

        <style>
            .language-switcer-dropdown .filter-option-inner-inner {
                line-height: 1;
                display: flex !important;
                align-items: center;
                gap: 6px;

            }

            .language-switcer-dropdown .btn-light {
                background: #fff !important;
                padding: 2px 15px;
                border: 1px solid #ced4da;
            }

            .language-switcer-dropdown .dropdown-menu .text {
                display: flex !important;
                align-items: center;
                gap: 6px;
                font-size: 15px;
            }

            .language-switcer-dropdown .dropdown-item {
                padding: 5px 18px;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
        <script>
            $(function() {
                $('.selectpicker').selectpicker();


            });
        </script>
    @endpush
@endif

{{-- @if (!empty($language_list) && count($language_list) > 1)
    <div class="section-header admin-language-switcer">
        <ul class="nav nav-tabs">
            @foreach ($language_list as $lang)
                @php
                    $lang_code = request()->is('admin*') ? admin_lang() : front_lang();
                    $is_default = $lang_code === ($lang->lang_code ?? '');
                @endphp
                <li class="nav-item">
        <a class="nav-link {{ $is_default ? 'active' : ''}}"
@if ($is_default)
    aria-current="page"
@endif


                    href="{{ route(Route::currentRouteName(), array_merge(request()->route()->parameters(), ['lang_code' => $lang->lang_code ?? ''])) }}"><i class="fas fa-edit"></i> {{ $lang->lang_name ?? '' }}
                    </a>
                </li>
            @endforeach
        </ul>
</div>
@endif --}}
