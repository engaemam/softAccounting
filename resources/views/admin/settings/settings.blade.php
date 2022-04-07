@extends('admin.index')
@section('content')
    <style>

    </style>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{aurl('settings')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="sitename_ar">{{trans('admin.sitename_ar')}}</label>
                    <div class="col-sm-9">
                    <input class="form-control" name="sitename_ar" type="text" value="{{setting()->sitename_ar}}" id="sitename_ar">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="sitename_en">{{trans('admin.sitename_en')}}</label>
                    <div class="col-sm-9">
                    <input class="form-control" name="sitename_en" type="text" value="{{setting()->sitename_en}}" id="sitename_en">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="email">{{trans('admin.email')}}</label>
                    <div class="col-sm-9">
                    <input class="form-control" name="email" type="email" value="{{setting()->email}}" id="email">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="logo">{{trans('admin.logo')}}</label>
                    <div class="col-sm-9">
                    <input name="logo" type="file" id="logo">
                    </div>
                </div>


                @if(!empty(setting()->logo))
                    <div class="form-group">
                        <div class="col-sm-9 ">
                    <div class="thumbnail" style="width: 150px; height: 100px">
                        <img class="fileinput-filename" src="{{setting()->logo}} " style="height: 90px"alt=""  />
                    </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="icon">{{trans('admin.icon')}}</label>
                    <div class="col-sm-9 ">
                    <input name="icon" type="file" id="icon">
                    </div>
                </div>
                @if(!empty(setting()->icon))
                    <div class="form-group">
                        <div class="col-sm-9 ">
                    <div class="thumbnail" style="width: 150px; height: 100px">
                        <img src="{{setting()->icon}}" style="height: 90px"/>
                    </div>
                        </div>
                    </div>
                @endif
                <!-- -->
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="logo">{{trans('admin.slider1')}}</label>
                    <div class="col-sm-9">
                        <input name="slider1" type="file" id="logo">
                    </div>
                </div>

                @if(!empty(setting()->slider1))
                    <div class="form-group">
                        <div class="col-sm-9 ">
                            <div class="thumbnail" style="width: 150px; height: 100px">
                                <img class="fileinput-filename" src="{{setting()->slider1}} " style="height: 90px"alt=""  />
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="icon">{{trans('admin.slider2')}}</label>
                    <div class="col-sm-9 ">
                        <input name="slider2" type="file" id="icon">
                    </div>
                </div>

                @if(!empty(setting()->slider2))
                    <div class="form-group">
                        <div class="col-sm-9 ">
                            <div class="thumbnail" style="width: 150px; height: 100px">
                                <img src="{{setting()->slider2}}" style="height: 90px"/>
                            </div>
                        </div>
                    </div>
            @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="description">{{trans('admin.description')}}</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" name="description" id="description">{{setting()->description}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="keywords">{{trans('admin.keywords')}}</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" name="keywords"  id="keywords">{{setting()->keywords}}</textarea>
                    </div>
                </div>

                <input class="btn btn-primary" type="submit" value="{{trans('admin.save')}}">

            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection