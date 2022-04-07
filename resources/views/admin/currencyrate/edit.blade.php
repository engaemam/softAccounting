@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.currencyrate.update')}}"  enctype="multipart/form-data">

                <input name="id" type="hidden" value="{{$currencyrates->id}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <div class="col-sm-10">
                      <label class="col-sm-1 control-label" for="name">{{trans('currencyrates.currency_name')}}</label>
                      <div class="col-sm-3">
                          <select class="form-control" name="currency_id" readonly>
                              <option class="form-control" value="">-----اختيار اسم العملة ----</option>
                              @foreach ($currencies as $currency )
                                  <option value="{{$currency->id}}" @if($currencyrates->currency_id == $currency->id) selected @endif @if($currencyrates->currency_id != $currency->id) disabled @endif>{{ $currency->currency_name }} </option>
                              @endforeach
                          </select>
                      </div>
                      <label class="col-sm-1 control-label" for="name">{{trans('currencyrates.currencyrate')}}</label>
                      <div class="col-sm-3">
                          <select class="form-control" name="to_currency_id" readonly>
                              <option class="form-control" value="">-----اختيار اسم العملة ----</option>
                              @foreach ($currencies as $currency )
                                  <option value="{{$currency->id}}" @if($currencyrates->to_currency_id == $currency->id) selected @endif @if($currencyrates->to_currency_id != $currency->id) disabled @endif>{{ $currency->currency_name }} </option>
                              @endforeach
                          </select>
                      </div>
                      <label for="date" class="col-sm-1 control-label">{{trans('currencyrates.currency_ammount')}}</label>
                      <div class="col-sm-3">
                          <input type="text" name="rate" class="form-control" value="{{$currencyrates->rate}}" id="date" placeholder="{{trans('currencies.currency_ammount')}}">
                      </div>
                    </div>
                </div>

                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <button class="btn default" type="reset">{{trans('currencyrates.reset')}}</button>
                    <button type="submit" class="btn btn-primary pull-right">{{trans('admin.edit')}}</button>
                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection
