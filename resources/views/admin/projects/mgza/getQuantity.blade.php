
@foreach($ItemsId as $item)
    @if($item->quantity <= 0)
        <input id="No1" type="number" name="quantity_b[]" class="form-control" value="0" readonly  placeholder="كمية" required>
        <span style="color: red">كمية في المخزن :   {{$item->quantity}}</span>
    @else
        <input id="No1" type="number" name="quantity_b[]" class="form-control"  placeholder="كمية" required>
        <span style="color: green">كمية في المخزن :   {{$item->quantity}}</span>
    @endif
@endforeach


