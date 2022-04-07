@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="POST" action="{{route('users.store')}}" accept-charset="UTF-8">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">{{trans('admin.name')}}</label>
                    <input class="form-control" name="name" type="text" id="name">
                </div>
                <div class="form-group">
                    <label for="email">{{trans('admin.email')}}</label>
                    <input class="form-control" name="email" type="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">{{trans('admin.password')}}</label>
                    <input class="form-control" name="password" type="password" value="" id="password">
                </div>

                <div class="form-group">


                    <label for="level">{{trans('admin.level')}}</label>
                    <select class="form-control" id="level" name="level">
                        <option selected="selected" value="">.............</option>
                        <option value="user">{{trans('admin.user')}}</option>
                        <option value="vendor">{{trans('admin.vendor')}}</option>
                        <option value="company">{{trans('admin.company')}}</option>
                    </select>
                </div>
                <input class="btn btn-primary" type="submit" value="{{trans('admin.add')}}">
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection