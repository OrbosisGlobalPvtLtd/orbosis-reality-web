<div class="language-switcer-frontend pt-1">
    <form action="{{ route('language-switcher') }}" id="lang_swithcer_form_for_mobile">
    <select id="lang_swithcer_for_mobile"  class="form-control selectpicker" name="lang_code" data-width="fit">
    @if (Session::get('front_lang'))
        @foreach ($language_list as $language)
            <option  class="dropdown-item" {{ Session::get('front_lang') == $language->lang_code ? 'selected' : '' }} value="{{ $language->lang_code }}" data-content='<span class="flag-icon flag-icon-{{ mb_strtolower($language->country_code ?? '') }}"></span> {{ $language->lang_name ?? '' }}'>{{ $language->lang_name }}</option>
        @endforeach
    @else
        @foreach ($language_list as $language)
            <option class="dropdown-item" value="{{ $language->lang_code }}" data-content='<span class="flag-icon flag-icon-{{ mb_strtolower($language->country_code ?? '') }}"></span> {{ $language->lang_name ?? '' }}'>{{ $language->lang_name }}</option>
        @endforeach
    @endif
    </select>
    </form>
</div>
