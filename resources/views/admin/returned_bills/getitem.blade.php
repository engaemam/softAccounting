
<script>

    $(document).on('focusout', '#quantity1' ,function() {

      quantity1 = $(this).val();

    });
    $(document).on('focusout', '#price_e' ,function() {

        price_e = $(this).val();

    });
    var price_e;
    var quantity1;

    $(document).on('focusout', '#total_prie' ,function(){

         total_prie = $(this);
        var toolsx = price_e * quantity1;
        $(total_prie).val(toolsx);
    });


</script>



<div class="form-group input_fields_wrap">
    <label class="col-sm-1 control-label" for="name">اختيار اسم الماده</label>
    <div class="col-sm-2">
        <select id="item_id" class="form-control"   name="item_id[]"  data-live-search="true">
            <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>
            @foreach ($itemge as $item )
                <option value="{{$item->id}}">{{$item->item_name}}</option>
            @endforeach
        </select>
    </div>
    <label for="quantity1"  class="col-sm-1 control-label">كمية</label>
    <div class="col-sm-2">
        <input type="number" name="quantity_devices[]" class="form-control" id="quantity1" placeholder="كمية">
    </div>
    <label for="price" class="col-sm-1 control-label">سعر الماده</label>
    <div class="col-sm-2">
        <input type="text" name="price_b[]" class="form-control" id="price_e" placeholder="سعر الماده">
    </div>

    <div class="col-sm-2">
        <input type="text" name="total_priceitems_b[]" class="form-control" id="total_prie" readonly placeholder="الاجمالي">
    </div>
    <a href="#" class="btn btn-danger remove_field">Remove</a></div>
    </div>