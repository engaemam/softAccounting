@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('projectitems.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('projectitems.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('projectitems.project_id')}}</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="project_id">
                                <option class="form-control" value="">-----اختيار رقم المشروع ----</option>
                                @foreach ($projects as $project )
                                    <option value="{{$project->id}}" @if(@$projectId == $project->id) selected @endif>{{ $project->project_number }} </option>
                                @endforeach
                            </select>
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
                                            <div id="maindiv">

                                            </div>

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">سعر الاجمالي</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة مواد جديدة</button>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- /.tab-pane -->

                                <div class="tab-pane " id="settings2">

                                    <div class="box-body hereallzsasd">
                                        <div class="form-group" id="devices">

                                        </div>

                                        <div class="form-group ">
                                            <label for="value" class="col-sm-1 control-label">سعر الاجهزة</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="total_final_mogma3"  readonly class="form-control total_final" id="total_final" placeholder="سعر الجهاز كامل">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <button class="btn btn-success " id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة جهاز جديد</button>
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
                    <!-- End -->








                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



    <script type="text/javascript">

        $(document).on("change",".items",function(){
            var count = $(this).attr('data-count');

            $.get("{{ route('projectitems.itemsid') }}/"+ $(this).val(), function(data){
                $("#go"+count).html(data);
            });
        });

    </script>

    <script>
        $(function () {
            var zxc = 1;
            $("#Badd").click(function () {
                $('.select2').select2();

                $("#maindiv").append(
                    // Add new row
                    '<div class="row">' +
                    ' <label class="col-sm-1 control-label" for="name">اختيار اسم الماده</label>' +
                    '<div class="col-sm-2">' +
                    '<select class="form-control select2 items" data-live-search="true" name="item_id[]" data-count="'+zxc+'" required>' +
                    '<option  class="form-control" value="" >-----اختيار اسم الماده ----</option>' +
                    '@foreach ($items as $item )' +
                    '<option value="{{$item->id}}">{{ $item->item_name }} </option>' +
                    '@endforeach' +
                    '</div>' +
                    '<div class="col-sm-2">' +
                    '<input type="hidden" >' +
                    '</div>' +
                    '<label for="price" class="col-sm-1 control-label">كمية</label>' +
                    '<div class="col-sm-2">' +
                    '<input id="No1" type="number" name="quantity_b[]" class="form-control"  placeholder="كمية" required>' +
                    '</div>' +
                    '<label for="price" class="col-sm-1 control-label">سعر الماده</label>' +
                    '<div id="go'+zxc+'"></div>'+
                    '<div class="col-sm-2">' +
                    '<input type="text" name="total_price_b[]" class="form-control" id="No3" readonly placeholder="الاجمالي" required>' +
                    '</div>' +
                    '</span><input type="button" class="btn btn-danger" value="X" /><br /></div>' +
                    '' +

                    ''
                )

                zxc++;
            });

            //remove selected Row
            $("#maindiv").on("click", ".btn", function () {
                $(this).parent().remove();

            });

            //field No1 calculation
            $("#maindiv").on("keyup", "#No1", function () {
                var x = $(this).val();
                var y = $(this).closest("div.row").find("input[id='No2']").val();
                var z = parseInt(x) * parseInt(y);
                $(this).closest("div.row").find("input[id='No3']").val(z);
                sum();
            })

            //field No2 calculation
            $("#maindiv").on("keyup", "#No2", function () {
                var x = $(this).val();
                var y = $(this).closest("div.row").find("input[id='No1']").val();
                var z = parseInt(y) * parseInt(x);
                $(this).closest("div.row").find("input[id='No3']").val(z);
                sum();
            })

            //Sum All No3
            function sum() {
                var sum = 0;
                $("input[id *='No3']").each(function () {
                    sum += +$(this).val();
                });
                $("#mo_textm").val(sum);

            };

            // sum();
        });

    </script>
    {{--Get Devices--}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("change",".devic",function(){
                var count = $(this).attr('selectNumber');
                $.get("{{ route('projectitems.devicemid') }}/"+ $(this).val(), function(data){

                    $("#gettItems"+count).last().html(data);
                    console.log(count);
                });
            });
        });
    </script>

    <script>

        $(function () {
            var i = 1;
            // add new row in Main Dive
            $("#add_devices").click(function () {


                $("#devices").append(
                    // Add new row
                    '<div id="devices" class="devices">'+
                    '<div class="row" >'+
                    '<label class="col-sm-1 control-label" for="name"> اسم الجهاز</label>'+
                    '<div class="col-sm-2">'+
                    '<input type="hidden" name="countdiv[]" class="form-control countdiv" value="'+i+'" placeholder="كمية">'+
                    '<select class="form-control select2 devic" selectNumber="'+i+'" name="device_id[]" required >'+
                    '<option class="form-control" value="" >-----اختيار اسم الجهاز ----</option>'+
                    '@foreach ($devices as $device )'+
                    '<option value="{{$device->id}}">{{ $device->devices_name }} </option>'+
                    '@endforeach'+
                    '</select>'+
                    '</div>'+
                    '<label for="value" class="col-sm-1 control-label">كمية</label>'+
                    '<div class="col-sm-2">'+
                    '<input type="number" id="Nu1" name="quantity[]" class="form-control device"  placeholder="كمية" autocomplete="off" required>'+
                    '</div>'+
                    '<label for="value"  class="col-sm-1 control-label">الاجمالي</label>'+
                    '<div class="col-sm-2">'+
                    '<input id="Nu31" type="text" name="total_price[]" class="form-control device_total"  readonly autocomplete="off" placeholder="الاجمالي" required>'+
                    '</div>'+
                    '</div><div id="gettItems'+i+'"></div><input type="button" class="btn btn-danger" value="X" /> </div>'+
                    ''+
                    ''+
                    ''
                );
                i++;

            });

            //remove selected Row
            $("#devices").on("click", ".btn", function () {
                $(this).parent().remove();

            });


        });




    </script>


@endsection