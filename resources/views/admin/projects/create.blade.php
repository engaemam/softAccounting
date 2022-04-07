@extends('admin.index')
@section('page_title')
    {{trans('projects.create')}}
@endsection
@section('content')
<script>
    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
        }
        else document.getElementById('ifYes').style.display = 'none';

    }

</script>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('projects.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('projects.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="project_number" class="col-sm-1 control-label">{{trans('projects.project_number')}}</label>
                        <div class="col-sm-2">
                            <input type="text" name="project_number" class="form-control" id="project_number"  value="{{rand(111, 999).date("sdmY")}}" readonly placeholder="{{trans('projects.project_number')}}">
                        </div>
                        <label for="name" class="col-sm-1 control-label">{{trans('projects.name')}}</label>
                        <div class="col-sm-7">
                            <input type="text" name="name" required class="form-control" id="name" placeholder="{{trans('projects.name')}}">
                        </div>
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-1 control-label">حالة المشروع</label>
                        <div class="col-sm-2">
                            <label  class="control-label">
                                <input type="radio" name="type" checked id="noCheck" onclick="javascript:yesnoCheck();"  value="عرض سعر">
                                عرض سعر
                            </label>
                            <label for="name" class="control-label">
                                <input type="radio" name="type" id="yesCheck" onclick="javascript:yesnoCheck();"  value="قيد التنفيذ">
                                قيد التنفيذ
                            </label>
                        </div>
                        <label class="col-sm-1 control-label" for="name">{{trans('projects.id_client')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" name="id_client">
                                <option class="form-control" value="">-----اختيار اسم الزبون ----</option>
                                @foreach ($clients2 as $client )
                                    <option value="{{$client->id}}">{{ $client->name_client }} </option>
                                @endforeach
                            </select>
                        </div>
                        {{--<label class="col-sm-1 control-label" for="name">العملة</label>--}}
                        {{--<div class="col-sm-2">--}}
                            {{--<select class="form-control" name="currency_id">--}}
                                {{--<option class="form-control" value="">-----اختيار اسم العملة ----</option>--}}
                                {{--@foreach ($currencies as $currency )--}}
                                    {{--<option value="{{$currency->id}}">{{ $currency->currency_name }} </option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    </div>

                    <div class="form-group " id="ifYes" style="display:none">
                        <label for="project_start_date" class="col-sm-2 control-label">{{trans('projects.project_start_date')}}</label>
                        <div class="col-sm-4">
                            <input type="date" name="project_start_date" class="form-control" id="project_start_date" placeholder="{{trans('projects.project_start_date')}}">
                        </div>
                        <label for="project_creation_date" class="col-sm-2 control-label">{{trans('projects.project_creation_date')}}</label>
                        <div class="col-sm-4">
                            <input type="date" name="project_creation_date" class="form-control" id="project_creation_date" placeholder="{{trans('projects.project_creation_date')}}">
                        </div>
                            <br><br><br>
                        <label for="date_delivery" class="col-sm-2 control-label">{{trans('projects.date_delivery')}}</label>
                        <div class="col-sm-4">
                            <input type="date" name="date_delivery" class="form-control" id="date_delivery" placeholder="{{trans('projects.date_delivery')}}">
                        </div>
                        <label for="date_expirat" class="col-sm-2 control-label">{{trans('projects.date_expirat')}}</label>
                        <div class="col-sm-4">
                            <input type="date" name="date_expirat" class="form-control" id="date_expirat" placeholder="{{trans('projects.date_expirat')}}">
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="image_deal" class="col-sm-1 control-label">{{trans('projects.image_deal')}}</label>
                        <div class="col-sm-10">
                            <input type="file" name="image_deal" class="form-control" id="image_deal" placeholder="{{trans('projects.image_deal')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image_bill" class="col-sm-1 control-label">{{trans('projects.image_bill')}}</label>
                        <div class="col-sm-10">
                            <input type="file" name="image_bill" class="form-control" id="image_bill" placeholder="{{trans('projects.image_bill')}}">
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
                                                    <label for="total_price" class="col-sm-2 control-label">سعر المواد</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>
                                                </div>

                                            </div>



                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i>إضافة مادة</button>
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
                                            <label for="value" class="col-sm-1 control-label">سعر الاجهزة</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="total_final_mogma3"  readonly class="form-control total_final" id="total_final" placeholder="سعر الجهاز كامل">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة جهاز </button>
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
                    <!-- End -->


                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>

                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



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