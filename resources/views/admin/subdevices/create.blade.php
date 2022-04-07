@extends('admin.index')
@section('page_title')
    {{trans('subdevices.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('subdevices.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('subdevices.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('subdevices.device_id')}}</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" required name="device_id">
                                <option class="form-control" value="">-----اختيار اسم الجهاز ----</option>
                                @foreach ($devices as $device )
                                    <option value="{{$device->id}}" @if(@$deviceId == $device->id) selected @endif>{{ $device->devices_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-1 control-label" for="name">الجهاز الفرعي</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" required name="subdevice_id">
                                <option class="form-control" value="">-----اختيار اسم الجهاز ----</option>
                                @foreach ($devices as $device )
                                    <option value="{{$device->id}}">{{ $device->devices_name }} </option>
                                @endforeach
                            </select>
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
                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection