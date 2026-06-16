<select  name="city" class="homec-form-select homec-border home_form_select2 js-select">
    @foreach($cities as $city)
        <option value="{{$city->name}}">{{$city->name}}</option>
    @endforeach
</select>

<script>
    $('select[name="city"]').select2({
        dropdownParent: $('#profile_view') // Ensure dropdown is inside modal
    });

</script>
