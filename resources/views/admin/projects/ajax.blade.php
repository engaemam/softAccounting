
@php $summ = 0; @endphp
@foreach ($DeviceId as $key => $item )

    @php $summ += $item->items->price; @endphp

    <div class="materials">
        <div class="row">
            {{--<label class="col-sm-1 control-label" for="name"> اسم الماده</label>--}}
            <div class="col-sm-2">

                {{--<input type="hidden" name="item_id_devices[{{$id}}][]" value="{{$item->item_id}}">--}}
                <input type="hidden"  readonly value="{{$item->items->item_name}}"/>
                <input type="hidden" name="devices[{{$id}}][device_items][{{$item->item_id}}][id]" value="{{$item->item_id}}">

            </div>
            {{--<label for=""  class="col-sm-1 control-label">كمية</label>--}}
            <div class="col-sm-1">
                <input  type="hidden"  name="devices[{{$id}}][device_items][{{$item->item_id}}][qu]" value="{{$item->number_items}}" data-value="{{$item->number_items}}" id="qu" class="qu3 quantity" placeholder="كمية">
            </div>

            {{--<label for=""  class="col-sm-1 control-label">سعر</label>--}}
            <div class="col-sm-2">
                <input type="hidden"  name="devices[{{$id}}][device_items][{{$item->item_id}}][p]" value="{{$item->items->price}}"  class="price" placeholder="سعر الماده" required>
            </div>
            <div class="col-sm-2">
                <input type="hidden" name="devices[{{$id}}][device_items][{{$item->item_id}}][total_p]" class="total" readonly  placeholder="الاجمالي">
            </div>
        </div>
    </div>

@endforeach



<br>
@php $summ2 = 0; @endphp
@if(!empty($sbudevicz[0]))

    @foreach ($subid as $key => $subItems )
        @php $summ2 += $subItems->items->price; @endphp
        <div id="getItemsz{{$key}}">

            <div class="materials">
                <div class="row">
                    {{--<label class="col-sm-1 control-label" for="name">اسم الماده الفرعيه</label>--}}
                    <div class="col-sm-2">
                        <input type="hidden" name="devices[{{$id}}][device_items][{{$subItems->item_id}}][id]" value="{{$subItems->item_id}}">
                        <input  type="hidden" readonly value="{{$subItems->items->item_name}}"/>
                    </div>
                    {{--<label for=""  class="col-sm-1 control-label">كمية</label>--}}
                    <div class="col-sm-1">
                        <input  type="hidden" readonly name="devices[{{$id}}][device_items][{{$subItems->item_id}}][qu]" value="{{$subItems->number_items}}" data-value="{{$subItems->number_items}}" id="subqu" class=" quantity" placeholder="كمية" >
                        <input  type="hidden"  name="devices[{{$id}}][device_items][{{$temp}}][quantity_old]" value="{{$subItems->number_items}}" data-value="{{$subItems->number_items}}" placeholder="كمية">

                    </div>
                    {{--<label for=""  class="col-sm-1 control-label">سعر</label>--}}
                    <div class="col-sm-2">
                        <input type="hidden"  name="devices[{{$id}}][device_items][{{$subItems->item_id}}][p]" value="{{$subItems->items->price}}"  class="form-control price" placeholder="سعر الماده" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" name="devices[{{$id}}][device_items][{{$item->item_id}}][total_p]" class="form-control total" readonly  placeholder="الاجمالي">
                    </div>
                </div>
            </div>

        </div>
        <br>
    @endforeach


@endif
{{--<input type="text" name="summ" value="{{ $summ+$summ2 }}" />--}}
