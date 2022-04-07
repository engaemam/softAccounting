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
            <h3 class="box-title">{{trans('target.title')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="POST" action="{{aurl('settings/target')}}" accept-charset="UTF-8" enctype="multipart/form-data">

                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar1')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar1')}}" value="{{target()->title_ar1}}" name="title_ar1" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar2')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar2')}}" value="{{target()->title_ar2}}" name="title_ar2" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar3')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar3')}}" value="{{target()->title_ar3}}" name="title_ar3" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar4')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar4')}}" value="{{target()->title_ar4}}" name="title_ar4" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar5')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar5')}}" value="{{target()->title_ar5}}" name="title_ar5" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar6')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar6')}}" value="{{target()->title_ar6}}" name="title_ar6" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar7')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar7')}}" value="{{target()->title_ar7}}" name="title_ar7" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar8')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar8')}}" value="{{target()->title_ar8}}" name="title_ar8" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar9')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_a9r')}}" value="{{target()->title_ar9}}" name="title_ar9" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_ar10')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_ar10')}}" value="{{target()->title_ar10}}" name="title_ar10" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en1')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en1')}}" value="{{target()->title_en1}}" name="title_en1" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en2')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en2')}}" value="{{target()->title_en2}}" name="title_en2" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en3')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en3')}}" value="{{target()->title_en3}}" name="title_en3" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en4')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en4')}}" value="{{target()->title_en4}}" name="title_en4" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en5')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en5')}}" value="{{target()->title_en5}}" name="title_en5" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en6')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en6')}}" value="{{target()->title_en6}}" name="title_en6" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en7')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en7')}}" value="{{target()->title_en7}}" name="title_en7" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en8')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en8')}}" value="{{target()->title_en8}}" name="title_en8" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en9')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en9')}}" value="{{target()->title_en9}}" name="title_en9" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('target.title_en10')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('target.title_en10')}}" value="{{target()->title_en10}}" name="title_en10" type="text" id="name">
                    </div>
                </div>
                <br> <br> <br>



                <div class="col-md-offset-3 col-md-4">
                    <input class="btn btn-primary" type="submit" value="{{trans('contact.add')}}">
                    <button class="btn default" type="reset">{{trans('contact.reset')}}</button>
                </div>  <br> <br>

            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection