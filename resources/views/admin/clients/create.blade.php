@extends('admin.index')
@section('page_title')
    {{trans('clients.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('clients.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('clients.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name_client" class="col-sm-1 control-label">{{trans('clients.name_client')}}</label>
                        <div class="col-sm-4">
                            <input type="text" name="name_client" class="form-control" id="name_client" placeholder="{{trans('clients.name_client')}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="phone" class="col-sm-1 control-label">{{trans('clients.phone')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="{{trans('clients.phone')}}">
                        </div>
                    </div>

                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('clients.notes')}}</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" name="notes" placeholder="{{trans('clients.notes')}}"></textarea>
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