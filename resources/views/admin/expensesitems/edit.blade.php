@extends('admin.index')
@section('page_title')
    {{trans('expensesitems.edit')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/expensesitems/')}}/{{$expensesitems->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">
                        <label for="value" class="col-sm-1 control-label">{{trans('expensesitems.items')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="items" value="{{$expensesitems->items}}" class="form-control" id="value" placeholder="{{trans('expensesitems.items')}}">
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