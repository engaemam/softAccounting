@extends('admin.index')
@section('page_title')
    {{trans('returneditems.edit')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">





    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('returneditems.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

                <form class="form-horizontal" method="POST" action="{{url('admin/returned_invoices/')}}/{{$invoices->id}}"  enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">

{{--                        <label class="col-sm-1 control-label">{{trans('returneditems.invoices_number')}}</label>--}}
{{--                        <div class="col-sm-3">--}}
{{--                            <input type="text" required name="invoice_number" value="{{$invoices->invoice_number}}" class="form-control"  placeholder="{{trans('returneditems.invoices_number')}}">--}}
{{--                        </div>--}}
                        <label  class="col-sm-1 control-label">{{trans('returneditems.date')}}</label>
                        <div class="col-sm-3">
                            <input type="date" name="date" required value="{{$invoices->date}}" class="form-control" placeholder="{{trans('returneditems.date')}}">
                        </div>
                        <label  class="col-sm-1 control-label">{{trans('invoices.status')}}</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="status_id" required>
                                <option class="form-control" value="">-----اختيار حالة الفاتورة ----</option>
                                @foreach ($statuses as $status )
                                    <option value="{{$status->id}}" @if($invoices->status_id == $status->id ) selected @endif>{{ $status->name }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('clients.create')}}</label>

                        <div class="col-sm-3">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">{{trans('clients.create')}}</button>
                            <br><span style="color: red">*برجاء إضافة زبون جديد قبل انشاء فاتورة</span>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" onClick="window.location.href=window.location.href">&times;</button>
                                            <h4 class="modal-title">{{trans('suppliers.create')}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{route('admin.clients.createBills')}}" style="height:400px;width:500px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" value="Close" class="btn btn-danger" data-dismiss="modal" onClick="window.location.href=window.location.href">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Modal -->
                        </div>


                        <label class="col-sm-1 control-label" for="name">{{trans('returneditems.client_id')}}</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="client_id" required>
                                <option class="form-control" value="">-----اختيار اسم الزبون ----</option>
                                @foreach ($clients as $client )
                                    <option value="{{$client->id}}" @if($invoices->client_id == $client->id ) selected @endif>{{ $client->name_client }} </option>
                                @endforeach

                            </select>
                        </div>
                        <label class="col-sm-1 control-label" for="name">{{trans('returneditems.invoice_source')}}</label>
                        <div class="col-sm-3">
                            <div class="form-group">
                                    <select name="invoice_source_id" class="form-control select2"  required>
                                        @foreach ($invoicesources as $invoicesource )
                                            <option value="{!! $invoicesource->id !!}" @if($invoicesource->id  == $invoices->invoice_source_id) selected @endif>{!! $invoicesource->name !!}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        {{--<label class="col-sm-1 control-label" for="name">العملة</label>--}}
                        {{--<div class="col-sm-2">--}}
                            {{--<select class="form-control " name="currency_id" required>--}}
                                {{--<option class="form-control" value="">-----اختيار اسم العملة ----</option>--}}
                                {{--@foreach ($currencies as $currency )--}}
                                    {{--<option value="{{$currency->id}}" @if($invoices->currency_id == $currency->id ) selected @endif>{{ $currency->currency_name }} </option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-sm-1 control-label">{{trans('returneditems.city')}}</label>
                        <div class="col-sm-4">
                            <input class="form-control" name="city" placeholder="{{trans('returneditems.city')}}" value="{{$invoices->city}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('returneditems.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('returneditems.notes')}}"> {{$invoices->notes}}</textarea>
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
                                                @foreach($invoiceitems as $k=>$invoiceitem)
                                                <tr id="remove{{$k}} ">
                                                                <td>

                                                                            <input type="hidden" name="item_id[]" value="{{$invoiceitem->item_id}}">
                                                                            <input type="text" class="form-control" readonly=""  value="{{$invoiceitem->items->item_name}}">
                                                                    </td>
                                                               <td>
                                                                        <input id="No1" type="number" name="quantity_b[]" value="{{$invoiceitem->quantity_b}}" class="form-control"  placeholder="كمية" required>
                                                                    </td>
                                                                <td>
                                                                        <div >
                                                                            <input type="text" name="price_b[]"  value="{{$invoiceitem->price_b}}" class="form-control" id="No2" placeholder="سعر الماده" required>

                                                                        </div>
                                                                    </td>
                                                                <td>
                                                                       <input type="text" name="total_price_b[]" value="{{$invoiceitem->total_price_b}}" class="form-control" id="No3"  placeholder="الاجمالي" required>
                                                                    </td>
                                                                <td>
                                                                       <input type="button" id="remove" class="btn btn-danger " value="X" />
                                                                    </td>
                                                     </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            <div class="form-group">
                                                <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة مادة  </button>
                                            </div>


                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">سعر الاجمالي</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" value="{{$invoices->total_final_mgza}}" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">

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
                                            @php $temp = 1001; @endphp
                                            @foreach($invoicedevices as $invoicedevice)

                                             <tr id="remove'+zxc+'">
                                                 <td>
                                                     <input type="hidden" name="devices[{{$invoicedevice->device_id}}][device_id]" value="{{$invoicedevice->device_id}}">
                                                     <input type="text" class="form-control" readonly=""  value="{{$invoicedevice->devices->devices_name}}">
                                                      </td>
                                                            <td>
                                                        <input type="text" id="Nu1" name="devices[{{$invoicedevice->device_id}}][device_quantity]" value="{{$invoicedevice->quantity}}" class="form-control device"  placeholder="كمية" autocomplete="off" required>
                                                                </td>
                                                            <td>
                                                                <input type="text" class="form-control onedevice" id="Nu2" name="devices[{{$invoicedevice->device_id}}][device_price]" value="{{$invoicedevice->onedevice}}"  />                                                            </td>

                                                            <td>
                                                    <input id="Nu3" type="text" name="devices[{{$invoicedevice->device_id}}][device_total_price]" value="{{$invoicedevice->total_price}}" class="form-control device_total"   autocomplete="off" placeholder="الاجمالي" required>
                                                        </td>

                                                            <td>
                                                                @foreach($invoicedevice->Invoicedeviceitems as $valuess)
                                                                        <div class="materials">
                                                                            <div class="row">
                                                                                {{--<label class="col-sm-1 control-label" for="name"> اسم الماده</label>--}}
                                                                                <div class="col-sm-2">

                                                                                    <input type="hidden" name="devices[{{$valuess->device_id}}][device_items][{{$temp}}][id]" value="{{$valuess->item_id_devices}}">
                                                                                    <input type="hidden"  readonly value="{{$valuess->items->item_name}}"/>
                                                                                </div>
                                                                                {{--<label for=""  class="col-sm-1 control-label">كمية</label>--}}
                                                                                <div class="col-sm-1">
                                                                                    <input  type="hidden"  name="devices[{{$valuess->device_id}}][device_items][{{$temp}}][qu]" value="{{$valuess->quantity_old}}" data-value="{{$valuess->quantity_old}}" id="" class="" placeholder="كمية">
                                                                                    <input  type="hidden"  name="devices[{{$valuess->device_id}}][device_items][{{$temp}}][quantity_old]" value="{{$valuess->quantity_old}}" data-value="{{$valuess->quantity_old}}" id="" class="" placeholder="كمية">
                                                                                </div>

                                                                                {{--<label for=""  class="col-sm-1 control-label">سعر</label>--}}
                                                                                <div class="col-sm-2">
                                                                                    <input type="hidden"  name="devices[{{$valuess->device_id}}][device_items][{{$temp}}][p]" value="{{$valuess->price_devices}}"  class="" placeholder="سعر الماده" required>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <input type="hidden" name="devices[{{$valuess->device_id}}][device_items][{{$temp}}][total_p]" value="{{$valuess->total_devices}}" class=" " readonly  placeholder="الاجمالي">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @php $temp++ @endphp
                                                                @endforeach
                                                                 <input type="button" id="remove" class="btn btn-danger " value="X" />

                                                         </td>

                                                 </tr>

                                                @endforeach


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
                        <button type="submit" name="savedraft" value="0" class="btn btn-warning pull-right">{{trans('admin.savedraft')}}</button>
                    </div>


                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>

                    <div class="col-sm-1">
                        <a href="{{aurl('returned_invoices')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
                    </div>


                </div><!-- /.box-footer -->
            </form>
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