@extends('admin.index')
@section('page_title')
    {{trans('moneyorders.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('moneyorders.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                <a href="{{aurl('moneyorders/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('moneyorders.create')}} </a>
            </div>

            <div class="col-md-5">
                <form method="get" action="{{aurl('moneyorders')}}" >
                    <div class="input-group">
                        <input type="search" name="search" value="{{ request()->search != '' ? request()->search : ''}}" class="form-control">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">بحث!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{trans('moneyorders.number')}}</th>
                    <th>{{trans('moneyorders.type')}}</th>
                    <th>صاحب الفاتورة</th>
                    <th>{{trans('moneyorders.bill_id')}}</th>
                    <th>{{trans('moneyorders.value')}}</th>
                    <th>{{trans('moneyorders.dates')}}</th>
                    <th>{{trans('moneyorders.currency_id')}}</th>
                    <th>{{trans('moneyorders.notes')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($moneyorders->count()>0)
                    @foreach($moneyorders as $bill)

                        <tr>
                            <td>{{$bill->id}}</td>
                            <td>{{$bill->number}}</td>
                            <td>
                                @if($bill->type ==1)
                                    امر قبض
                                    @else
                                    امر دفع
                                @endif
                            </td>
                            @if(@$bill->client_id != NULL)
                            <td>زبون-{{@$bill->Clients->name_client}}</td>
                            @else
                            <td>مورد-{{@$bill->Suppliers->suppliers_name}}</td>
                            @endif
                            <td>{{@$bill->bill_id}}</td>
                            <td>{{$bill->value}}</td>
                            <td>{{$bill->dates}}</td>
                            <td>{{@$bill->currency->currency_name}}</td>
                            <td>{{$bill->notes}}</td>

                            @if(in_array(50, $temp))
                            <td><a href="{{aurl('moneyorders/'.$bill->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            @if(in_array(40, $temp))
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_moneyorders{{ $bill->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_moneyorders{{ $bill->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{url('admin/moneyorders/')}}/{{$bill->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$bill->id]) }}</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
                                                    <input class="btn btn-danger" type="submit" value="{{trans('admin.yes')}}">
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </td>

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
                    <th>{{trans('moneyorders.number')}}</th>
                    <th>{{trans('moneyorders.type')}}</th>
                    <th>{{trans('moneyorders.client_id')}}</th>
                    <th>{{trans('moneyorders.bill_id')}}</th>
                    <th>{{trans('moneyorders.value')}}</th>
                    <th>{{trans('moneyorders.dates')}}</th>
                    <th>{{trans('moneyorders.currency_id')}}</th>
                    <th>{{trans('moneyorders.notes')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($moneyorders->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$moneyorders->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$moneyorders->appends(\Request::except('_token'))->render()}}</div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->

    </div>



@endsection
