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
        <div class="col-md-6">
            <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#myModal">{{trans('clients.create')}}</button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="{{route('clients.store')}}"  enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" onClick="window.location.href=window.location.href">&times;</button>
                                <h4 class="modal-title">{{trans('clients.create')}}</h4>
                            </div>
                            <div class="modal-body">

                                <div class="box-body">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ $modelid }}">
                                            <label for="name_company" class="col-sm-1 control-label">{{trans('clients.name_company')}}</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="name_company" class="form-control" id="name_company" required placeholder="{{trans('clients.name_company')}}">
                                            </div>
                                            <label for="name_client" class="col-sm-2 control-label">{{trans('clients.name_client')}}</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="name_client" class="form-control" id="name_client" placeholder="{{trans('clients.name_client')}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="city" class="col-sm-1 control-label">{{trans('clients.city')}}</label>
                                            <div class="col-sm-5">
                                                <select name="city" class="form-control select2" required>
                                                    <option value="">   -----   ???????????? ??????????????     ----- </option>
                                                    <option value="??????????????">??????????????</option>
                                                    <option value="????????????">????????????</option>
                                                    <option value="????????????????????">????????????????????</option>
                                                    <option value="??????????????????????">??????????????????????	</option>
                                                    <option value="??????????">??????????	</option>
                                                    <option value="??????????">??????????</option>
                                                    <option value="????????????">????????????</option>
                                                    <option value="?????????? ????????????">?????????? ????????????</option>
                                                    <option value="??????????????">??????????????</option>
                                                    <option value="?????? ????????	">?????? ????????	</option>
                                                    <option value="??????????????">??????????????</option>
                                                    <option value="???????? ??????????">???????? ??????????</option>
                                                    <option value="????????????????">????????????????</option>
                                                    <option value="??????????">??????????</option>
                                                    <option value="??????????">??????????</option>
                                                    <option value="????????????">????????????</option>
                                                    <option value="??????????????">??????????????</option>
                                                    <option value="???????? ??????????">???????? ??????????	</option>
                                                    <option value="??????????????">??????????????</option>
                                                    <option value="????????????">????????????</option>
                                                    <option value="??????????????????">??????????????????</option>
                                                    <option value="??????">??????</option>
                                                    <option value="?????? ??????????">?????? ??????????</option>
                                                    <option value="??????????">??????????</option>
                                                    <option value="????????????????">????????????????</option>
                                                    <option value="????????????">????????????</option>
                                                    <option value="???????????? ????????????">???????????? ????????????</option>
                                                    <option value="????????">????????</option>
                                                </select>
                                            </div>
                                            <label for="client_position" class="col-sm-2 control-label">{{trans('clients.client_position')}}</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="client_position" class="form-control" id="client_position" placeholder="{{trans('clients.client_position')}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-1 control-label">{{trans('clients.phone')}}</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="{{trans('clients.phone')}}">
                                            </div>
                                            <label for="mobile" class="col-sm-2 control-label">{{trans('clients.mobile')}}</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="mobile" class="form-control" id="mobile" placeholder="{{trans('clients.mobile')}}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                        </div>
                                        <div class="form-group">
                                            <label for="notes" class="col-sm-2 control-label">{{trans('clients.notes')}}</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="notes" placeholder="{{trans('clients.notes')}}"></textarea>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->
                                    <!-- /.box-footer -->

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <div class="modal-footer">
                                <input type="button" value="Close" class="btn btn-danger" data-dismiss="modal" onClick="window.location.href=window.location.href">
                                <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                                <button class="btn default pull-right" type="reset">{{trans('clients.reset')}}</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!-- Modal -->
        </div>
        <!-- Start Ahmed Gorashi-->
        <div class="col-md-6">
        <button class="btn btn-primary btn-block btn-lg show" style="margin-bottom: 20px">?????????? ???????????? ????????????????</button>
        </div>
        <!-- End Ahmed Gorashi -->
        <div class="box-body">
            <form class="form-horizontal " id="show" method="POST" action="{{route('invoices.store')}}"  enctype="multipart/form-data">
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
                                    <option value="{{$client->id}}">{{ $client->name_client }} </option>
                            </select>
                        </div>
                        <label class="col-sm-1 control-label" for="name">{{trans('returneditems.invoice_source')}}</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="invoice_source_id" required>
                                <option class="form-control" value="">-----???????? ???????????? ?????????? ----</option>
                                @foreach ($invoicesources as $invoicesource )
                                    <option value="{{$invoicesource->id}}">{{ $invoicesource->name }} </option>
                                @endforeach

                            </select>
                        </div>
                        {{--<label class="col-sm-1 control-label" for="name">????????????</label>--}}
                        {{--<div class="col-sm-3">--}}
                            {{--<select class="form-control select2" name="currency_id" required>--}}
                                {{--<option class="form-control" value="">-----???????????? ?????? ???????????? ----</option>--}}
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
                                <th>?????????? PDF</th>

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
                                {{--<li><a href="#settings2" data-toggle="tab">????????</a></li>--}}
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="box-body">
                                        <div class="form-group">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>???????????? ?????? ????????????</th>
                                                    <th>????????</th>
                                                    <th>?????? ????????????</th>
                                                    <th>????????????????</th>
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
                                                    <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> ?????????? ????????</button>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">?????? ????????????????</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" readonly class="form-control" id="mo_textm" placeholder="?????? ????????????????">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    {{--<button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> ?????????? ???????? ??????????</button>--}}
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
                                                <th>???????????? ?????? ????????????</th>
                                                <th>????????</th>
                                                <th>?????? ????????????????</th>


                                                <th>????????????????</th>

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
                                            <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> ?????????? ???????? </button>
                                        </div>
                                        <br>

                                        <div class="form-group ">
                                            <label for="value" class="col-sm-1 control-label">?????? ??????????????</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="total_final_mogma3"  readonly class="form-control total_final2" id="total_final" placeholder="?????? ???????????? ????????">
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
                {{--<label for="value" class="col-sm-2 control-label">???????????? ???????????????? </label>--}}
                {{--<div class="col-sm-8">--}}
                {{--<input type="text" name="total_final_bill"  readonly class="form-control" id="total_priceforpc" placeholder="???????????? ????????????????">--}}
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
                        <a href="{{aurl('returned_invoices')}}"><span class="btn btn-danger" >{{trans('??????????')}}</span></a>
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
                    '                <select class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'" required>' +
                    '                    <option  class="form-control" value="" >-----???????????? ?????? ???????????? ----</option>' +
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
                    '                <input type="text" name="total_price_b[]" class="form-control" id="No3"  placeholder="????????????????" required>' +
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
                    '<input type="hidden" name="countdiv[]" class="form-control countdiv" value="'+zxc+'" placeholder="????????">'+
                    '<select  class="form-control  devic devic2 select2" selectNumber="'+zxc+'" name="devices[][device_id]" required >'+
                    '<option class="form-control" value="" >-----???????????? ?????? ???????????? ----</option>'+
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
                    '<input id="Nu3" type="text" name="devices[][device_total_price]" class="form-control changeName'+zxc+' device_total"   autocomplete="off" placeholder="????????????????" required>'+
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