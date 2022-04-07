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

                <form class="form-horizontal" method="POST" autocomplete="off" action="{{url('admin/invoices/')}}/{{$invoices->id}}"  enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">

                    </div>

                    <div class="form-group">


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
                    </div>


                    <div class="form-group">
                        <label for="city" class="col-sm-1 control-label">{{trans('invoices.city')}}</label>
                        <div class="col-sm-5">
                            <input type="text" value="{{$invoices->clients->city}}" readonly class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('invoices.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('invoices.notes')}}"> {{$invoices->notes}}</textarea>
                        </div>
                    </div>
                    @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('invoices.status')}}</label>
                        <div class="col-sm-3">
                        <select class="form-control select2" name="status_id" required>
                            @foreach($invoicesStatus as $status)
                                <option value="{{$status->id}}" @if($status->id == $invoices->status_id) selected @endif>{{$status->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    @endif


                    <!-- Strat -->
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#settings" data-toggle="tab"> </a></li>
                                {{--<li><a href="#settings2" data-toggle="tab">مجمع</a></li>--}}
                            </ul>

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
                                                        <input type="text" name="total_final_mgza" value="{{$invoices->total_final_mgza}}" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="colcolet">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label">مصاريف الشحن</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="shipping_costs" id="shippingCosts" value="{{$invoices->shipping_costs}}" class="form-control" placeholder="مصاريف الشحن">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label"> الخصم</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="discount" class="form-control" id="discount" value="{{$invoices->discount}}" placeholder=" الخصم">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label">صافي الفاتورة</label>
                                                        <div class="col-sm-3">
                                                            <input type="number" name="afterdiscount" readonly class="form-control" id="toltalinvoicesandDis" value="{{$invoices->afterdiscount}}"placeholder="صافي الفاتورة">
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- /.tab-pane -->

                              
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
         



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
                    $("#mo_textm").val(Math.round(sum * 100) / 100);

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
                $("#colcolet").on("keyup", "#discount,#shippingCosts", function () {
                    var sum = 0;
                    var disc = $("input[id *='discount']").val();
                    var shipping = $("input[id *='shippingCosts']").val();
                    var shi = parseFloat($("input[id *='shippingCosts']").val());
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


    $.get("{{ route('getItemsSize') }}/"+ itemId + '/' + colorId, function(data){
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

     

@endsection