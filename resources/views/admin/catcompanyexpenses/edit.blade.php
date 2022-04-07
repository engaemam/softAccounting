@extends('admin.index')
@section('page_title')
    {{trans('catcompanyexpenses.edit')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('catcompanyexpenses.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/catcompanyexpenses/')}}/{{$expenses->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-1 control-label">{{trans('catcompanyexpenses.title')}}</label>
                        <div class="col-sm-6">
                            <input type="text" required name="title" value="{{$expenses->title}}" class="form-control"  placeholder="{{trans('companyexpenses.title')}}">
                        </div>



                    </div>

                </div>
                <div class="box-footer ">
                    <button class="btn default" type="reset">{{trans('admin.reset')}}</button>

                    <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->




@endsection