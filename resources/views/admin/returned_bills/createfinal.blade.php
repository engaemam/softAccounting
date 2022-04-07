@extends('admin.index')
@section('page_title')
    {{trans('invoices.edit')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">





    <div class="box">
        <div class="box-header">
            <h3 class="box-title">فاتورة مرتجعات</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form class="form-horizontal" method="POST" action="{{route('returnedbills.update',[$invoices->id])}}"  enctype="multipart/form-data">

                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">



                        <label class="col-sm-1 control-label" for="name">{{trans('invoices.client_id')}}</label>
                        <div class="col-sm-3">
                            <input class="form-control" name="client_id" type="hidden" readonly value="{{$invoices->client_id}}"><h5>{{$invoices->clients->name_client}}</h5>
                        </div>
                     
                        <div class="col-sm-3">
                            <input class="form-control" type="hidden" name="invoice_source_id" readonly value="{{$invoices->invoice_source_id}}"
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="city" class="col-sm-1 control-label">{{trans('invoices.city')}}</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="hidden" name="city" readonly value="{{$invoices->clients->city }}"><h5>{{$invoices->clients->city}}</h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-sm-1 control-label">{{trans('invoices.notes')}}</label>
                        @if($invoices->notes == null)
                            <h5>لاتوجد ملاحظات</h5>
                        @else
                        <div class="col-sm-3">
                            <input class="form-control" type="hidden" name="notes" readonly value="{{$invoices->notes }}"><h5>{{$invoices->notes}}</h5>
                        </div>
                        @endif
                    </div><br>



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
                                                    <th>اختيار اسم الماده</th>
                                                    <th>الكمية</th>
                                                    <th>المواصفة</th>
                                                    <th>مواصفة 2</th>
                                                    <th>سعر الماده</th>

                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">
                                                @foreach($invoiceitems as $k=>$invoiceitem)
                                                    <tr id="remove{{$k}} ">
                                                        <td>

                                                            <input type="hidden" name="item_id[]" value="{{$invoiceitem->item_id}}">
                                                            <input type="text" class="form-control" readonly=""  value="{{$invoiceitem->items->item_name}}">
                                                        </td>
                                                        <td>
                                                            <input id="No1" type="number" name="quantity_b[]"  class="form-control" min="0" max="{{ \App\Model\Invoiceitems::where('item_id',$invoiceitem->item_id)->where('color',$invoiceitem->color)->where('size',$invoiceitem->size)->pluck('quantity_b')->first() }}" placeholder="كمية المرتجع" required>
                                                            <span>الكمية في المخزن : {{ \App\Model\Invoiceitems::where('item_id',$invoiceitem->item_id)->where('color',$invoiceitem->color)->where('size',$invoiceitem->size)->pluck('quantity_b')->first() }}</span>
                                                        </td>
                                                        <td>
                                                                @foreach($itemscolors as $itemcolor)
                                                                    @if( $itemcolor->id == $invoiceitem->color)
                                                                    <input type="hidden" name="color[]" value="{!! $itemcolor->id !!}">
                                                                    <input type="text" class="form-control" readonly=""  value="{{$itemcolor->name}}">
                                                                    @endif
                                                                @endforeach
                                                        </td>
                                                        @foreach($itemsizes as $k => $specificsize)
                                                            @if($specificsize->id == $invoiceitem->size)
                                                                <td>

                                                                        @foreach($itemsizes as $itemsize)
                                                                        @if($itemsize->id == $invoiceitem->size)
                                                                            <input type="hidden" name="size[]" value="{!! $itemsize->id !!}">
                                                                            <input type="text" class="form-control" readonly=""  value="{{$itemsize->name}}">
                                                                        @endif
                                                                        @endforeach

                                                                </td>
                                                            @endif
                                                        @endforeach
                                                        <td>
                                                            <div >
                                                                <input type="text" name="price_b[]"  value="{{$invoiceitem->price_b}}" class="form-control" id="No2" placeholder="سعر الماده" readonly>

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="total_price_b[]" value="{{$invoiceitem->total_price_b}}" class="form-control" id="No3"  placeholder="الاجمالي" readonly>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
{{--                                            <div class="form-group">--}}
{{--                                                <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة مادة  </button>--}}
{{--                                            </div>--}}
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">إجمالي سعر الأصناف</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" value="{{$invoices->total_final_mgza}}" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي" required>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">مصاريف الشحن</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="shipping_costs" value="{{$invoices->shipping_costs}}" required class="form-control" placeholder="تكاليف الشحن" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label"> الخصم</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="discount" value="{{ $invoices->discount}}" class="form-control" id="discount" placeholder=" الخصم" readonly>
                                                        </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">صافي الفاتورة</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="afterdiscount" value="{{$invoices->afterdiscount}}" readonly class="form-control" id="mo_textm2" placeholder="صافي الفاتورة">
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
                                                <th>الكمية</th>
                                                <th>سعر الافرادي</th>


                                                <th>الاجمالي</th>

                                                <th>
                                                    #
                                                </th>
                                            </tr>
                                            </thead>

                                        </table>
                                        <br>
                                        <div class="form-group ">
                                            <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة جهاز </button>
                                        </div>
                                        <br>

                                        <div class="form-group ">
                                            <label for="value" class="col-sm-1 control-label">سعر الاجهزة</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="total_final_mogma3" value="{{$invoices->total_final_mogma3}}"  readonly class="form-control total_final2" id="total_final" placeholder="سعر الجهاز كامل">
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
                    <div class="col-sm-2">
                        <button type="submit"  class="btn btn-warning pull-right">{{trans('admin.save')}}</button>
                    </div>


                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>

                    <div class="col-sm-1">
                        <a href="{{aurl('invoices')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
                    </div>


                </div><!-- /.box-footer -->
           
            </form>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
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



                $.get("{{ route('getItemsSize') }}/"+ itemId + '/' + colorId, function(data){
                    $("#getSize"+count).html(data);
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
                        '                <select class="form-control select2  items" data-live-search="true" name="color[]"  required>' +
                        '                    <option  class="form-control" value="" >--اختيار مواصفة الماده --</option>' +
                        '                    @foreach ($itemscolors as $itemcolor )' +
                        '                        <option value="{{$itemcolor->id}}">{{ $itemcolor->name }} </option>' +
                        '                    @endforeach' +
                        '                </select>' +
                        '            </td>' +
                        '            <td>' +
                        '                <select class="form-control select2  items" data-live-search="true" name="size[]"  required>' +
                        '                    <option  class="form-control" value="" >--اختيار مواصفة 2 الماده --</option>' +
                        '                    @foreach ($itemsizes as $itemsize )' +
                        '                        <option value="{{$itemsize->id}}">{{ $itemsize->name }} </option>' +
                        '                    @endforeach' +
                        '                </select>' +
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
                    discont()
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