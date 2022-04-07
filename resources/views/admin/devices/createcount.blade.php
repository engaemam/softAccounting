@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">مخزن</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action=""  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">{{trans('devices.devices_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="devices_name" class="form-control" id="inputEmail3" placeholder="{{trans('devices.devices_name')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="specifications" class="col-sm-1 control-label">{{trans('devices.specifications')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="specifications" class="form-control" id="specifications" placeholder="{{trans('devices.specifications')}}">
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <button class="btn default" type="reset">{{trans('devices.reset')}}</button>
                    <button type="submit" class="btn btn-primary pull-right">{{trans('devices.create')}}</button>
                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection