
@foreach($devices as $device)
    @if($device->quantity <= 0)
        <input type="number" id="Nu1" name="devices[{{$device->id}}][device_quantity]" value="0" readonly class="form-control "  placeholder="كمية" autocomplete="off" required>
        <span style="color: red">كمية في المخزن :   {{$device->quantity}}</span>
    @else
        <input type="number" id="Nu1" name="devices[{{$device->id}}][device_quantity]" class="form-control "  placeholder="كمية" autocomplete="off" required>
        <span style="color: green">كمية في المخزن :   {{$device->quantity}}</span>
    @endif
@endforeach


