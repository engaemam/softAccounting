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

        <div class="col-md-6">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal"> بيانات فاتورة لزبون سابق</button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="{{route('admin.invoices.createRetured')}}"  enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="modal-header">
                                <h4 class="modal-title">{{trans('clients.create')}} </h4><span style="color: green">({{'إختر إسم الزبون أو رقم الهاتف'}})</span>
                            </div>
                            <div class="modal-body">
                                <div class="box-body">
                                    <label class="col-sm-2 control-label" for="name">{{trans('invoices.client_id')}}</label>
                                    <div class="col-sm-4">
                                        <select class="form-control select2" name="client_name">
                                            <option class="form-control" value="">-----اختيار اسم الزبون ----</option>
                                            @foreach ($clients as $client )
                                                <option value="{{$client->id}}">{{ $client->name_client }} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-body">
                                    <label class="col-sm-2 control-label" for="name">{{trans('invoices.phone')}}</label>
                                    <div class="col-sm-4">
                                        <select class="form-control select2" name="client_id">
                                            <option class="form-control" value="">-----اختيار رقم الزبون ----</option>
                                            @foreach ($clients as $client )
                                                <option value="{{$client->id}}">{{ $client->phone}} </option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div><!-- /.box-body -->
                                <!-- /.box-footer -->


                                <!-- /.box-body -->
                                {{--                            <iframe src="{{route('admin.clients.createBills')}}" style="height:400px;width:500px"></iframe>--}}
                            </div>
                            <div class="modal-footer">
                                <a href="{{url('admin/invoices')}}" class="btn btn-danger" data-dismiss="modal">Close</a>
                                <button type="submit" class="btn btn-primary pull-right">إنشاء فاتورة</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!-- Modal -->
        </div>
        <!-- Start Ahmed Gorashi-->

        <!-- End Ahmed Gorashi -->
        <br><br><br><br>
        <div class="box-body">
            <form class="form-horizontal" method="POST" autocomplete="off" action="{{route('invoices.store')}}" id="hidd" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">
                        <input type="hidden" name="client_id" value="{{ $modelid }}">
                        <label for="name_client" class="col-sm-1 control-label">{{trans('invoices.client_id')}}</label>
                        <div class="col-sm-3">
                            <input type="text" name="name_client" class="form-control" id="name_client" placeholder="{{trans('invoices.client_id')}}"  >
                        </div>


                        <label for="invoice_type" class="col-sm-1 control-label">نوع الفاتورة</label>
                        <div class="col-sm-3">
                            <select name="invoice_type" class="form-control select2" required>
                                <option value="">   -----   اختيار نوع الفاتورة     ----- </option>

                                <option value="0" selected>فاتورة بيع</option>


                            </select>
                        </div>
                    </div>
                    <div class="form-group">

                        <label for="city" class="col-sm-1 control-label">{{trans('clients.city')}}</label>
                        <div class="col-sm-3">
                            <select required class="form-control mainAreas" name="city" style="{{ $errors->has('state') ? 'border: 1px solid red' : '' }}">
                                <option value="">برجاء اختر المحافظة</option>

                                @foreach($data as $j)
                                    <option value="{{$j->id}}" data-id="{{$j->branch_receiver->id}}"> {{$j->branch_receiver->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="invoice_type" class="col-sm-1 control-label">المنطقة</label>
                        <div class="col-sm-3">
                            <select required class="form-control subAreas" id="subAreas" name="area_id" style="{{ $errors->has('city') ? 'border: 1px solid red' : '' }}">
                                <option value="">برجاء اختر المنطقة</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('clients.notes')}}</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="notes_client" placeholder="{{trans('clients.notes')}}">{{old('notes')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-1 control-label">{{trans('clients.phone')}}</label>
                        <div class="col-sm-7">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="{{trans('clients.phone')}}" value="{{old('phone')}}">
                        </div>
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

                        <label class="col-sm-1 control-label" for="name">{{trans('invoices.invoice_source')}}</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="invoice_source_id" >
                                <option class="form-control" value="">-----مصدر فاتورة البيع ----</option>
                                @foreach ($invoicesources as $invoicesource )
                                    <option value="{{$invoicesource->id}}">{{ $invoicesource->name }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('invoices.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('invoices.notes')}}">{{old('notes')}}</textarea>
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
                                                        <label for="total_price" class="col-sm-2 control-label">مصاريف الشحن</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="shipping_costs" readonly id="shippingCosts" class="form-control price_shiping" placeholder="مصاريف الشحن">

                                                        </div>
                                                    </div>
                                                </div>

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

    <script>
        $(document).ready(function() {
            $(document).on("change",".mainAreas",function(){

                var dataiddd = $(".mainAreas option:selected").attr('data-id');


                $.get("{{url('admin/ajaxAreas/').'/'}}"+ dataiddd, function(data){

                    $('#subAreas').html(data);
                });
            });

            $(document).on("change",".subAreas",function(){

                var subAreas = $(".subAreas option:selected").val();
                var mainAreas = $(".mainAreas option:selected").val();


                $.get("{{url('admin/ajaxrate/').'/'}}"+ mainAreas+ '/' + subAreas, function(data){

                    $('.price_shiping').val(data);
                });
            });
        });

    </script>

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
                var shi = parseInt($('#shippingCosts').val());


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
                var shi = parseInt($('#shippingCosts').val());

                $("#toltalinvoicesandDis").val((Math.round(sum * 100) / 100) + shi);
            };

            // sum();



            $(document).ready(function () {

                sum();
            });

        });

    </script>

@endsection