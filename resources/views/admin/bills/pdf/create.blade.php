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
            <h3 class="box-title">Create New PDF : {{$bills->bill_number}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/bills/stoneGetPdf')}}/{{$bills->id}}"  enctype="multipart/form-data">

                {!! csrf_field() !!}
                <div class="box-body">

                    <input type="hidden" name="id_bills" value="{{$bills->id}}">
                    <label  class="col-sm-1 control-label">تحميل</label>
                    <div class="col-sm-4">
                        <input type="file" name="pdf[]" required  class="form-control" >
                    </div>
                </div>
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