@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('addtaxs.create')}}</h3>
            {{--<a href="#" class="btn btn-danger"><i class="fa fa-warning"> </i> عملة الفاتورة : {{@$bill->currency->currency_name}}</a>--}}

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('addtaxs.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('addtaxs.bill_id')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control " required  data-live-search="true" name="bill_id" title="{{trans('addtaxs.bill_id')}} ">
                                @foreach ($bills as $bill )
                                    <option value="{{$bill->id}}" @if(@$billId == $bill->id) selected @endif @if(@$billId != $bill->id) DISABLED @endif>{{ $bill->bill_number }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>





                    <div id="maindiv">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="name">{{trans('addtaxs.addtaxnames_id')}}</label>
                                <div class="col-sm-5">
                                    <select class="form-control" required data-live-search="true" name="addtaxnames_id[]" title="اختيار اسم الشحن">

                                        @foreach ($addtaxnames as $shipping )
                                            <option value="{{$shipping->id}}">{{ $shipping->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="price" class="col-sm-1 control-label">{{trans('addtaxs.price')}}</label>
                                <div class="col-sm-3">
                                    <input type="text" name="price[]" required class="form-control" id="price" placeholder="{{trans('addtaxs.price')}}">
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
                    '<label class="col-sm-1 control-label" for="name">{{trans('addtaxs.shipping')}}</label>'+
                    '<div class="col-sm-5">'+
                    '<select class="form-control " required data-live-search="true" name="addtaxnames_id[]" title="اختيار اسم الشحن">'+
                    '<option value="">اختيار اسم </option>'+
                    '@foreach ($addtaxnames as $shipping )'+
                    '<option value="{{$shipping->id}}">{{ $shipping->name }} </option>'+
                    ' @endforeach'+
                    ' </select>'+
                    '</div>'+
                    '<label for="price" class="col-sm-1 control-label">{{trans('addtaxs.price')}}</label>'+
                    '<div class="col-sm-3">'+
                    '<input type="text" name="price[]" required class="form-control" id="price" placeholder="{{trans('addtaxs.price')}}">'+
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