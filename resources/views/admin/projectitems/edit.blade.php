@extends('admin.index')
@section('page_title')
    {{trans('projectitems.edit')}}
@endsection
@section('content')



    <div class="box">
        <div class="box-header">
            @if(!empty($projectitems->item_id))
            <h3 class="box-title">{{trans('projectitems.edit')}}{{'  رقم [  ' .$projectitems->projects->project_number. ' ] '}}</h3>
                @else
                <h3 class="box-title">{{trans('projectitems.edit')}}{{'  رقم [  ' .$projectdevices->projects->project_number. ' ] '}}</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">
@if(!empty($projectitems->item_id))
            <form class="form-horizontal" method="POST" action="{{url('admin/projectitems/')}}/{{$projectitems->id}}"  enctype="multipart/form-data">
@else
                    <form class="form-horizontal" method="POST" action="{{url('admin/projectitems/')}}/{{$projectdevices->id}}"  enctype="multipart/form-data">

    @endif
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    @if(!empty($projectitems->item_id))
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('projectitems.project_id')}}</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="project_id"   value="{{$projectitems->project_id}}">

                            <input type="text" readonly   class="form-control" value="{{$projectitems->projects->project_number}}">
                        </div>
                    </div>
                    @else
                        <div class="form-group">
                            <label class="col-sm-1 control-label" for="name">{{trans('projectitems.project_id')}}</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="project_id"   value="{{$projectdevices->project_id}}">

                                <input type="text" readonly   class="form-control" value="{{$projectdevices->projects->project_number}}">
                            </div>
                        </div>
                    @endif



                        @if(!empty($projectitems->item_id))
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('projectitems.item_id')}}</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="item_id">
                                <option class="form-control" value="">-----اختيار اسم المادة ----</option>
                                @foreach ($items as $item )
                                    <option value="{{$item->id}}" @if($projectitems->item_id == $item->id) selected @endif>{{ $item->item_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="quantity_b" class="col-sm-1 control-label">{{trans('projectitems.quantity')}}</label>
                        <div class="col-sm-4">
                            <input type="text" name="quantity_b" value="{{$projectitems->quantity_b}}" class="form-control total_price" id="quantity_b" placeholder="{{trans('projectitems.total_price')}}">
                        </div>
                    </div>
                        @else
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="name">{{trans('projectitems.item_id')}}</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="device_id">
                                        <option class="form-control" value="">-----اختيار اسم الجهاز ----</option>
                                        @foreach ($devices as $device )
                                            <option value="{{$device->id}}" @if($projectdevices->device_id == $device->id) selected @endif>{{ $device->devices_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="quantity_b" class="col-sm-1 control-label">{{trans('projectitems.quantity')}}</label>
                                <div class="col-sm-4">
                                    <input type="text" name="quantity" value="{{$projectdevices->quantity}}" class="form-control total_price" id="quantity_b" placeholder="{{trans('projectitems.total_price')}}">
                                </div>
                            </div>
                        @endif


                    <div class="form-group">

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