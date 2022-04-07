@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/subdevices/')}}/{{$subdevices->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('subdevices.device_id')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="device_id" required>
                                <option class="form-control" value="">-----اختيار اسم الجهاز ----</option>
                                @foreach ($devices as $device )
                                    <option value="{{$device->id}}"@if($subdevices->device_id == $device->id) selected @endif>{{ $device->devices_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">الجهاز الفرعي</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="subdevice_id" required>
                                <option class="form-control" value="">-----اختيار اسم الجهاز ----</option>
                                @foreach ($devices as $device )
                                    <option value="{{$device->id}}"@if($subdevices->subdevice_id == $device->id) selected @endif>{{ $device->devices_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <button class="btn default" type="reset">{{trans('devices.reset')}}</button>
                    <button type="submit" class="btn btn-primary pull-right">{{trans('devices.edit')}}</button>
                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection