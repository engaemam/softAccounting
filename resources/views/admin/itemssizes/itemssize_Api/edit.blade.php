@extends('admin.index')
@section('page_title')
    مواصفة 2  (سوق النوارس)
@endsection
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
            <h3 class="box-title">تعديل  مواصفة 2  (سوق النوارس)
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/Item_size_api/')}}/{{$colors->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">اسم المواصفة بالعربيه</label>
                        <div class="col-sm-10">
                            <input type="text" required name="name_ar" value="{{$colors->name_ar}}" class="form-control" id="inputEmail3" placeholder="اسم المواصفة بالعربيه ">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">اسم المواصفة بالانجليزيه</label>
                        <div class="col-sm-10">
                            <input type="text" required name="name_en"  value="{{$colors->name_en}}" class="form-control" id="inputEmail3" placeholder="اسم المواصفة بالانجليزيه">
                        </div>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>

                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection