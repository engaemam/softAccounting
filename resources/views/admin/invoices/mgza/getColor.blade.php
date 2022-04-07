
<select class="form-control select2" name="color[]" required>
    <option class="form-control" value="">-----أختر مواصفة المادة ----</option>

        @foreach($colors as $color)
                <option value="{{$color->id}}">{{ $color->name }} </option>
        @endforeach


</select>