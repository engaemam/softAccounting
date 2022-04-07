@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
            {{--<a href="#" class="btn btn-danger"><i class="fa fa-warning"> </i> عملة الفاتورة : {{$bill->currency->currency_name}}</a>--}}

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/addtaxs/')}}/{{$addtaxs->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('addtaxs.bill_id')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control"   name="bill_id" >

                                @foreach ($bills as $bill )
                                    <option value="{{$bill->id}}" @if($addtaxs->bill_id == $bill->id) selected @endif @if($addtaxs->bill_id  != $bill->id) disabled @endif>{{ $bill->bill_number }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <?php
                    $shipping_id=explode(',',$addtaxs->addtaxnames_id);
                    $values=explode(',',$addtaxs->price);
                    ?>
                    <div id="maindiv">
                        <div class="row">
                            @foreach ($shipping_id as $key => $value )
                                <div class="form-group">
                                    <label class="col-sm-1 control-label" for="name">{{trans('addtaxs.addtaxnames_id')}}</label>
                                    <div class="col-sm-5">
                                        <select class="form-control " data-live-search="true" name="addtaxnames_id[]" title="اختيار اسم الشحن">
                                            @foreach ($shippings as $shipping )
                                                @if($shipping->id == $value)
                                                    <option value="{{$shipping->id}}" selected >{{ $shipping->name }} </option>
                                                @else
                                                    <option value="{{$shipping->id}}">{{ $shipping->name }} </option>
                                                @endif
                                                @endforeach
                                        </select>
                                    </div>
                                    <label for="price" class="col-sm-1 control-label">{{trans('addtaxs.price')}}</label>
                                    <div class="col-sm-3">
                                        @foreach($values as $key1 => $value1)
                                            @if($key == $key1)
                                        <input type="text" value="{{$value1}}" name="price[]" class="form-control" id="price" placeholder="{{trans('addtaxs.price')}}">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
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



@endsection