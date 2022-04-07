@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/currencies/')}}/{{$currencies->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="currency_name" class="col-sm-1 control-label">{{trans('currencies.currency_name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{$currencies->currency_name}}" name="currency_name" class="form-control" id="currency_name" placeholder="{{trans('currencies.currency_name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date" class="col-sm-1 control-label">{{trans('currencies.currency_ammount')}}</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{$currencies->currency_ammount}}" name="currency_ammount" class="form-control" id="date" placeholder="{{trans('currencies.currency_ammount')}}">
                    </div>
                </div>

                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <button class="btn default" type="reset">{{trans('currencies.reset')}}</button>
                    <button type="submit" class="btn btn-primary pull-right">{{trans('currencies.edit')}}</button>
                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection