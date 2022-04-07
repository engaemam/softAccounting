@extends('admin.index')
@section('page_title')
    {{$title}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/supplierproducts/')}}/{{$supplierproducts->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{trans('supplierproducts.supplier_id')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control selectpicker" required data-live-search="true" name="supplier_id">
                                <option class="form-control" disabled value="">-----اختيار اسم المورد ----</option>
                                @foreach ($suppliers as $supplier )
                                    <option value="{{$supplier->id}}"@if($supplierproducts->supplier_id == $supplier->id) selected @endif>{{ $supplier->suppliers_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{trans('supplierproducts.item_id')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control selectpicker" required  data-live-search="true" name="item_id[]">
                                <option class="form-control"   value="" > -----اختيار اسم المادة ---- </option>
                                @foreach ($items as $item )
                                    <option value="{{$item->id}}"@if($supplierproducts->item_id == $item->id) selected @endif>{{ $item->item_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="last_price" class="col-sm-2 control-label">{{trans('supplierproducts.last_price')}}</label>
                        <div class="col-sm-2">
                            <input type="text" name="last_price[]" required value="{{$supplierproducts->last_price}}" class="form-control" placeholder="{{trans('supplierproducts.last_price')}}">
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