@extends('admin.index')
@section('page_title')
    {{trans('sizes.add')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">اضافة مواصفة </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('itemssizes.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">اسم المواصفة</label>
                        <div class="col-sm-10">
                            <input type="text" required name="name" class="form-control" id="inputEmail3" placeholder="اسم المواصفة">
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