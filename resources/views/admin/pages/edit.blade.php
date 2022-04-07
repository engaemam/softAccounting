@extends('admin.index')
@section('content')
    <style>
        .control-label{
            font-size:16px;!important;
            margin: 9px 0 0 0;

        }
        .form-control{
            height:45px;!important;
        }
    </style>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('pages.pages')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="POST" action="{{url('admin/pages/')}}/{{$pages->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('pages.name_ar')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('pages.name_ar')}}" value="{{$pages->title_ar}}" name="title_ar" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('pages.name_en')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('pages.name_en')}}" value="{{$pages->title_en}}" name="title_en" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('pages.description_ar')}}</label>
                    <div class="col-sm-9">
                        <textarea  class="form-control editor1" placeholder="{{trans('pages.description_ar')}}"  name="description_ar" required>{{$pages->description_ar}}</textarea>
                    </div>
                </div>
                <br> <br> <br> <br> <br> <br><br> <br> <br><br> <br> <br><br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('pages.description_en')}}</label>
                    <div class="col-sm-9">
                        <textarea  class="form-control editor1" placeholder="{{trans('pages.description_en')}}"  name="description_en" required>{{$pages->description_en}}</textarea>
                    </div>
                </div>
                <br> <br> <br><br> <br> <br><br> <br> <br><br> <br> <br><br> <br> <br>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('pages.mate_title_ar')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('pages.mate_title_ar')}}"value="{{$pages->mate_title_ar}}" name="mate_title_ar" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('pages.mate_title_en')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('pages.mate_title_en')}}"value="{{$pages->mate_title_en}}" name="mate_title_en" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('pages.mate_description_ar')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('pages.mate_description_ar')}}"value="{{$pages->mate_description_ar}}" name="mate_description_ar" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('pages.mate_description_en')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('pages.mate_description_en')}}"value="{{$pages->mate_description_en}}" name="mate_description_en" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br><br>
                <div class="col-md-offset-3 col-md-4">
                    <input class="btn btn-primary" type="submit" value="{{trans('pages.add')}}">
                    <button class="btn default" type="reset">{{trans('pages.reset')}}</button>
                </div>  <br> <br>

            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection