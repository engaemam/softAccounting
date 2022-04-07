@extends('admin.index')
@section('page_title')
    {{trans('imports.create')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('imports.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" id="billidz" method="POST" action="{{route('admin.imports.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="bill_number" class="col-sm-1 control-label">{{trans('imports.number')}}</label>
                        <div class="col-sm-2">
                            <input type="text" required name="number" class="form-control"  placeholder="{{trans('imports.number')}}">
                        </div>
                        <label class="col-sm-1 control-label" for="name">{{trans('imports.supplier_id')}}</label>
                        <div class="col-sm-3">

                            <select class="form-control select2" name="supplier_id" required>
                                <option class="form-control " value="">-----اختيار اسم المورد ----</option>
                                @foreach ($suppliers as $supplier )
                                    <option value="{{$supplier->id}}" >{{ $supplier->suppliers_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="date" class="col-sm-1 control-label">{{trans('imports.date')}}</label>
                        <div class="col-sm-2">
                            <input type="date" name="date" required class="form-control" id="date" placeholder="{{trans('imports.date')}}">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="price_before_doller" class="col-sm-1 control-label">{{trans('imports.price_before_doller')}}</label>
                        <div class="col-sm-2">
                            <input type="number" step="any" name="price_doller" class="form-control" id="price_before_doller" placeholder="{{trans('imports.price_before_doller')}}">
                        </div>
                        <label class="col-sm-1 control-label" for="name">العملة</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="currency_id">
                                <option class="form-control" value="">-----اختيار اسم العملة ----</option>
                                @foreach ($currencies as $currency )
                                    <option value="{{$currency->id}}">{{ $currency->currency_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="pdf" class="col-sm-1 control-label">{{trans('bills.pdf')}}</label>
                        <div class="col-sm-2">
                            <input type="file" name="pdf"  class="form-control" id="pdf" placeholder="{{trans('bills.pdf')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('imports.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('imports.notes')}}"></textarea>
                        </div>
                    </div>



                    <!-- Strat -->
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#settings" data-toggle="tab"> </a></li>
                                <li><a href="#settings2" data-toggle="tab">مجمع</a></li>
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
                                                    <th>#</th>
                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">

                                                </tbody>
                                            </table>

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">سعر الاجمالي</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة مواد جديدة</button>
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
                        <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <a href="{{aurl('imports')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
                    </div>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
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
                    '                <select class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'" required>' +
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
                    '               <input type="text" name="price_b[]" class="form-control" id="No2" placeholder="سعر الماده" required>' +
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
                $(this).closest("tr").remove();

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

            };

            // sum();
        });

    </script>



    {{--Get Devices--}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("change",".devic",function(){
                var count = $(this).attr('selectNumber');
                $.get("{{ route('deviceid') }}/"+ $(this).val(), function(data){

                    $("#gettItems"+count).last().html(data);
                    $('.select2').select2();
                });


                $(this).attr('name', 'devices['+$(this).val()+'][device_id]');

                $('.device_quantityy'+count).attr('name', 'devices['+$(this).val()+'][device_quantity]');
                $('.device_total_price'+count).attr('name', 'devices['+$(this).val()+'][device_total_price]');

                $('#remove'+count).find('.device').attr('name', 'quantity['+$(this).val()+']');

            });
        });
    </script>

    <script>

        $(function () {
            var i = 1;
            // add new row in Main Dive
            $("#add_devices").click(function () {

                $(".devices").append(

                    '<div class="row device" >'+
                    '<label class="col-sm-1 control-label" for="name"> اسم الجهاز</label>'+
                    '<div class="col-sm-4">'+
                    '<input type="hidden" name="countdiv[]" class="form-control countdiv" value="'+i+'" placeholder="كمية">'+
                    '<select class="form-control  devic select2" selectNumber="'+i+'" name="devices[][device_id]" required>'+
                    '<option class="form-control" value="null" >-----اختيار اسم الجهاز ----</option>'+
                    '@foreach ($devices as $device)'+
                    '<option value="{{$device->id}}">{{ $device->devices_name }} </option>'+
                    '@endforeach'+
                    '</select>'+
                    '</div>'+
                    '<label for="value" class="col-sm-1 control-label">كمية</label>'+
                    '<div class="col-sm-3">'+
                    '<input type="text" id="Nu1" name="devices[][device_quantity]" class="form-control device_quantity device_quantityy'+i+'"  placeholder="كمية" required>'+
                    '</div>'+
                    '<label for="value"  class="col-sm-1 control-label">الاجمالي</label>'+
                    '<div class="col-sm-2">'+
                    '<input id="Nu31" type="text" name="devices[][device_total_price]" class="form-control device_total device_total_price'+i+'"  readonly placeholder="الاجمالي">'+
                    '</div>'+
                    '<div id="gettItems'+i+'"></div>'+
                    '<input type="button" class="btn btn-danger remove_device" value="X" />'+
                    '</div>'
                );
                i++;
                $('.select2').select2();
            });

            //remove selected Row
            // $("#devices").on("click", ".btn", function () {
            //     $(this).parent().remove();
            //
            // });


        });


    </script>
    @include('admin.bills.script')
@endsection