@extends('admin.index')
@section('page_title')
    {{trans('invoices.create')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">





    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('invoices.create')}}</h3>
        </div>
        <!-- /.box-header -->

       
        <!-- Start Ahmed Gorashi-->

        <!-- End Ahmed Gorashi -->
        <br><br><br><br>
        <div class="box-body">
            <form class="form-horizontal" method="POST" autocomplete="off" action="{{route('invoices.store')}}" id="hidd" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">
                        <input type="hidden" name="client_id" value="{{ $modelid }}">
                       
                        <div class="col-sm-3" hidden>
                            <input type="text" name="name_client" class="form-control" id="name_client" value="فاتورة بيع مباشر" >
                        </div>
                        
                        <div class="col-sm-3" hidden>
                            <select name="city" class="form-control select2" required>
                                <option value="فاتورة بيع مباشر"  selected>   -----   اختيار المدينة     ----- </option>
                             
                            </select>
                        </div>

                       
                        <div class="col-sm-3" hidden>
                            <select name="invoice_type" class="form-control select2" required>
                               
                               
                                    
                                    <option value="1" selected>فاتورة بيع مباشر</option>
                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                       
                        <div class="col-sm-7" hidden>
                            <textarea class="form-control" name="notes_client" value="فاتورة بيع مباشر" >{{old('notes')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                       
                        <div class="col-sm-7" hidden>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="{{trans('clients.phone')}}"value="فاتورة بيع مباشر" >
                        </div>
                    </div>


                   
                    <div class="form-group">
                   
                        <div class="col-sm-9" hidden>
                            <textarea class="form-control" name="notes" value="فاتورة بيع مباشر" >{{old('notes')}}</textarea>
                        </div>
                    </div>



                    <!-- Strat -->
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                          
                            <div class="form-group">
                                <div class="col-sm-5"></div>

                                <div class="col-sm-4">
                                    <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> اضافة مواد</button>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="box-body">
                                        <div class="form-group">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>اختيار اسم الماده</th>
                                                    <th>المواصفة</th>
                                                    <th>مواصفة 2</th>
                                                    <th> الكميه</th>
                                                    <th> السعر</th>

                                                    <th>
                                                        #

                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">

                                                </tbody>
                                            </table>

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">إجمالي سعر الأصناف</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="colcolet">
                                           
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label"> الخصم</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="discount" class="form-control" id="discount" placeholder=" الخصم">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label">صافي الفاتورة</label>
                                                        <div class="col-sm-3">
                                                            <input type="number" name="afterdiscount" readonly class="form-control" id="toltalinvoicesandDis" placeholder="صافي الفاتورة">
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- /.tab-pane -->

                                <div class="tab-pane " id="settings2">

                                    <div class="box-body hereallzsasd">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>اختيار اسم الجهاز</th>
                                                <th>كمية</th>
                                                <th>سعر الافرادي</th>


                                                <th>الاجمالي</th>

                                                <th>
                                                    #
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="devices">

                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="form-group ">
                                            <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة جهاز </button>
                                        </div>
                                        <br>

                                        <div class="form-group ">
                                            <label for="value" class="col-sm-1 control-label">سعر الاجهزة</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="total_final_mogma3"  readonly class="form-control total_final2" id="total_final" placeholder="سعر الجهاز كامل">
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.box-body -->

                                </div>
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                {{--<div class="form-group">--}}
                {{--<label for="value" class="col-sm-2 control-label">اجمالي الفاتورة </label>--}}
                {{--<div class="col-sm-8">--}}
                {{--<input type="text" name="total_final_bill"  readonly class="form-control" id="total_priceforpc" placeholder="اجمالي الفاتورة">--}}
                {{--</div>--}}
                {{--</div>--}}



                <!--End -->



                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-1">
                        <button type="submit" name="savedraft" value="1" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>


                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>
                    <div class="col-sm-1">
                        <a href="{{aurl('invoices')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
                    </div>


                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- Start Ahmed Gorashi-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("button.show").click(function(){
                $("#show").toggle();
            });
        });
        $(document).ready(function(){
            $("button.show").click(function(){
                $("#hidd").hide();
            });
            $("#show").click(function(){
                $("#show").show();
            });
        });
    </script>
    <!-- End Ahmed Gorashi-->

    <script>
        $(function () {
            var zxc = 1;
            $("#AddPdf").click(function () {

                $("#InsertPdf").append(
                    // Add new row

                    ' <tr id="remove'+zxc+' ">' +

                    '            <td>' +
                    '                <input type="file" name="pdf[]" class="form-control"required>' +
                    '            </td>' +
                    '            <td>' +
                    '                <input type="button" id="remove" class="btn btn-danger " value="X" />' +
                    '            </td>' +
                    ' </tr>'+

                    ''
                );
                $('.select2').select2();
                zxc++;
            });

            //remove selected Row
            $("#InsertPdf").on("click", "#remove", function () {
                $(this).closest("tr").remove();

            });

        });


    </script>

    <script type="text/javascript">

        $(document).on("change",".items",function(){
            var count = $(this).attr('data-count');

            $.get("{{ route('itemsid') }}/"+ $(this).val(), function(data){
                $("#go"+count).html(data);
            });

            $.get("{{ route('getItemsColor') }}/"+ $(this).val(), function(data){
                $("#getColor"+count).html(data);
            });
        });

    </script>

    <script type="text/javascript">

        $(document).on("change",".colors",function(){
            var count = $(this).attr('data-count');
            var itemId = $('#items'+count).val();
            var colorId = $(this).val();
            var sizeId = $('#items'+count).val();


            $.get("{{ route('getItemsSize') }}/"+ itemId + '/' + colorId +'/' + count, function(data){
                $("#getSize"+count).html(data);


            });

            $.get("{{ route('getItemsPrice') }}/"+ itemId + '/' + colorId + '/' + sizeId, function(data){
                $("#getPrice"+count).html(data);
            });
        });

    </script>


    <script type="text/javascript">

        $(document).on("change",".quantity",function(){
            var count = $(this).attr('data-count');
            var itemId = $('#items'+count).val();
            var colorId = $('#getColor'+count).val();
            var sizeId = $(this).val();
            // var sizeId = $('#items'+count).val();


            $.get("{{ route('getItemsQuantity') }}/"+ itemId + '/' + colorId + '/' + sizeId, function(data){
                $("#getQuantity"+count).html(data);
            });
            $.get("{{ route('getItemsPrice') }}/"+ itemId + '/' + colorId + '/' + sizeId, function(data){
                $("#getPrice"+count).html(data);
            });
        });

    </script>




    <script>
        $(function () {
            var zxc = 1;
            $("#Badd").click(function () {

                $("#maindiv").append(
                    // Add new row

                    ' <tr id="remove'+zxc+' ">' +
                    '            <td>' +
                    '                <select id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'" required>' +
                    '                    <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>' +
                    '                    @foreach ($items as $item )' +
                    '                        <option value="{{$item->id}}">{{ $item->item_name }} </option>' +
                    '                    @endforeach' +
                    '                </select>' +
                    '            </td>' +
                    '            <td>' +
                    '                <select class="form-control colors"  id="getColor'+zxc+'" data-live-search="true" name="color[]" data-count="'+zxc+'" required>' +
                    '                    <option class="form-control" value="">-----أختر مواصفة المادة ----</option>' +
                    '<color>red<color>                ' +
                    '</select>' +
                    '            </td>' +
                    '            <td>' +
                    '                <div class="quantity" id="getSize'+zxc+'" data-live-search="true" data-count="'+zxc+'" required>' +
                    '                </div>' +
                    '            </td>' +
                    // '            <td>' +
                    // '                <div id="getQuantity'+zxc+'" name="quantity_b[]" ></div>' +
                    // '            </td>' +
                    // '            <td>' +
                    // '                <div id="getPrice'+zxc+'" name="price_b[]" ></div>' +
                    // '            </td>' +
                    // '            <td>' +
                    // '                <input type="text" name="total_price_b[]" class="form-control" id="No3" readonly placeholder="الاجمالي" required>' +
                    // '            </td>' +
                    '            <td>' +
                    '                <input type="text" class="quantity'+zxc+' q_change" id="q_change"  value="0" name="quantity[]"  />' +
                    '' +

                    '            </td>' +
                    '            <td>' +
                    '                <input type="text" class="price'+zxc+' p_change" value="0" id="p_change"  name="price[]"  />' +

                    '            </td>' +
                    '            <td>' +
                    '                <input type="button" id="remove" class="btn btn-danger " value="X" />' +
                    '            </td>' +
                    ' </tr>'+


                    ''
                );
                $('.select2').select2();
                zxc++;
            });

            //remove selected Row
            $("#maindiv").on("click", "#remove", function () {
                $(this).closest("tr").remove();

            });

            //field No1 calculation
            $("#maindiv").on("keyup", "#No1", function () {
                var x = $(this).val();
                var y = $(this).closest("tr").find("input[id='No2']").val();
                var z = parseFloat(x) * parseFloat(y);
                $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                sum();
            });

            //field No2 calculation
            $("#maindiv").on("keyup", "#No2", function () {
                var x = $(this).val();
                var y = $(this).closest("tr").find("input[id='No1']").val();
                var z = parseFloat(y) * parseFloat(x);
                $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                sum();
            });
            //////////////////////////////////////////////////////////////
            //field No2 calculation
            $("#maindiv").on("keyup", "#No3", function () {
                // var x = $(this).val();
                // var y = $(this).closest("tr").find("input[id='No1']").val();
                // var z = parseFloat(y) * parseFloat(x);
                // $(this).closest("tr").find("input[id='No3']").val(z);

                sum();
            });


            $("#maindiv").on("keyup", ".q_change", function () {

                var x = $(this).val();
                var y = $(this).closest("tr").find("input[id='No1']").val(x);
                var y2 = $(this).closest("tr").find("input[id='No2']").val();
                var z = parseFloat(y2) * parseFloat(x);
                $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                var check = $(this).closest("tr").find("select[class='form-control colors']").val();

                if(check == 20){
                    var no3 =$(this).closest("tr").find("input[id='No3']").val();

                    if(no3 == undefined) {
                        $(this).append(' <input type="hidden"  value="0"  id="No3"  />');

                    }
                    var q = $(this).val();
                    var e = $(this).closest("tr").find("input[id='p_change']").val();
                    var r = parseFloat(e) * parseFloat(q);

                    $(this).closest("tr").find("input[id='No3']").val(Math.round(r * 100) / 100);
                }

                sum();
            });


            $("#maindiv").on("keyup", ".p_change", function () {

                var x = $(this).val();
                var y = $(this).closest("tr").find("input[id='No2']").val(x);
                var y2 = $(this).closest("tr").find("input[id='No1']").val();
                var z = parseFloat(y2) * parseFloat(x);

                $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                var check = $(this).closest("tr").find("select[class='form-control colors']").val();

                if(check == 20){
                    var q = $(this).val();
                    var e = $(this).closest("tr").find("input[id='q_change']").val();
                    var r = parseFloat(e) * parseFloat(q);

                    $(this).closest("tr").find("input[id='No3']").val(Math.round(r * 100) / 100);
                }
                sum();
            });


            ///////////////////////////////////////////////////////////////

            //Sum All No3
            // function sum() {
            //     var sum = 0;
            //     $("input[id *='No3']").each(function () {
            //         sum += +$(this).val();
            //     });
            //     $("#mo_textm").val(Math.round(sum * 100) / 100);
            //
            // };

            //Sum All No3
            function sum() {
                var sum = 0;
                $("input[id *='No3']").each(function () {
                    sum += +$(this).val();
                });
               var fire = $("#mo_textm").val(Math.round(sum * 100) / 100 );
                discont();
                console.log(fire);
            };
            $("#colcolet").on("keyup", "#discount,#shippingCosts", function () {
                var sum = 0;
                var disc = $("input[id *='discount']").val();
                // var shipping = $("input[id *='shippingCosts']").val();             
                // var shi = parseFloat($("input[id *='shippingCosts']").val());
                var shipping = document.getElementById("shippingCosts");
                var shi = parseInt(shipping.options[shipping.selectedIndex].value);
                $("input[id *='No3']").each(function () {
                    sum += +$(this).val();
                });

                $("#toltalinvoicesandDis").val((Math.round(sum * 100) / 100) + shi - disc );

            });
            function discont() {
                var sum = 0;
                var disc = $("input[id *='discount']").val();

                $("input[id *='No3']").each(function () {
                    sum += +$(this).val();
                });

                $("#toltalinvoicesandDis").val(Math.round(sum * 100) / 100);
            };

            // sum();



            $(document).ready(function () {

                sum();
            });

        });

    </script>
    {{--Get Devices--}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("change",".devic",function(){
                var count = $(this).attr('selectNumber');

                $.get("{{ route('devicemid') }}/"+ $(this).val(), function(data){
                    $("#gettItems"+count).last().html(data);
                });

                $.get("{{ route('invoices.sumdevices') }}/"+ $(this).val(), function(data){
                    $(".getonedevice"+count).last().html(data);
                });

                $.get("{{ route('invoices.sumDevicesQuantity') }}/"+ $(this).val(), function(data){
                    $(".getDeviceQuantity"+count).last().html(data);
                });

                $(this).attr('name', 'devices['+$(this).val()+'][device_id]');
                $('.changeName'+count).attr('name', 'devices['+$(this).val()+'][device_total_price]');

                $('#remove'+count).find('.device').attr('name', 'quantity['+$(this).val()+']');

            });
        });
    </script>


    <script>


        $(function () {
            var zxc = 1;
            var i = 1;
            // add new row in Main Dive
            $("#add_devices").click(function () {


                $("#devices").append(
                    // Add new row
                    ' <tr id="remove'+zxc+'">' +
                    '<td>' +
                    '<input type="hidden" name="countdiv[]" class="form-control countdiv" value="'+zxc+'" placeholder="كمية">'+
                    '<select  class="form-control  devic devic2 select2" selectNumber="'+zxc+'" name="devices[][device_id]" required >'+
                    '<option class="form-control" value="" >-----اختيار اسم الجهاز ----</option>'+
                    '@foreach ($devices as $device )'+
                    '<option value="{{$device->id}}">{{ $device->devices_name }} </option>'+
                    '@endforeach'+
                    '</select>'+
                    '</td>' +
                    '<td>' +
                    '<div class="getDeviceQuantity'+zxc+'"></div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="getonedevice'+zxc+'"></div>' +
                    '</td>' +
                    '<td>' +
                    '<input id="Nu3" type="text" name="devices[][device_total_price]" value="0" class="form-control changeName'+zxc+' device_total"   autocomplete="off" placeholder="الاجمالي" required>'+
                    '</td>' +
                    '<td>' +
                    '<input type="button" id="remove" class="btn btn-danger " value="X" />' +
                    '<div id="gettItems'+zxc+'"></div>' +
                    '</td>' +
                    '</tr>'+
                    '');
                $('.select2').select2();
                i++;
                zxc++;

            });

            //remove selected Row

            $("#devices").on("click", "#remove", function () {
                $(this).closest("tr").remove();

            });


            //field No1 calculation
            $("#devices").on("keyup", "#Nu1", function () {
                var x = $(this).val();
                var y = $(this).closest("tr").find("input[id='Nu2']").val();
                var z = parseFloat(x) * parseFloat(y);



                $(this).closest("tr").find("input[id='Nu3']").val(Math.round(z * 100) / 100);
                sum();




            });

            //field No2 calculation
            $("#devices").on("keyup", "#Nu2", function () {
                var x = $(this).val();
                var y = $(this).closest("tr").find("input[id='Nu1']").val();
                var z = parseFloat(y) * parseFloat(x);
                $(this).closest("tr").find("input[id='Nu3']").val(Math.round(z * 100) / 100);
                sum();
            });
            //////////////////////////////////////////////////////////////
            //field No2 calculation
            $("#devices").on("keyup", "#Nu3", function () {
                // var x = $(this).val();
                // var y = $(this).closest("tr").find("input[id='No1']").val();
                // var z = parseFloat(y) * parseFloat(x);
                // $(this).closest("tr").find("input[id='No3']").val(z);

                sum();
            });
            ///////////////////////////////////////////////////////////////

            // //Sum All No3
            // function sum() {
            //     var sum = 0;
            //     $("input[id *='Nu3']").each(function () {
            //         sum += +$(this).val();
            //     });
            //     $("#total_final").val(Math.round(sum * 100) / 100 );
            //
            // };

            //Sum All No3
            function sum() {
                var sum = 0;
                $("input[id *='Nu3']").each(function () {
                    sum += +$(this).val();
                });
                $("#total_final").val(Math.round(sum * 100) / 100 );

            };

            // sum();
        });







    </script>


@endsection