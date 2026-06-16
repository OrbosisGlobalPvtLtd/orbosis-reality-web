<select  name="city_id" class="homec-form-select homec-border select2 js-select">
    @foreach($cities as $city)
        <option value="{{$city->id}}" {{isset($city_id) && $city_id == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
    @endforeach
</select>

<script>
    $(document).ready(function () {
        $('.js-select').select2();
    });
</script>
