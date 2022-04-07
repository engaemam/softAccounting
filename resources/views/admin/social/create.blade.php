@extends('admin.index')
@section('page_title')
    {{trans('social.add')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('social.add')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('social.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">{{trans('social.social_cates')}}</label>
                        <div class="col-sm-10">
                            <input type="text" required name="link" class="form-control" id="inputEmail3" placeholder="{{trans('social.social_cates')}}" value="{{old('links')}}">
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">{{trans('social.social_name')}}</label>
                        <div class="col-sm-10">
                        <select name="name" class="form-control select2" required>
                                <option value="">   -----   اختيار     ----- </option>
                               
                                    <option value="facebook">فيسبوك</option>
                                    <option value="instagram">إنستجرام</option>
                            
                            </select>
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