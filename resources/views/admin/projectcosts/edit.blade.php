@extends('admin.index')
@section('page_title')
    {{ $title }}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
            {{--<a href="#" class="btn btn-danger"><i class="fa fa-warning"> </i> عملة المشروع : {{$project->currency->currency_name}}</a>--}}

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/projectcosts/')}}/{{$projectcosts->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('projectitems.project_id')}}</label>
                        <div class="col-sm-4">
                            <input type="hidden" disabled name="project_id" value="{{ $projectcosts->project_id}}">
                            <input type="text" disabled  class="form-control"  value="{{ $projectcosts->projects->project_number}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('اسم البند')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="expenses_id" required>
                                <option class="form-control" >-----اختيار اسم البند ----</option>
                                @foreach ($expensesitems as $expensesitem )
                                    <option value="{{$expensesitem->id}}" @if($projectcosts->expenses_id == $expensesitem->id) selected @endif >{{ $expensesitem->items }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="value" class="col-sm-1 control-label">{{trans('projectcosts.value')}}</label>
                        <div class="col-sm-3">
                            <input type="number" required name="value" value="{{$projectcosts->value}}" class="form-control" id="value" placeholder="{{trans('projectcosts.value')}}">
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