@extends('admin.index')
@section('page_title')
    {{trans('currencyrates.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">

            <h3 class="box-title">{{trans('currencyrates.show')}}</h3>

        </div>
        <div class="box-header">
          <div class="col-md-2">
              <a href="{{aurl('currencies')}}" class="btn btn-primary"> <i class="fa fa-backward"></i> {{trans('العودة للعملات')}} </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{trans('currencyrates.currency_name')}}</th>
                        <th>{{trans('currencyrates.currencyrate')}}</th>
                    <th>{{trans('currencyrates.currency_ammount')}}</th>
                    <th>{{trans('admin.edit')}}</th>

                </tr>
                </thead>
                <tbody>

                @if($currencies->count()>0)
                    @foreach($currencies as $currency)

                        <tr>
                            <td>{{$currency->id}}</td>
                            <td>{{$currency->currency->currency_name}}</td>
                            <td>{{$currency->currencytorate->currency_name}}</td>
                            <td>{{$currency->rate}}</td>
                            @if(in_array(8, $temp))
                            <td><a href="{{aurl('currencyrate/'.$currency->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="center" colspan="9" style="text-align: center">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>{{trans('currencyrates.currency_name')}}</th>
                      <th>{{trans('currencyrates.currencyrate')}}</th>
                  <th>{{trans('currencyrates.currency_ammount')}}</th>
                  <th>{{trans('admin.edit')}}</th>


                </tr>
                </tfoot>

            </table>
            <br>
            @if($currencies->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$currencies->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$currencies->links()}}</div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->


    <!-- Trigger the modal with a button -->

    <!-- Modal -->
    <div id="mutlipleDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <div class="empty_record hidden">
                            <h4>{{ trans('admin.please_check_some_records') }} </h4>
                        </div>
                        <div class="not_empty_record hidden">
                            <h4>{{ trans('admin.ask_delete_itme') }} <span class="record_count"></span> ? </h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="empty_record hidden">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
                    </div>
                    <div class="not_empty_record hidden">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no') }}</button>
                        <input type="submit"  value="{{ trans('admin.yes') }}"  class="btn btn-danger del_all" />
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
