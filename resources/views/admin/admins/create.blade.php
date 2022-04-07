@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.create_user')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form  class="form-horizontal" method="POST" action="{{route('admin.store')}}" accept-charset="UTF-8">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="name">{{trans('admin.name')}}</label>
                    <div class="col-sm-5">
                    <input class="form-control" name="name" type="text" id="name" placeholder="{{trans('admin.name')}}" required>
                    </div>
                    <label class="col-sm-1 control-label" for="email">{{trans('admin.email')}}</label>
                    <div class="col-sm-5">
                        <input class="form-control" name="email" type="email" id="email" placeholder="{{trans('admin.email')}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-1 control-label" for="password">{{trans('admin.password')}}</label>
                    <div class="col-sm-5">
                    <input class="form-control" name="password" type="password"  id="password" placeholder="{{trans('admin.password')}}" required>
                    </div>
                    <label class="col-sm-1 control-label" for="password"> {{trans('admin.password_confirmation')}}</label>
                    <div class="col-sm-5">
                        <input class="form-control" name="password_confirmation" type="password" placeholder="{{trans('admin.password_confirmation')}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-1 control-label" for="name">{{trans('اختار صلاحية المستخدم')}}</label>
                    <div class="col-sm-5">
                        <select class="form-control " required   name="role_id"  >
                            @foreach ($roles as $role )
                                <option value="{{$role->id}}">{{ $role->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>



        <!-- /.box-body -->
        <div class="box-footer ">
            <div class="col-sm-1">
                <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
            </div>
            <div class="col-sm-2">
                <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
            </div>
        </div>
        </form>
        <!-- /.box-footer -->
    </div>
    <!-- /.box -->



@endsection