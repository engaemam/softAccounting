@extends('admin.index')
@section('page_title')
    {{trans('custodys.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('custodys.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('custodys.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">


                        <label for="number" class="col-sm-1 control-label">{{trans('custodys.number')}}</label>
                        <div class="col-sm-3">
                            <input type="text" required name="number" class="form-control" id="number" placeholder="{{trans('custodys.number')}}">
                        </div>
                        <label for="title" class="col-sm-1 control-label">{{trans('custodys.title')}}</label>
                        <div class="col-sm-3">
                            <input type="text" required name="title" class="form-control" id="title" placeholder="{{trans('custodys.title')}}">
                        </div>
                        <label for="dates" class="col-sm-1 control-label">{{trans('custodys.dates')}}</label>
                        <div class="col-sm-2">
                            <input type="date" required name="dates" class="form-control" id="dates" placeholder="{{trans('custodys.dates')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="project_id" class="col-sm-1 control-label">{{trans('custodys.project_id')}}</label>
                        <div class="col-sm-3">
                            <select name="project_id" id="project_id" class="form-control select2" >
                                <option value="">برجاء اختيار اسم المشروع</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="value" class="col-sm-1 control-label">{{trans('custodys.value')}}</label>
                        <div class="col-sm-2">
                            <input type="number" required name="value" class="form-control" id="value" placeholder="{{trans('custodys.value')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('custodys.notes')}}</label>
                        <div class="col-sm-10">
                            <textarea name="notes" class="form-control" id="notes"></textarea>
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