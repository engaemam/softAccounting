

<div>
    <table  id=""  class="table table-bordered table-striped ">

        <thead>
        <th> مواصفة 2</th>
        <th> العدد</th>
        <th> السعر</th>
        </thead>
        <tbody id="maindiv">
<script>
    function get_value(type,zxc_id) {

        if(type == 1){
            qunt = $('.quantity'+zxc_id+'').val();
            $('.q'+zxc_id+'').val(qunt);
        }else if(type == 2){
            price =$('.price'+zxc_id+'').val();
            $('.p'+zxc_id+'').val(price);

        }else{
            var total
                =parseInt($('.quantity'+zxc_id+'').val()) * parseInt($('.price'+zxc_id+'').val());

            $('.t'+zxc_id+'').val(total);

        }

    }
</script>
        @foreach ($itemsizes as $key => $itemsie )
                      
                        <tr>
                            <td><input type="checkbox" checked name="u_size[{!! $item_id !!}][{!! $color_id !!}][]" value="{!! $itemsie->id !!}" > {{ $itemsie->name }}</td>
                            <td><input id="No1" type="number" name="u_quantity[{!! $item_id !!}][{!! $color_id !!}][]"   class="form-control q{{$zxid}} u_quantity" value="" ></td>
                            <td><input id="No2" type="number" name="u_price[{!! $item_id !!}][{!! $color_id !!}][]"   class="form-control p{{$zxid}} u_price" ></td>
                            <td><input id="No3" type="text" name="total_price_b[]" class="form-control t{{$zxid}}"   readonly placeholder="الاجمالي" required>
                        </tr>

<script>
    get_value(2,{{$zxid}});
    get_value(3,{{$zxid}});
    get_value(1,{{$zxid}});
</script>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Button trigger modal -->



<!-- Modal -->

<div class="modal fade" id="exampleModal{{$item_id}}{{$color_id}}{{$size_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$item_id}}{{$color_id}}{{$size_id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel{{$item_id}}{{$color_id}}{{$size_id}}">تحديد عدد لكل مواصفة 2</h4>
            </div>
            <div class="modal-body">
                <table  class="table table-bordered table-striped ">

                    <thead>
                    <tr>
                        <th>مواصفة 2</th>
                        <th>العدد من مواصفة 2</th>
                        <th>السعر</th>
                    </tr>
                    </thead>
                    <tbody id ="mainmodal">
                     
                    @foreach ($itemsizes as $key => $itemsie )
                        
                        <tr>
                            <td><input type="checkbox" name="u_size[{!! $item_id !!}][{!! $color_id !!}][]" value="{!! $itemsie->id !!}"> {{ $itemsie->name }}</td>
                            <td><input id="No11" type="number" name="u_quantity[{!! $item_id !!}][{!! $color_id !!}][]"  class="form-control"></td>
                            <td><input id="No22" type="number" name="u_price[{!! $item_id !!}][{!! $color_id !!}][]"  class="form-control"></td>
                        </tr>

                    @endforeach
                        <tr>
                            <td></td>
                        <td><input id="No33" type="text" name="total_price_b[]" class="form-control"  readonly placeholder="الاجمالي" required>     
                            </td>
                       </tr>
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">حفظ</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
   
</div>

    
<script type="text/javascript">
    function changeClass{{$item_id}}{{$color_id}}{{$size_id}}() {


        <?php for($i = 1 ; $i <= 10 ; $i ++) {?>
        document.getElementsByClassName('Number<?php echo $i;?>')[0].className = "form-control changedClass Number<?php echo $i;?> !important";
        document.getElementsByClassName('Price<?php echo $i;?>')[0].className = "form-control changedClass Price<?php echo $i;?> !important";
        var button_class = document.getElementsByClassName('Number<?php echo $i;?>')[0].className;
        <?php }?>

    }

</script>

<script>
    $('#name').change(function() {
    $('#firstname').val($(this).val());
});
</script>
<!-- <script>
    $(function () {
    //field No11 calculation
    $("#test").on("keyup", "#No1", function () {
        var x = $(this).val();
        var y = $(this).closest("tr").find("input[id='No22']").val();
        var z = parseFloat(x) * parseFloat(y);
        $(this).closest("tr").find("input[id='No33']").val(Math.round(z * 100) / 100);
        sum();
    })
   

    //field No22 calculation
    $("#test").on("keyup", "#No2", function () {
        var x = $(this).val();
        var y = $(this).closest("tr").find("input[id='No11']").val();
        var z = parseFloat(y) * parseFloat(x);
        $(this).closest("tr").find("input[id='No33']").val(Math.round(z * 100) / 100);
        sum();
    })

    //Sum All No33
    function sum() {
        var sum = 0;
        $("input[id *='No3']").each(function () {
            sum += +$(this).val();
        });
        $("#mo_textm").val(Math.round(sum * 100) / 100 );
        discont();
    };

    });

    
};


</script> -->