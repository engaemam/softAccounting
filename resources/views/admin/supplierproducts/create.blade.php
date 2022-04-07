@extends('admin.index')
@section('page_title')
    {{trans('supplierproducts.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('supplierproducts.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('supplierproducts.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{trans('itemserials.supplier_id')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" required  data-live-search="true" name="supplier_id" >
                                <option class="form-control" value="" >  -----اختيار اسم المورد ----  </option>
                                @foreach ($suppliers as $supplier )
                                    <option value="{{$supplier->id}}" @if(@$supplier_id == $supplier->id) selected @endif >{{ $supplier->suppliers_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{trans('supplierproducts.item_id')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" required  data-live-search="true" style="width: 100%;" tabindex="-1" aria-hidden="true" name="item_id[]">
                                <option class="form-control" value="">-----اختيار اسم المادة ---- </option>
                                @foreach ($items as $item )
                                    <option value="{{$item->id}}">{{ $item->item_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="last_price" class="col-sm-2 control-label">{{trans('supplierproducts.last_price')}}</label>
                        <div class="col-sm-2">
                            <input type="text" name="last_price[]" required class="form-control"  placeholder="{{trans('supplierproducts.last_price')}}">
                        </div>
                    </div>


                        <div id="devices"></div>


                    <div class="form-group">
                        <div class="col-sm-10">
                            <button class="btn btn-success" id="add_devices" type="button"> اضافة مادة <i class="glyphicon glyphicon-plus"></i></button>
                        </div>
                    </div>



                </div>
                <!-- /.box-body -->
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
                    '<label class="col-sm-2 control-label" for="name">{{trans('supplierproducts.item_id')}}</label>'+
                    '<div class="col-sm-4">'+
                    '<select required class="form-control select2"  name="item_id[]">'+
                    '<option  value="">-----اختيار اسم المادة ---- </option>'+
                    ' @foreach ($items as $item )'+
                    '<option  value="{{$item->id}}">{{ $item->item_name }} </option>'+
                    '@endforeach'+
                    '</select>'+
                    '</div>'+
                    '<label for="last_price" class="col-sm-2 control-label">{{trans('supplierproducts.last_price')}}</label>'+
                    '<div class="col-sm-2">'+
                    '<input type="text" name="last_price[]" required class="form-control"  id="last_price" placeholder="{{trans('supplierproducts.last_price')}}">'+
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