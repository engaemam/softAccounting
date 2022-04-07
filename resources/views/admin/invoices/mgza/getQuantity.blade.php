@if($ItemsId == 0)
        <input id="No1" type="number" name="quantity_b[]" class="form-control" min="1" max="{{$ItemsId}}" readonly  placeholder="كمية" required>
        <span style="color: red">كمية في المخزن :   {{$ItemsId}}</span><br>
@else
        <input id="No1" type="number" name="quantity_b[]" class="form-control"  min="1" max="{{$ItemsId}}" placeholder="كمية" required>
        <span style="color: green">كمية في المخزن :   {{$ItemsId}}</span><br>
@endif


