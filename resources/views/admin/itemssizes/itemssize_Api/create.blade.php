@extends('admin.index')
@section('page_title')
     مواصفة 2  (سوق النوارس)
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">اضافة مواصفة 2</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.Item_size_api.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">اسم المواصفة بالعربيه</label>
                        <div class="col-sm-10">
                            <input type="text" required name="name_ar" value="{{old('name_ar')}}" class="form-control" id="inputEmail3" placeholder="اسم المواصفة بالعربيه ">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">اسم المواصفة بالانجليزيه</label>
                        <div class="col-sm-10">
                            <input type="text" required name="name_en"  value="{{old('name_en')}}" class="form-control" id="inputEmail3" placeholder="اسم المواصفة بالانجليزيه">
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