@extends('admin.index')
@section('page_title')
    {{trans('invoices.edit')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">





    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('invoices.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form class="form-horizontal" method="POST" action="{{route('admin.returnedbills.update',[$invoices->id])}}"  enctype="multipart/form-data">

                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">

                        {{--                        <label class="col-sm-1 control-label">{{trans('invoices.invoices_number')}}</label>--}}
                        {{--                        <div class="col-sm-3">--}}
                        {{--                            <input type="text" required name="invoice_number" value="{{$invoices->invoice_number}}" class="form-control"  placeholder="{{trans('invoices.invoices_number')}}">--}}
                        {{--                        </div>--}}
                        <label  class="col-sm-1 control-label">{{trans('invoices.date')}}</label>
                        <div class="col-sm-3">
                            <input type="date" name="date" required value="{{$invoices->date}}" class="form-control" placeholder="{{trans('invoices.date')}}">
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


                        <label class="col-sm-1 control-label" for="name">{{trans('invoices.client_id')}}</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="client_id" required>
                                <option class="form-control" value="">-----اختيار اسم الزبون ----</option>
                                @foreach ($clients as $client )
                                    <option value="{{$client->id}}" @if($invoices->client_id == $client->id ) selected @endif>{{ $client->name_client }} </option>
                                @endforeach

                            </select>
                        </div>
                        <label class="col-sm-1 control-label" for="name">{{trans('invoices.invoice_source')}}</label>
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
                        <label for="city" class="col-sm-1 control-label">{{trans('invoices.city')}}</label>
                        <div class="col-sm-5">
                            <select name="city" class="form-control" required>
                                <option value="">   -----   اختيار المدينة     ----- </option>
                                <option value="القاهرة"@if($invoices->city=='القاهرة') selected @endif>القاهرة</option>
                                <option value="الجيزة"@if($invoices->city=='الجيزة') selected @endif>الجيزة</option>
                                <option value="الإسكندرية"@if($invoices->city=='الإسكندرية') selected @endif>الإسكندرية</option>
                                <option value="الإسماعيلية"@if($invoices->city=='الإسماعيلية') selected @endif>الإسماعيلية	</option>
                                <option value="أسوان"@if($invoices->city=='أسوان') selected @endif>أسوان	</option>
                                <option value="أسيوط"@if($invoices->city=='أسيوط') selected @endif>أسيوط</option>
                                <option value="الأقصر"@if($invoices->city=='الأقصر') selected @endif>الأقصر</option>
                                <option value="البحر الأحمر"@if($invoices->city=='البحر الأحمر') selected @endif>البحر الأحمر</option>
                                <option value="البحيرة"@if($invoices->city=='البحيرة') selected @endif>البحيرة</option>
                                <option value="بني سويف"@if($invoices->city=='بني سويف') selected @endif>بني سويف	</option>
                                <option value="بورسعيد"@if($invoices->city=='بورسعيد') selected @endif>بورسعيد</option>
                                <option value="جنوب سيناء"@if($invoices->city=='جنوب سيناء') selected @endif>جنوب سيناء</option>
                                <option value="الدقهلية"@if($invoices->city=='الدقهلية') selected @endif>الدقهلية</option>
                                <option value="دمياط"@if($invoices->city=='دمياط') selected @endif>دمياط</option>
                                <option value="سوهاج"@if($invoices->city=='سوهاج') selected @endif>سوهاج</option>
                                <option value="السويس"@if($invoices->city=='السويس') selected @endif>السويس</option>
                                <option value="الشرقية"@if($invoices->city=='الشرقية') selected @endif>الشرقية</option>
                                <option value="شمال سيناء"@if($invoices->city=='شمال سيناء') selected @endif>شمال سيناء	</option>
                                <option value="الغربية"@if($invoices->city=='الغربية') selected @endif>الغربية</option>
                                <option value="الفيوم"@if($invoices->city=='الفيوم') selected @endif>الفيوم</option>
                                <option value="القليوبية"@if($invoices->city=='القليوبية') selected @endif>القليوبية</option>
                                <option value="قنا"@if($invoices->city=='قنا') selected @endif>قنا</option>
                                <option value="كفر الشيخ"@if($invoices->city=='كفر الشيخ') selected @endif>كفر الشيخ</option>
                                <option value="مطروح"@if($invoices->city=='مطروح') selected @endif>مطروح</option>
                                <option value="المنوفية"@if($invoices->city=='المنوفية') selected @endif>المنوفية</option>
                                <option value="المنيا"@if($invoices->city=='المنيا') selected @endif>المنيا</option>
                                <option value="الوادي الجديد"@if($invoices->city=='الوادي الجديد') selected @endif>الوادي الجديد</option>
                                <option value="اخري"@if($invoices->city=='اخري') selected @endif>اخري</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('invoices.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('invoices.notes')}}"> {{$invoices->notes}}</textarea>
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
                                                    <th>الكمية</th>
                                                    <th>المواصفة</th>
                                                    <th>القياس</th>
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
                                                            <input id="No1" type="number" name="quantity_b[]" value="0" class="form-control"  placeholder="كمية المرتجع" required>
                                                            <span>القيمة الاساسية : {{$invoiceitem->quantity_b}}</span>
                                                        </td>
                                                        <td>
                                                            <select name="color[]" class="form-control select2  items" data-live-search="true">
                                                                <option value=""> ----إختر المواصفة ---- </option>
                                                                @foreach($itemscolors as $itemcolor)
                                                                    <option value="{!! $itemcolor->id !!}" @if( $itemcolor->id == $invoiceitem->color) selected @endif>{!! $itemcolor->name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="size[]" class="form-control select2  items" data-live-search="true">
                                                                <option value=""> ----إختر مواصفة 2 ---- </option>
                                                                @foreach($itemsizes as $itemsize)
                                                                    <option value="{!! $itemsize->id !!}" @if($itemsize->id == $invoiceitem->size) selected @endif>{!! $itemsize->name !!}</option>
                                                                @endforeach
                                                            </select>
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

                                            <div class="form-gourp">
                                                <label for="total_price" class="col-sm-3 control-label"><b style="color: red">* ضع قيمة الخصم أولاً إذا كان هنالك خصم >></b></label>
                                                <label for="total_price" class="col-sm-2 control-label">قيمة الخصم</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="discount" class="form-control" id="discount" placeholder="قيمة الخصم">
                                                </div>
                                            </div><br><br><br>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">سعر الاجمالي</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" value="{{$invoices->total_final_mgza}}" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>
                                                    <label for="total_price" class="col-sm-2 control-label">السعر بعد الخصم</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="afterdiscount" value="{{$afterdis}}" readonly class="form-control" id="mo_textm2" placeholder="السعر بعد الخصم">
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
                        <button type="submit" name="savedraft" value="0" class="btn btn-warning pull-right">{{trans('admin.savedraft')}}</button>
                    </div>


                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>

                    <div class="col-sm-1">
                        <a href="{{aurl('invoices')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
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
                        '                    <option  class="form-control" value="" >--اختيار لون الماده --</option>' +
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