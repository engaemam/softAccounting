@extends('admin.index')
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('currencyrate.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('currencyrate.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-10">
                          <label class="col-sm-1 control-label" for="name">{{trans('currencies.currency_name')}}</label>
                          <div class="col-sm-3">
                              <select class="form-control" name="currency_id">
                                  <option class="form-control" value="">-----اختيار اسم العملة ----</option>
                                  @foreach ($currencies as $currency )
                                      <option value="{{$currency->id}}">{{ $currency->currency_name }} </option>
                                  @endforeach
                              </select>
                          </div>
                          <label class="col-sm-1 control-label" for="name">{{trans('currencies.currency_name')}}</label>
                          <div class="col-sm-3">
                              <select class="form-control" name="to_currency_id">
                                  <option class="form-control" value="">-----اختيار اسم العملة ----</option>
                                  @foreach ($currencies as $currency )
                                      <option value="{{$currency->id}}">{{ $currency->currency_name }} </option>
                                  @endforeach
                              </select>
                          </div>
                          <label for="date" class="col-sm-1 control-label">{{trans('currencies.currency_ammount')}}</label>
                          <div class="col-sm-3">
                              <input type="text" name="rate" class="form-control" id="date" placeholder="{{trans('currencies.currency_ammount')}}">
                          </div>
                        </div>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <button class="btn default" type="reset">{{trans('currencies.reset')}}</button>

                    <button type="submit" class="btn btn-primary pull-right">{{trans('currencies.create')}}</button>
                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
