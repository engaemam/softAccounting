@extends('admin.index')
@section('content')
    <style>

        .btn.red:not(.btn-outline) {
            color: #fff;
            background-color: #e7505a;
            border-color: #e7505a;
        }
        .btn.default:not(.btn-outline) {
            color: #666;
            background-color: #e1e5ec;
            border-color: #e1e5ec;
        }
    </style>
    <script type="text/javascript">

        $("a[data-dismiss='fileinput']").on("click",function(){
            $("input[name='rmv_image']").attr("value","true");
            $("input[name='image']").attr("value","");
        });

    </script>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }} - {{$cities->name}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/cities/')}}/{{$cities->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">سعر الشحن</label>
                        <div class="col-sm-10">
                            <input type="text" name="shipping" class="form-control" value="{{$cities->shipping}}"  id="" placeholder="سعر الشحن">
                        </div>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="specifications" class="col-sm-1 control-label">{{trans('cities.specifications')}}</label>--}}
{{--                        <div class="col-sm-10">--}}

{{--                            <textarea name="details" class="form-control" placeholder="{{trans('cities.specifications')}}"> {{$cities->details}}</textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}

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