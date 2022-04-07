@extends('admin.index')
@section('page_title')
    {{trans('items.add')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('items.add')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('items.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{ $modelid }}">
                    <label for="specifications" class="col-sm-1 control-label">{{trans('items.item_cates')}}</label>
                    <div class="col-sm-10">
                     <select name="category_id" class="form-control" required>
                        <option value=""> ----إختر التصنيف ---- </option>
                        @foreach($items_cates as $items_cate)
                            <option value="{!! $items_cate->id !!}">{!! $items_cate->name !!}</option>
                        @endforeach
                    </select>
                    </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">{{trans('items.item_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" required name="item_name" class="form-control" id="inputEmail3" required placeholder="{{trans('items.item_name')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="specifications" class="col-sm-1 control-label">{{trans('items.specifications')}}</label>
                        <div class="col-sm-10">
                            <textarea name="specifications" class="form-control" required placeholder="{{trans('items.specifications')}}" ></textarea>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="image" class="col-sm-1 control-label">{{trans('items.image')}}</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" required  id="image">
                        </div>
                    </div>
                    <hr/>

                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="box-body">
                                        <div class="form-group">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>المواصفة</th>
                                                    <th>مواصفة 2</th>
                                                    <th>سعر البيع</th>

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
                                                    <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> اضافة مواصفات</button>
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

    <!-- Modal -->



    <script>
        var zxc = 1;
        $(function () {

            $("#Badd").click(function () {


                if ($(".color").val() != 20){
                $("#maindiv").append(
                    // Add new row

                    ' <tr id="remove'+zxc+' ">' +
                    '            <td>' +
                    '                <select id="list1" required class="form-control select2 color items" data-live-search="true" name="color_id['+zxc+']" data-count="'+zxc+'" required>' +
                    '                    <option  class="form-control" value="" >-----اختيار مواصفة الماده ----</option>' +
                    '                    @foreach ($itemscolors as $itemcolor )' +
                    '                       <option style="color:red" value="{!! $itemcolor->id !!}">{!! $itemcolor->name !!}</option>'+
                    '                    @endforeach' +
                    '                </select>' +
                    '            </td>' +
                    '            <td>' +
                    '  <select id="list" name="size_id['+zxc+'][]" required class="form-control select2 size" multiple="multiple" data-live-search="true">'+
                    '                      @foreach($itemsizes as $itemsize)'+
                    '  <option style="color:red" value="{!! $itemsize->id !!}">{!! $itemsize->name !!}</option>'+
                    '                    @endforeach' +
                    '            </td>' +
                    '            <td>' +
                    '                    <input type="number" required name="selling_price['+zxc+']" class="form-control" id="inputEmail3" placeholder="{{trans('specific.selling_price')}}">' +
                    '            </td>' +
                    '            <td>' +
                    '                <input type="button" id="remove" class="btn btn-danger " value="X" />' +
                    '            </td>' +
                    ' </tr>'+

                    ''
                );
                $('.select2').select2();
                zxc++;
                }
            });

            //remove selected Row
            $("#maindiv").on("click", "#remove", function () {
                $(this).closest("tr").remove().attr('name', 'quantity_b['+$(this).val()+']');

            });

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



@include('admin.bills.script')
@endsection
