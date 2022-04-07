
<table class="table">
    <thead>
    <tr>

        <th scope="col"> اسم الماده</th>
        <th scope="col">كمية</th>
        <th scope="col">سعر الماده</th>
        <th scope="col">الاجمالي</th>
    </tr>
    </thead>
    <tbody>
    @php $temp = 1; @endphp
    @foreach ($DeviceId as $key => $item )
        <tr class="device_materials">

            <td class="col-md-3 ">

                <input type="hidden" name="devices[{{$id}}][device_items][{{$temp}}][id]" value="{{$item->item_id}}">
                <input class="form-control" readonly value="{{$item->items->item_name}}"/>

            </td>
            <td class="col-md-1">
                <input  type="text" readonly name="devices[{{$id}}][device_items][{{$temp}}][qu]" value="{{$item->number_items}}" data-value="{{$item->number_items}}" class="form-control device_material_quantity" placeholder="كمية" required>
                <input  type="hidden" readonly name="devices[{{$id}}][device_items][{{$temp}}][quantity_old]" value="{{$item->number_items}}" data-value="{{$item->number_items}}" class="" placeholder="كمية" required>

            </td>
            <td class="col-md-1">
                <input type="text"  name="devices[{{$id}}][device_items][{{$temp}}][p]" class="form-control device_material_price" placeholder="سعر الماده" required>
            </td>
            <td class="col-md-1">
                <input type="text" name="devices[{{$id}}][device_items][{{$temp}}][total_p]" class="form-control device_material_quantity_total" readonly  placeholder="الاجمالي">

            </td>
        </tr>
    @php $temp++; @endphp
    @endforeach
    </tbody>
</table>


@if(!empty($sbudevicz[0]))


    <table class="table device_materials row">
        <thead>
        <tr>

            <th scope="col">الماده الفرعيه</th>
            <th scope="col">كمية</th>
            <th scope="col">سعر الماده</th>
            <th scope="col">الاجمالي</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($subid as $key => $subItems )

            <div id="getItemsz{{$key}}">
                <tr class="device_materials">
                    <td class="col-md-3">
                        <input type="hidden" name="devices[{{$id}}][device_items][{{$temp}}][id]" value="{{$subItems->item_id}}">
                        <input class="form-control" readonly value="{{$subItems->items->item_name}}"/>
                    </td>
                    <td class="col-md-1">
                        <input  type="text" readonly name="devices[{{$id}}][device_items][{{$temp}}][qu]" value="{{$subItems->number_items}}" data-value="{{$subItems->number_items}}" class="form-control device_material_quantity" placeholder="كمية" required>
                        <input  type="hidden" readonly name="devices[{{$id}}][device_items][{{$temp}}][quantity_old]" value="{{$subItems->number_items}}" data-value="{{$subItems->number_items}}" class="" placeholder="كمية" required>


                    </td>
                    <td class="col-md-1">
                        <input type="text"  name="devices[{{$id}}][device_items][{{$temp}}][p]" class="form-control device_material_price" placeholder="سعر الماده" required>

                    </td>
                    <td class="col-md-1">
                        <input type="text" name="devices[{{$id}}][device_items][{{$temp}}][total_p]" class="form-control device_material_quantity_total" readonly  placeholder="الاجمالي">
                    </td>

                </tr>
            </div>
            @php $temp++; @endphp
        @endforeach

        </tbody>
    </table>

@endif