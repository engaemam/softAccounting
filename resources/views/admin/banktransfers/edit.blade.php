@extends('admin.index')
@section('page_title')
    {{trans('banktransfers.edit')}}
@endsection
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



    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('banktransfers.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.banktransfers.update')}}"  enctype="multipart/form-data">
               <input type="hidden" name="id" value="{{$banktransfer->id}}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">

                        <label class="col-sm-1 control-label" for="name">{{trans('banktransfers.import_id')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control select2 " required   name="import_id" title="{{trans('banktransfers.import_id')}} ">
                                @foreach ($imports as $import )
                                    <option value="{{@$import->id}}" @if($banktransfer->import_id == $import->id) selected @endif>{{ @$import->number }} </option>
                                @endforeach
                            </select>
                        </div>


                        <label for="type_expense" class="col-sm-1 control-label">{{trans('banktransfers.title')}}</label>
                        <div class="col-sm-4">
                            <input type="text" name="title" value="{{$banktransfer->title}}" required class="form-control" id="title" placeholder="{{trans('banktransfers.title')}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label" >{{trans('banktransfers.body')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="body">{{$banktransfer->body}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('banktransfers.image')}}</label>
                        <div class="col-md-3">
                            <div class="fileinput @if($banktransfer->image) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                                <div class="input-group input-large">

                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                        <img class="fileinput-filename" src="{{url('upload/bank/'.$banktransfer->image)}}" style="max-width: 200px; max-height: 100px;" alt="" />
                                    </div>
                                    <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new">  </span>
                                                <span class="fileinput-exists">  تغيير </span>
                                                <input type="file"   name="image" value="{{$banktransfer->image}}">

                                            </span>

                                    </div>
                                </div>
                            </div>
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