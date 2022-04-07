
@php $summ = 0; @endphp
@foreach ($DeviceId as $key => $item )
    @php
        if($item->items->newprice == 0){
        $summ += $item->items->price * $item->number_items;
        }else{
        $summ += $item->items->newprice * $item->number_items;
        }

    @endphp
@endforeach

@php $summ2 = 0; @endphp

@if(!empty($sbudevicz[0]))
    @foreach ($subid as $key => $subItems )

        @php
            if($subItems->items->newprice == 0){
            $summ2 += $subItems->items->price * $subItems->number_items;
          }else{
         $summ2 += $subItems->items->newprice * $subItems->number_items;
         }
        @endphp
    @endforeach

@endif


<input type="text" class="form-control onedevice" id="Nu2" name="devices[{{$id}}][device_price]" value="{{ $summ+$summ2 }}"  />