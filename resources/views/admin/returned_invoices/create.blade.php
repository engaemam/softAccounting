@extends('admin.index')
@section('page_title')
    {{trans('returneditems.create')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">





    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('returneditems.create')}}</h3>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
            <form class="form-horizontal" id="show" method="POST" action="{{route('invoices.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">

{{--                        <label class="col-sm-1 control-label">{{trans('returneditems.invoices_number')}}</label>--}}
{{--                        <div class="col-sm-3">--}}
{{--                            <input type="text" required name="invoice_number" class="form-control"  placeholder="{{trans('returneditems.invoices_number')}}">--}}
{{--                        </div>--}}
                        <label  class="col-sm-1 control-label">{{trans('returneditems.date')}}</label>
                        <div class="col-sm-3">
                            <input type="date" name="date" required class="form-control" placeholder="{{trans('returneditems.date')}}">
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-1 control-label" for="name">{{trans('returneditems.client_id')}}</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="client_id" required>
                                <option class="form-control" value="">-----اختيار اسم الزبون ----</option>
                                @foreach ($clients as $client )
                                    <option value="{{$client->id}}">{{ $client->name_client }} </option>
                                @endforeach

                            </select>
                        </div>
                        <label class="col-sm-1 control-label" for="name">{{trans('returneditems.invoice_source')}}</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="invoice_source_id" required>
                                <option class="form-control" value="">-----مصدر فاتورة البيع ----</option>
                                @foreach ($invoicesources as $invoicesource )
                                    <option value="{{$invoicesource->id}}">{{ $invoicesource->name }} </option>
                                @endforeach

                            </select>
                        </div>
                        {{--<label class="col-sm-1 control-label" for="name">العملة</label>--}}
                        {{--<div class="col-sm-3">--}}
                            {{--<select class="form-control select2" name="currency_id" required>--}}
                                {{--<option class="form-control" value="">-----اختيار اسم العملة ----</option>--}}
                                {{--@foreach ($currencies as $currency )--}}
                                    {{--<option value="{{$currency->id}}">{{ $currency->currency_name }} </option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    </div>
                    <div class="form-group">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>تحميل PDF</th>

                                <th>
                                    <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="AddPdf" type="button"><i class="glyphicon glyphicon-plus"></i> </button>

                                </th>
                            </tr>
                            </thead>
                            <tbody id="InsertPdf">

                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-sm-1 control-label">{{trans('returneditems.city')}}</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="city" placeholder="{{trans('returneditems.city')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('returneditems.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('returneditems.notes')}}"></textarea>
                        </div>
                    </div>



                    <!-- Strat -->
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#settings" data-toggle="tab"> </a></li>
                                {{--<li><a href="#settings2" data-toggle="tab">مجمع</a></li>--}}
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="box-body">
                                        <div class="form-group">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>تحديد المواد</th>
                                                    <th>اختيار اسم الماده</th>
                                                    <th>كمية</th>
                                                    <th>سعر الماده</th>
                                                    <th>الاجمالي</th>
                                                    <th>
                                                        #

                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">

                                                </tbody>
                                            </table>
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة مادة</button>
                                                </div>
                                                <label for="total_price" class="col-sm-2 control-label"><b style="color: red">* ضع قيمة الخصم أولاً إذا كان هنالك خصم >></b></label>
                                                <label for="total_price" class="col-sm-2 control-label">قيمة الخصم</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="discount" class="form-control" id="discount" placeholder="قيمة الخصم">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">سعر الاجمالي</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>
                                                    <label for="total_price" class="col-sm-2 control-label">السعر بعد الخصم</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" name="afterdiscount" readonly class="form-control" id="mo_textm2" placeholder="السعر بعد الخصم">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    {{--<button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة مواد جديدة</button>--}}
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
                                                <th>تحديد المواد</th>
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
                    <div class="col-sm-2">
                        <button type="submit" name="savedraft" value="0" class="btn btn-warning pull-right">{{trans('admin.savedraft')}}</button>
                    </div>

                    <div class="col-sm-1">
                        <a href="{{aurl('returned_invoices')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
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
            $.get("{{ route('getItemsQuantity') }}/"+ $(this).val(), function(data){
                $("#getQuantity"+count).html(data);
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
                    '                <input type="checkbox" class="btn btn-success" />' +
                    '            </td>' +
                    '            <td>' +
                    '                <select class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'" required>' +
                    '                    <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>' +
                    '                    @foreach ($items as $item )' +
                    '                        <option value="{{$item->id}}">{{ $item->item_name }} </option>' +
                    '                    @endforeach' +
                    '                </select>' +
                    '            </td>' +
                    '            <td>' +
                    '                <div id="getQuantity'+zxc+'"></div>' +
                    '            </td>' +
                    '            <td>' +
                    '                <div id="go'+zxc+'"></div>' +
                    '            </td>' +
                    '            <td>' +
                    '                <input type="text" name="total_price_b[]" class="form-control" id="No3"  placeholder="الاجمالي" required>' +
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
            ///////////////////////////////////////////////////////////////

            //Sum All No3
            function sum() {
                var sum = 0;
                $("input[id *='No3']").each(function () {
                    sum += +$(this).val();
                });
                $("#mo_textm").val(Math.round(sum * 100) / 100 );

            };

            //Sum All No3
            function sum() {
                var sum = 0;
                $("input[id *='No3']").each(function () {
                    sum += +$(this).val();
                });
                $("#mo_textm").val(Math.round(sum * 100) / 100 );
                discont();
            };
            function discont() {
                var sum = 0;
                var disc = $("input[id *='discount']").val();
                var dec = (disc / 100).toFixed(2);
                $("input[id *='No3']").each(function () {
                    sum += +$(this).val();
                });

                $("#mo_textm2").val(Math.round(sum) - disc);
            };
            // sum();
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
                    '<input id="Nu3" type="text" name="devices[][device_total_price]" class="form-control changeName'+zxc+' device_total"   autocomplete="off" placeholder="الاجمالي" required>'+
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

            //Sum All No3
            function sum() {
                var sum = 0;
                $("input[id *='Nu3']").each(function () {
                    sum += +$(this).val();
                });
                $("#total_final").val(Math.round(sum * 100) / 100 );

            };

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