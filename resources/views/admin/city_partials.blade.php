<select class="js-select theme-input-style w-100" name="city_id">
    @foreach($cities as $city)
        <option value="{{$city->id}}" {{isset($city_id) && $city_id == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
    @endforeach
</select>

<script>
    $(document).ready(function () {
        $('.js-select').select2();
    });
</script>
