@extends('admin.index')
@section('page_title')
    {{trans('cats.add')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('cats.add')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('cats.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">{{trans('cats.cats_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" required name="name" class="form-control" id="inputEmail3" placeholder="{{trans('cats.cats_name')}}">
                        </div>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="specifications" class="col-sm-1 control-label">{{trans('cats.specifications')}}</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <textarea name="details" class="form-control" placeholder="{{trans('cats.specifications')}}" ></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group">
                            <input type="hidden" name="quantity" readonly  class="form-control" id="quantity" placeholder="{{trans('cats.quantity')}}">
                            <input type="hidden" name="price"    readonly  class="form-control" id="price" placeholder="{{trans('cats.price')}}">
                            <input type="hidden" name="newprice" readonly  class="form-control" id="price" placeholder="{{trans('cats.price')}}">
                    </div>
                    <div class="form-group">

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