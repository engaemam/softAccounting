@extends('admin.index')
@section('page_title')
    {{trans('moneyorders.add')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('moneyorders.add')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/moneyorders/')}}/{{$moneyorders->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="type" class="col-sm-1 control-label">{{trans('moneyorders.type')}}</label>
                        <div class="col-sm-3">
                            <select name="type" id="type" class="form-control" required>
                                <option value="">برجاء اختيار</option>
                                <option value="1" @if($moneyorders->type == 1) selected @endif>امر قبض</option>
                                <option value="2" @if($moneyorders->type == 2) selected @endif>امر دفع</option>
                            </select>
                        </div>
                        <label for="number" class="col-sm-1 control-label">{{trans('moneyorders.number')}}</label>
                        <div class="col-sm-3">
                            <input type="text" value="{{$moneyorders->number}}" required name="number" class="form-control" id="number" placeholder="{{trans('moneyorders.number')}}">
                        </div>
                        <label for="dates" class="col-sm-1 control-label">{{trans('moneyorders.dates')}}</label>
                        <div class="col-sm-2">
                            <input type="date" value="{{$moneyorders->dates}}" required name="dates" class="form-control" id="dates" placeholder="{{trans('moneyorders.dates')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_id" class="col-sm-1 control-label">{{trans('moneyorders.client_id')}}</label>
                        <div class="col-sm-3">
                            <select name="client_id" id="client_id" class="form-control select2" required>
                                <option value="">برجاء اختيار اسم الزبون</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}" @if($client->id == $moneyorders->client_id) selected @endif>{{$client->name_client}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="bill_id" class="col-sm-1 control-label">{{trans('moneyorders.bill_id')}}</label>
                        <div class="col-sm-3">
                            <select name="bill_id" id="bill_id" class="form-control select2" >
                                <option value="">برجاء اختيار رقم الفاتورة</option>
                                @foreach($bills as $bill)
                                    <option value="{{$bill->id}}" @if($bill->id == $moneyorders->bill_id) selected @endif>{{$bill->bill_number}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="value" class="col-sm-1 control-label">{{trans('moneyorders.value')}}</label>
                        <div class="col-sm-2">
                            <input type="number" required name="value" class="form-control" value="{{$moneyorders->value}}" id="value" placeholder="{{trans('moneyorders.value')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="currency_id" class="col-sm-1 control-label">{{trans('moneyorders.currency_id')}}</label>
                        <div class="col-sm-3">
                            <select name="currency_id" id="currency_id" class="form-control select2"  required>
                                <option value="">برجاء اختيار العملة </option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}" @if($currency->id == $moneyorders->currency_id) selected @endif>{{$currency->currency_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('moneyorders.notes')}}</label>
                        <div class="col-sm-10">
                            <textarea name="notes" class="form-control" id="notes">{{$moneyorders->notes}}</textarea>
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