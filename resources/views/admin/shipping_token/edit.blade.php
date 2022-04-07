@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">ربط الشحن</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.Shipping_account.update')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">البريد الالكتروني</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" value="{{@$token->user_name    }}"  id="" placeholder="البريد الالكتروني">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">كلمه السر</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control"   id="" placeholder="كلمه السر">
                        </div>
                    </div>


                    <div class="form-group">

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