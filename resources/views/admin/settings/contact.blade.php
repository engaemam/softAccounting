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
            <h3 class="box-title">{{trans('contact.contacts')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="POST" action="{{aurl('settings/contact')}}" accept-charset="UTF-8" enctype="multipart/form-data">

                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('contact.address_ar')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('contact.address_ar')}}" value="{{contact()->address_ar}}" name="address_ar" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('contact.address_en')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('contact.address_en')}}" value="{{contact()->address_en}}" name="address_en" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('contact.phone')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('contact.phone')}}" value="{{contact()->phone}}" name="phone" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('contact.fax')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('contact.fax')}}"value="{{contact()->fax}}" name="fax" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('contact.mobile')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('contact.mobile')}}"value="{{contact()->mobile}}" name="mobile" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{trans('contact.email')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="{{trans('contact.email')}}"value="{{contact()->email}}" name="email" type="text" id="name"required>
                    </div>
                </div>
                <br> <br> <br><br>
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