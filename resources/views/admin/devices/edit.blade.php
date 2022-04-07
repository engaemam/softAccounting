@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/devices/')}}/{{$devices->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">{{trans('devices.devices_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="devices_name" required class="form-control"value="{{$devices->devices_name}}"  id="" placeholder="{{trans('devices.devices_name')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="specifications" class="col-sm-1 control-label">{{trans('devices.specifications')}}</label>
                        <div class="col-sm-10">
                            <textarea name="specifications" class="form-control" id="specifications" placeholder="{{trans('devices.specifications')}}">{{$devices->specifications}}</textarea>
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