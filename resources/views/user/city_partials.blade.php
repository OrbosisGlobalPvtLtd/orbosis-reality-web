<select name="city_id" class="homec-form-select homec-border" required style="width: 100%; height: 50px; background-color: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 10px 18px; font-size: 14.5px; font-weight: 500; color: #0f172a; outline: none;">
    <option value="">-- {{ __('user.Select City') }} --</option>
    @foreach($cities as $city)
        <option value="{{$city->id}}" {{isset($city_id) && $city_id == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
    @endforeach
</select>
