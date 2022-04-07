



@php $summ = 0; @endphp
@foreach ($DeviceId as $key => $item )

    @php $summ += $item->items->price; @endphp

    <div class="materials">
        <div class="row">
            {{--<label class="col-sm-1 control-label" for="name"> اسم الماده</label>--}}
            <div class="col-sm-2">

                <input type="hidden" name="item_id_devices[{{$id}}][]" value="{{$item->item_id}}">
                <input type="hidden"  readonly value="{{$item->items->item_name}}"/>
            </div>
            {{--<label for=""  class="col-sm-1 control-label">كمية</label>--}}
            <div class="col-sm-1">
                <input  type="hidden"  name="quantity_devices[{{$id}}][]" value="{{$item->number_items}}" data-value="{{$item->number_items}}" id="qu" class="qu3 quantity" placeholder="كمية">
            </div>

            {{--<label for=""  class="col-sm-1 control-label">سعر</label>--}}
            <div class="col-sm-2">
                <input type="hidden"  name="price_devices[{{$id}}][]" value="{{$item->items->price}}"  class="price" placeholder="سعر الماده" required>
            </div>
            <div class="col-sm-2">
                <input type="hidden" name="total_devices[{{$id}}][]" class=" total" readonly  placeholder="الاجمالي">
            </div>
        </div>
    </div>

@endforeach



<br>
@php $summ2 = 0; @endphp
@if(!empty($sbudevicz[0]))

    @foreach ($subid as $key => $itemz )
        @php $summ2 += $itemz->items->price; @endphp
        <div id="getItemsz{{$key}}">

            <div class="materials">
                <div class="row">
                    {{--<label class="col-sm-1 control-label" for="name">اسم الماده الفرعيه</label>--}}
                    <div class="col-sm-2">
                        <input type="hidden" name="item_id_devices[{{$id}}][]" value="{{$itemz->item_id}}">
                        <input  type="hidden" readonly value="{{$itemz->items->item_name}}"/>
                    </div>
                    {{--<label for=""  class="col-sm-1 control-label">كمية</label>--}}
                    <div class="col-sm-1">
                        <input  type="hidden" readonly name="quantity_devices[{{$id}}][]" value="{{$itemz->number_items}}" data-value="{{$itemz->number_items}}" id="subqu" class=" quantity" placeholder="كمية" >
                    </div>
                    {{--<label for=""  class="col-sm-1 control-label">سعر</label>--}}
                    <div class="col-sm-2">
                        <input type="hidden"  name="price_devices[{{$id}}][]" value="{{$itemz->items->price}}"  class="form-control price" placeholder="سعر الماده" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" name="total_devices[{{$id}}][]" class="form-control total" readonly  placeholder="الاجمالي">
                    </div>
                </div>
            </div>

        </div>
        <br>
    @endforeach


@endif
{{--<input type="text" name="summ" value="{{ $summ+$summ2 }}" />--}}