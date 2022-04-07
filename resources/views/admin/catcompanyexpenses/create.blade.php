@extends('admin.index')
@section('page_title')
    {{trans('catcompanyexpenses.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('catcompanyexpenses.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal"  method="POST" action="{{route('admin.catcompanyexpenses.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-1 control-label">{{trans('catcompanyexpenses.title')}}</label>
                        <div class="col-sm-6">
                            <input type="text" required name="title" class="form-control"  placeholder="{{trans('catcompanyexpenses.title')}}">
                        </div>



                    </div>
                    <div class="form-group">


                    </div>







                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-2">
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