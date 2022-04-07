@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['url'=>aurl('admin/'.$admin->id),'method'=>'put' , 'class'=>"form-horizontal" ]) !!}
            <div class="form-group">
                <label class="col-sm-1 control-label" for="name">{{trans('admin.name')}}</label>
                <div class="col-sm-5">
                    <input class="form-control" name="name" type="text" id="name" value="{{$admin->name}}" placeholder="{{trans('admin.name')}}" required>
                </div>
                <label class="col-sm-1 control-label" for="email">{{trans('admin.email')}}</label>
                <div class="col-sm-5">
                    <input class="form-control" name="email" type="email" id="email" value="{{$admin->email}}" placeholder="{{trans('admin.email')}}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-1 control-label" for="password">{{trans('admin.password')}}</label>
                <div class="col-sm-5">
                    <input class="form-control" name="password" type="password"   id="password" placeholder="{{trans('admin.password')}}" >
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-1 control-label" for="name">{{trans('اختار صلاحية المستخدم')}}</label>
                <div class="col-sm-11">
                    <select class="form-control " required   name="role_id"  >
                        @foreach ($roles as $role )
                            <option value="{{$role->id}}" @if($admin->role_id == $role->id) selected @endif>{{ $role->name }} </option>
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
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection