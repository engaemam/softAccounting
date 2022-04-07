@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('shipments.create')}}</h3>
            {{--<a href="#" class="btn btn-danger"><i class="fa fa-warning"> </i> عملة الفاتورة : {{$bill->currency->currency_name}}</a>--}}

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('shipments.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('shipments.bill_id')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control " required  data-live-search="true" name="bill_id" title="{{trans('shipments.bill_id')}} ">
                                @foreach ($bills as $bill )
                                    <option value="{{$bill->id}}" @if(@$billId == $bill->id) selected @endif @if(@$billId != $bill->id) DISABLED @endif>{{ $bill->bill_number }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>





                    <div id="maindiv">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="name">{{trans('shipments.shipping')}}</label>
                                <div class="col-sm-5">
                                    <select class="form-control" required data-live-search="true" name="shipping_id[]" title="اختيار اسم الشحن">

                                        @foreach ($shippings as $shipping )
                                            <option value="{{$shipping->id}}">{{ $shipping->type_expense }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="value" class="col-sm-1 control-label">{{trans('shipments.value')}}</label>
                                <div class="col-sm-3">
                                    <input type="text" name="value[]" required class="form-control" id="value" placeholder="{{trans('shipments.value')}}">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button class="btn btn-success add_field_button_mo" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> اضافة</button>
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


    <script src="{{url('/')}}/asst/bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        $(function () {

            // add new row in Main Dive
            $("#Badd").click(function () {

                $("#maindiv").append(
                    // Add new row
                        '<div class="row">'+
                    '<div class="form-group">'+
                    '<label class="col-sm-1 control-label" for="name">{{trans('shipments.shipping')}}</label>'+
                    '<div class="col-sm-5">'+
                    '<select class="form-control " required data-live-search="true" name="shipping_id[]" title="اختيار اسم الشحن">'+
                    '<option value="">اختيار اسم الشحن</option>'+
                    '@foreach ($shippings as $shipping )'+
                    '<option value="{{$shipping->id}}">{{ $shipping->type_expense }} </option>'+
                    ' @endforeach'+
                    ' </select>'+
                    '</div>'+
                    '<label for="value" class="col-sm-1 control-label">{{trans('shipments.value')}}</label>'+
                    '<div class="col-sm-3">'+
                    '<input type="text" name="value[]" required class="form-control" id="value" placeholder="{{trans('shipments.value')}}">'+
                            '</div>'+
                        '<input type="button" class="btn btn-danger" value="X" /> </div>'+
                    ' </div>'+
                        ''
                )

            });

            //remove selected Row
            $("#maindiv").on("click", ".btn", function () {
                $(this).parent().remove();
                sum(); //re calc
            });
        });




    </script>

@endsection