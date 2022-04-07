@extends('admin.index')
@section('page_title')
    {{trans('importexpenses.edit')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('importexpenses.edit')}}</h3>
            <a href="#" class="btn btn-danger"><i class="fa fa-warning"> </i> عملة الاستيراد : {{$project->currency->currency_name}}</a>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.importexpenses.update')}}"  enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$importexpenses->id}}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">{{trans('importexpenses.import_id')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control "  data-live-search="true" name="import_id" title="{{trans('importexpenses.import_id')}} ">

                                @foreach ($imports as $import )
                                    <option value="{{$import->id}}" @if($importexpenses->import_id == $import->id) selected @endif @if($importexpenses->import_id != $import->id) disabled @endif>{{ $import->number }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <?php
                    $shipping_id=explode(',',$importexpenses->importname_id);
                    $values=explode(',',$importexpenses->value);
                    ?>
                    <div id="maindiv">
                        <div class="row">
                            @foreach ($shipping_id as $key => $value )
                                <div class="form-group">
                                    <label class="col-sm-1 control-label" for="name">{{trans('importexpenses.shipping')}}</label>
                                    <div class="col-sm-5">
                                        <select class="form-control select2 " data-live-search="true" name="importname_id[]" title="اختيار اسم الشحن">
                                            @foreach ($importnames as $importname )
                                                @if($importname->id == $value)
                                                    <option value="{{$importname->id}}" selected >{{ $importname->name }} </option>
                                                @else
                                                    <option value="{{$importname->id}}">{{ $importname->name }} </option>
                                                @endif
                                                @endforeach
                                        </select>
                                    </div>
                                    <label for="value" class="col-sm-1 control-label">{{trans('importexpenses.value')}}</label>
                                    <div class="col-sm-3">
                                        @foreach($values as $key1 => $value1)
                                            @if($key == $key1)
                                        <input type="text" value="{{$value1}}" name="value[]" class="form-control" id="value" placeholder="{{trans('importexpenses.value')}}">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
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