@extends('admin.index')
@section('page_title')
    {{trans('invoices.create')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">





    <div class="box">
        <div class="box-header">
            <h3 class="box-title">اضافة offer</h3>
        </div>
        <!-- /.box-header -->

        <div class="col-md-6">
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="{{route('admin.invoices.createRetured')}}"  enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="modal-header">
                                <h4 class="modal-title">مسمي العرض</h4><span style="color: green">  </span>
                            </div>
                            <div class="modal-body">
                                <div class="box-body">
                                    <label class="col-sm-2 control-label" for="name">اسم العرض</label>
                                </div><!-- /.box-body -->


                            </div><!-- /.box-body -->
                            <!-- /.box-footer -->


                            <!-- /.box-body -->

                    <div class="modal-footer">
                        <a href="{{url('admin/invoices')}}" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary pull-right">إنشاء فاتورة</button>
                    </div>
                    </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal -->
    </div>
    <!-- Start Ahmed Gorashi-->

    <!-- End Ahmed Gorashi -->

    <div class="box-body">
        <form class="form-horizontal" method="POST" autocomplete="off" action="{{route('offerStore')}}" id="hidd" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="form-group">
                    <input type="hidden" name="client_id" value="{{ $modelid }}">
                    <label for="name_client" class="col-sm-1 control-label">الاسم</label>
                    <div class="col-sm-3">
                        <input type="text" name="name" class="form-control" id="name_client" placeholder="اسم العرض" value="{{old('name_client')}}" required>
                    </div>

                </div>
                <div class="form-group">
                    <label for="notes" class="col-sm-1 control-label">تفاصيل العرض</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" name="specifications" placeholder="تفاصيل العرض">{{old('notes')}}</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label for="notes" class="col-sm-1 control-label">{{trans('invoices.notes')}}</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="notes" placeholder="{{trans('invoices.notes')}}">{{old('notes')}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image" class="col-sm-1 control-label">{{trans('items.image')}}</label>
                    <div class="col-sm-10">
                        <input type="file" name="image"  id="image">
                    </div>
                </div>
                <hr/>

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
                                                <th>العدد</th>
                                                <th>سعر البيع</th>
                                                <th>الاجمالي</th>
                                                <th>
                                                    #

                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="maindiv">

                                            </tbody>
                                        </table>

                                        <div id="colcolet">

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">سعر العرض</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="price" id="shippingCosts" class="form-control" placeholder="سعر العرض">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>



                                    </div>


                                </div>
                            </div>
                        </div>


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
            <a href="{{aurl('offers')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
        </div>


    </div><!-- /.box-footer -->
    </form>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- Start Ahmed Gorashi-->
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
                    '                <input id="No1" type="number" name="quantity_b[]" class="form-control"  placeholder="كمية" required>' +
                    '            </td>' +
                    '            <td>' +
                    '               <input type="text" name="selling_price[]" class="form-control" id="No2" placeholder="سعر البيع" required>' +
                    '            </td>' +
                    '            <td>' +
                    '                <input type="text" name="total_price_b[]" class="form-control" id="No3" readonly placeholder="الاجمالي" required>' +
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
                $(this).closest("tr").remove().attr('name', 'quantity_b['+$(this).val()+']');

            });

            //field No1 calculation
            $("#maindiv").on("keyup", "#No1", function () {
                var x = $(this).val();
                var y = $(this).closest("tr").find("input[id='No2']").val();
                var z = parseFloat(x) * parseFloat(y);
                $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                sum();
            })

            //field No2 calculation
            $("#maindiv").on("keyup", "#No2", function () {
                var x = $(this).val();
                var y = $(this).closest("tr").find("input[id='No1']").val();
                var z = parseFloat(y) * parseFloat(x);
                $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                sum();
            })

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

                $("#mo_textm2").val(Math.round(sum * 100) / 100 );
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
    @include('admin.bills.script')

@endsection