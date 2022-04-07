@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('itemserials.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('itemserials.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{trans('itemserials.item_id')}}</label>
                        <div class="col-sm-4">
                            <select class="selectpicker" required  data-live-search="true" name="item_id" style="width: 100%;">
                                <option value=""  >-----اختيار اسم المادة ---- </option>
                                @foreach ($items as $item )
                                    @if($item->id == $item_id)
                                        <option value="{{$item->id}}" selected >{{ $item->item_name }} </option>
                                    @else
                                        <option value="{{$item->id}}">{{ $item->item_name }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" for="name">{{trans('itemserials.supplier_id')}}</label>
                        <div class="col-sm-4">
                            <select class="selectpicker"   data-live-search="true" name="supplier_id">
                                <option class="form-control" value="">-----اختيار اسم المورد ----</option>
                                @foreach ($suppliers as $supplier )
                                    <option value="{{$supplier->id}}"@if($itemserials->supplier_id == $supplier->id) selected @endif>{{ $supplier->suppliers_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="serial_number"  class="col-sm-2 control-label">{{trans('itemserials.serial_number')}}</label>
                        <div class="col-sm-3">
                            <input type="text" required name="serial_number" class="form-control" id="serial_number" placeholder="{{trans('itemserials.serial_number')}}">
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


@endsection