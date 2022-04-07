@extends('admin.index')
@section('page_title')
    {{trans('deviceitems.create')}}
@endsection
@section('content')
    <script src="{{url('/')}}/js/jquery.js"></script>
    <script src="{{url('/')}}/js/jquery.min.js"></script>

    <style>
        btn-group bootstrap-select form-control{
            display: none;
        }
    </style>
    <script type="text/javascript">

        $(document).ready(function() {

            //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
            $(".add-more").click(function(){
                var html = $(".copy-fields").html();

                $(".after-add-more").before(html);
                $('.selectpicker').selectpicker('');


            });

//here it will remove the current value of the remove button which has been pressed
            $("body").on("click",".remove",function(){
                $(this).parents(".control-group").remove();
            });

        });

    </script>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('deviceitems.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('deviceitems.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('deviceitems.devices_id')}}</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" required data-live-search="true"  name="devices_id" title="اختيار اسم الجهاز" >

                                @foreach ($devices as $device )
                                    <option value="{{$device->id}}" @if(@$deviceId == $device->id) selected @endif>{{ $device->devices_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group ">
                        <label class="col-sm-1 control-label" for="name">اختيار اسم الماده</label>
                        <div class="col-sm-4">
                            <select id="item_id"  required class="form-control select2" data-live-search="true" name="item_id[]"  title="اختيار اسم الماده">

                                @foreach ($items as $item )
                                    <option value="{{$item->id}}" @if($deviceitems->item_id == $item->id) selected @endif>{{ $item->item_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="number_items"  class="col-sm-1 control-label">كمية</label>
                        <div class="col-sm-2">
                            <input type="number" required name="number_items[]" class="form-control" id="number_items" placeholder="كمية">
                        </div>

                    </div>


                    <div id="devices"></div>


                    <div class="form-group">
                        <div class="col-sm-10">
                            <button class="btn btn-success" id="add_devices" type="button"> اضافة مادة <i class="glyphicon glyphicon-plus"></i></button>
                        </div>
                    </div>

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


    <script>
        $(function () {
            var i = 1;
            // add new row in Main Dive
            $("#add_devices").click(function () {


                $("#devices").append(

                    // Add new row
                    ''+
                    ' <div class="form-group">'+
                    '<div class="row" >'+
                    '<label class="col-sm-1 control-label" for="name">{{trans('deviceitems.item_id')}}</label>'+
                    '<div class="col-sm-4">'+
                    '<select required class="form-control select2"  name="item_id[]">'+
                    '<option  value="">-----اختيار اسم المادة ---- </option>'+
                    ' @foreach ($items as $item )'+
                    '<option  value="{{$item->id}}">{{ $item->item_name }} </option>'+
                    '@endforeach'+
                    '</select>'+
                    '</div>'+
                    '<label for="number_items" class="col-sm-2 control-label">{{trans('كمية')}}</label>'+
                    '<div class="col-sm-2">'+
                    '<input type="text" name="number_items[]" required class="form-control" required  id="number_items" placeholder="{{trans('كمية')}}">'+
                    '</div>'+

                    '<input type="button" class="btn btn-danger" value="X" /> </div></div>'+
                    ''
                )
                $('.select2').select2();
            });
            //remove selected Row
            $("#devices").on("click", ".btn", function () {
                $(this).parent().remove();

            });

        });




    </script>
@endsection