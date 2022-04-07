@extends('admin.index')
@section('page_title')
    {{trans('projectcosts.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('projectcosts.create')}}</h3>
            {{--<a href="#" class="btn btn-danger"><i class="fa fa-warning"> </i> عملة المشروع : {{@$project->currency->currency_name}}</a>--}}

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('projectcosts.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('projectitems.project_id')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="project_id" required readonly="">
                                <option class="form-control" value="" disabled>-----اختيار رقم المشروع ----</option>
                                @foreach ($projects as $project )
                                    <option value="{{$project->id}}" @if(@$projectId == $project->id) selected @endif @if(@$projectId != $project->id) disabled="disabled" @endif>{{ $project->project_number }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('اسم البند')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="expenses_id" required>
                                <option class="form-control" value="">-----اختيار اسم البند ----</option>
                                @foreach ($expensesitems as $expensesitem )
                                    <option value="{{$expensesitem->id}}" >{{ $expensesitem->items }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="value" class="col-sm-1 control-label">{{trans('projectcosts.value')}}</label>
                        <div class="col-sm-3">
                            <input type="number" required name="value" class="form-control" id="value" placeholder="{{trans('projectcosts.value')}}">
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