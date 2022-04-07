@extends('admin.index')
@section('page_title')
    {{trans('deviceitems.edit')}}
@endsection
@section('content')
    <script src="{{url('/')}}/js/jquery.js"></script>
    <script src="{{url('/')}}/js/jquery.min.js"></script>



    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/deviceitems/')}}/{{$deviceitems->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('deviceitems.devices_id')}}</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="devices_id" required data-live-search="true">
                                <option class="form-control" disabled>-----اختيار اسم الجهاز ----</option>
                                @foreach ($devices as $device )
                                    <option value="{{$device->id}}" @if($deviceitems->devices_id == $device->id) selected @endif>{{ $device->devices_name }} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <?php
                    $item_id=explode(',',$deviceitems->item_id);
                    $number_items=explode(',',$deviceitems->number_items);
                    ?>
                    <div class="form-group input_fields_wrap">

                        @foreach ($item_id as $key => $value )
                            <div class="form-group itemzs">
                                <label class="col-sm-1 control-label" for="name">اختيار اسم الماده</label>
                                <div class="col-sm-4">
                                    <select id="item_id" class="form-control select2 "  required name="item_id[]">
                                        <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>
                                        @foreach ($items as $item )
                                            @if($item->id == $value)
                                                <option value="{{$item->id}}" selected >{{ $item->item_name }} </option>
                                            @else
                                                <option value="{{$item->id}}">{{ $item->item_name }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <label for="number_items"  class="col-sm-1 control-label">كمية</label>
                                <div class="col-sm-2">
                                    @foreach($number_items as $key1 => $value1)
                                        @if($key == $key1)
                                            <input type="number" required name="number_items[]"  value="{{ $value1 }}"class="form-control" id="number_items" placeholder="كمية">
                                        @endif
                                    @endforeach
                                </div>
                        @endforeach
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



@endsection