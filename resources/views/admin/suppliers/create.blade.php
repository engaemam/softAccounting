@extends('admin.index')
@section('page_title')
    {{trans('suppliers.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('suppliers.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('suppliers.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">
                        <label for="suppliers_name" class="col-sm-1 control-label">{{trans('suppliers.suppliers_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="suppliers_name" class="form-control" id="suppliers_name" placeholder="{{trans('suppliers.suppliers_name')}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="manager_name" class="col-sm-1 control-label">{{trans('suppliers.manager_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="manager_name" class="form-control" id="manager_name" placeholder="{{trans('suppliers.manager_name')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="position_manger" class="col-sm-1 control-label">{{trans('suppliers.position_manger')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="position_manger" class="form-control" id="position_manger" placeholder="{{trans('suppliers.position_manger')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="suppliers_number" class="col-sm-1 control-label">{{trans('suppliers.suppliers_number')}}</label>
                        <div class="col-sm-5">
                            <input type="number" name="suppliers_number" class="form-control" id="suppliers_number" placeholder="{{trans('suppliers.suppliers_number')}}">
                        </div>
                        <label for="mobile" class="col-sm-1 control-label">{{trans('suppliers.mobile')}}</label>
                        <div class="col-sm-4">
                            <input type="number" name="mobile" required class="form-control" id="mobile" placeholder="{{trans('suppliers.mobile')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="col-sm-1 control-label">{{trans('suppliers.country')}}</label>
                        <div class="col-sm-5">
                            <input type="text" name="country" class="form-control" id="country" placeholder="{{trans('suppliers.country')}}" required>
                        </div>
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