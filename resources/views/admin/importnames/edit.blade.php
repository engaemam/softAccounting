@extends('admin.index')
@section('page_title')
    {{trans('importnames.edit')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('importnames.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.importnames.update')}}"  enctype="multipart/form-data">
               <input type="hidden" name="id" value="{{$importname->id}}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="type_expense" class="col-sm-1 control-label">{{trans('shipping.type_expense')}}</label>

                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{$importname->name}}" class="form-control" id="type_expense" placeholder="{{trans('shipping.type_expense')}}">
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