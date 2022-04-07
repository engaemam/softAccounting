@extends('admin.index')
@section('page_title')
    {{trans('banktransfers.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('banktransfers.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.banktransfers.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">

                            <label class="col-sm-1 control-label" for="name">{{trans('banktransfers.import_id')}}</label>
                            <div class="col-sm-4">
                                <select class="form-control select2 " required   name="import_id" title="{{trans('banktransfers.import_id')}} ">
                                    @foreach ($imports as $import )
                                        <option value="{{@$import->id}}" >{{ @$import->number }} </option>
                                    @endforeach
                                </select>
                            </div>


                            <label for="type_expense" class="col-sm-1 control-label">{{trans('banktransfers.title')}}</label>
                            <div class="col-sm-4">
                                <input type="text" name="title" required class="form-control" id="title" placeholder="{{trans('banktransfers.title')}}">
                            </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label" >{{trans('banktransfers.body')}}</label>
                        <div class="col-sm-9">
                           <textarea class="form-control" name="body"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-1 control-label">{{trans('banktransfers.image')}}</label>
                        <div class="col-sm-10">
                            <input type="file" name="image"  id="image">
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