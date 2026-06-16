<select class="property-sidebar__group homec-border select2 js-select city_location" name="city" id="city_location">
    <option value="">{{__('user.Select')}}</option>
    @foreach($cities as $city)
        <option value="{{$city->id}}" {{request()->get('city') == $city->id ? 'selected' : '' }}>{{$city->name}}</option>
    @endforeach
</select>

<script>
    $(document).ready(function () {
        $('.js-select').select2();
    });
</script>
