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
            <h3 class="box-title">{{trans('footer.footer')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="POST" action="{{aurl('settings/footer')}}" accept-charset="UTF-8" enctype="multipart/form-data">

                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('footer.footer_facebook')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('footer.footer_facebook')}}" value="{{footer()->footer_facebook}}" name="footer_facebook" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('footer.footer_instagram')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('footer.footer_instagram')}}" value="{{footer()->footer_instagram}}" name="footer_instagram" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('footer.footer_youtube')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('footer.footer_youtube')}}" value="{{footer()->footer_youtube}}" name="footer_youtube" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('footer.footer_link')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('footer.footer_link')}}" value="{{footer()->footer_link}}" name="footer_link" type="text" id="name"required>
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