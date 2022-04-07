@extends('admin.index')
@section('page_title')
    {{trans('bills.create')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('bills.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- /.box-header -->
        <div class="col-md-6">
            <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#myModal">{{trans('suppliers.create')}}</button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="{{route('suppliers.store')}}"  enctype="multipart/form-data">
                            {!! csrf_field() !!}
                        <div class="modal-header">
                            <h4 class="modal-title">{{trans('suppliers.create')}}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">

                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $modelid }}">
                                    <label for="suppliers_name" class="col-sm-1 control-label">{{trans('suppliers.suppliers_name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="suppliers_name" class="form-control" id="suppliers_name" placeholder="{{trans('suppliers.suppliers_name')}}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="manager_name" class="col-sm-1 control-label">{{trans('suppliers.manager_name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="manager_name" class="form-control" id="manager_name" placeholder="{{trans('suppliers.manager_name')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="position_manger" class="col-sm-1 control-label">{{trans('suppliers.position_manger')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="position_manger" class="form-control" id="position_manger" placeholder="{{trans('suppliers.position_manger')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="suppliers_number" class="col-sm-1 control-label">{{trans('suppliers.suppliers_number')}}</label>
                                    <div class="col-sm-5">
                                        <input type="number" name="suppliers_number" class="form-control" id="suppliers_number" placeholder="{{trans('suppliers.suppliers_number')}}">
                                    </div>
                                    <label for="mobile" class="col-sm-1 control-label">{{trans('suppliers.mobile')}}</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="mobile" class="form-control" id="mobile" placeholder="{{trans('suppliers.mobile')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="country" class="col-sm-1 control-label">{{trans('suppliers.country')}}</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="country" class="form-control" id="country" placeholder="{{trans('suppliers.country')}}" required>
                                    </div>
                                </div>

                            </div><!-- /.box-body -->

                        </div>

                        <div class="box-footer ">

                        </div>
                        <!-- /.box-footer -->
                        <div class="modal-footer">
                            <a href="{{url('admin/bills')}}" class="btn btn-danger" data-dismiss="modal">Close</a>
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
        <!-- End Ahmed Gorashi -->
        <div class="box-body" id="show-content">
            <form class="form-horizontal" method="POST" action="{{route('bills.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                        <div class="col-md-6">
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
                                            <iframe src="{{route('admin.suppliers.createBills')}}" style="height:400px;width:500px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" value="Close" class="btn btn-danger" data-dismiss="modal" onClick="window.location.href=window.location.href">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Modal -->
                        </div>




                    <br><br><br><br><br>

                    <div class="form-group">
                        <label for="date" class="col-sm-1 control-label">{{trans('suppliers.name')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" name="supplier_id" required>
                                    <option value="{{$supplier->id}}" @if($bills->supplier_id == $supplier->id) selected @endif>{{ $supplier->suppliers_name }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{trans('bills.pdf')}}</th>

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
                        <label for="notes" class="col-sm-1 control-label">{{trans('bills.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('bills.notes')}}"></textarea>
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
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">صافي الفاتورة</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" name="afterdiscount" readonly class="form-control" id="mo_textm2" placeholder="صافي الفاتورة">
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- /.tab-pane -->

                                <div class="tab-pane " id="settings2">

                                    <div  class="box-body hereallzsasd">
                                        <div id="" class="devices">
                                            <div id="getItems"></div>
                                        </div>

                                        <div class="form-group" id="devices" ></div>
                                        <div class="form-group ">
                                            <label for="value" class="col-sm-2 control-label">سعر الاجهزة</label>
                                            <div class="col-sm-3">
                                                <input type="text"  name="total_final_mogma3"  readonly class="form-control total_final" id="total_final" placeholder="سعر الجهاز كامل">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <button class="btn btn-success add_field_button_mo" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة جهاز جديد</button>
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
                        <button type="submit" name="savedraft" value="1" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" name="savedraft" value="0" class="btn btn-warning pull-right">{{trans('admin.savedraft')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <a href="{{aurl('bills')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
                    </div>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- Modal -->
    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="{{route('items.store')}}"  enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-1 control-label">{{trans('items.item_name')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" required name="item_name" class="form-control" id="inputEmail3" placeholder="{{trans('items.item_name')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="specifications" class="col-sm-1 control-label">{{trans('items.specifications')}}</label>
                                <div class="col-sm-10">
                                    <textarea name="specifications" class="form-control" placeholder="{{trans('items.specifications')}}" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="specifications" class="col-sm-1 control-label">{{trans('items.city')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="city" class="form-control" id="city" required placeholder="{{trans('items.city')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-sm-1 control-label">{{trans('items.image')}}</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image"  id="image">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="col-sm-1 control-label">{{trans('items.quantity')}}</label>
                                <div class="col-sm-5">
                                    <input type="number" name="quantity" readonly class="form-control" id="quantity" placeholder="{{trans('items.quantity')}}">
                                </div>
                                <label for="quantity" class="col-sm-1 control-label">{{trans('items.price')}}</label>
                                <div class="col-sm-4">
                                    <input type="number" name="price" readonly  class="form-control" id="price" placeholder="{{trans('items.price')}}">
                                </div>
                            </div>
                            <div class="form-group">

                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer ">
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                                <input type="submit" name="cancelvalue" value="CANCEL" onClick="self.close()">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
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
@include('admin.bills.script')
@endsection
