@extends('admin.index')
@section('page_title')
    {{trans('invoices.returnshow')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('returned_bills.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-4">
            @if(in_array(51, $temp))
                <div class="col-md-2">
                    <a href="{{aurl('returnedbills/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('returned_bills.create')}} </a>
                </div>
            @endif
            </div>
            <div class="col-md-6">
                <form method="get" action="{{aurl('returnedbills')}}" >
                    <div class="input-group">

                        <div class="form-group col-sm-12">
                            <label class="label-info"> اسم المسؤول</label>
                            <select  class="form-control select2" name="name_client">
                                <option value="" >اختيار اسم المسؤول</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->name_client}}" @if($client->name_client == request()->name_client) selected @endif >{{$client->name_client}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('from', 'من') !!}
                            {!! Form::date('from', null, ['class' => 'form-control',"id" => "datepicker1",'autocomplete="off"']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('to', 'الي') !!}
                            {!! Form::date('to', null, ['class' => 'form-control',"id" => "datepicker",'autocomplete="off"']) !!}
                        </div>
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

                    <th>رقم الفاتورة</th>
                    <th>{{trans('invoices.date')}}</th>
                    <th>{{trans('invoices.client_id')}}</th>
                    <th>{{trans('invoices.phone')}}</th>
                    <th>{{trans('invoices.address')}}</th>
                    <th>{{trans('invoices.barcode')}}</th>
                    <th>{{trans('invoices.sources')}}</th>
                    {{--<th>{{trans('invoices.currency_id')}}</th>--}}
                    <th>{{trans('invoices.total_invoice')}}</th>
                    <th>{{trans('invoices.notes')}}</th>
                    {{--<th>{{trans('invoices.tax')}}</th>--}}

                    <th>{{trans('عرض')}}</th>

{{--                    <th>{{trans('admin.savedraft')}}</th>--}}
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($invoices->count()>0)
                    @foreach($invoices as $invoice)

                        <tr>
                            <td>{{$invoice->id}}</td>
                            {{--                            <td><a href="{{aurl('returnedbills/bill/'.$invoice->id)}}" >{{$invoice->invoice_number}}</a></td>--}}
                            <td>{{date("Y/m/d",strtotime($invoice->created_at))}}</td>
                            <td>{{@$invoice->clients->name_client}}</td>
                            <td>{{@$invoice->clients->phone}}</td>
                            <td>{{@$invoice->clients->city}}</td>
                            <td> <img  src="{{url('upload/barcode/'.$invoice->barcode)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>
                            <td>{{@$invoice->invoiceSource->name}}</td>
                            {{--<td>{{@$invoice->currencies->currency_name}}</td>--}}
                            <td>{{$invoice->total_invoice}}</td>

                            <td>{{$invoice->notes}}</td>
                            {{--<td>--}}
                            {{--@if($invoice->taxes)--}}
                            {{--<a href="#" class="btn btn-success" > <i class="fa fa-check"></i> </a>--}}
                            {{--@else--}}
                            {{--<a href="{{aurl('returnedbills/addtaxs/'.$invoice->id)}}" class="btn btn-warning" > <i class="fa fa-plus"></i> </a>--}}

                            {{--@endif--}}
                            {{--</td>--}}

                            <!-- Start Commented -->
                            <td><a href="{{aurl('returnedbills/bill/'.$invoice->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>


                            @if(in_array(53, $temp))
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_invoices{{ $invoice->id }}"><i class="fa fa-trash"></i></button>

                                    <!-- Modal -->
                                    <div id="del_invoices{{ $invoice->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                                </div>
                                                <form method="POST" action="{{url('admin/returned__invoices/destroy/')}}/{{$invoice->id}}" accept-charset="UTF-8">
                                                    {!! csrf_field() !!}

                                                    <div class="modal-body">
                                                        <h4>{{ trans('admin.delete_this',['name'=>$invoice->id]) }}</h4>
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
                            <!-- End Commented -->
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

                    <th>رقم الفاتورة</th>
                    <th>{{trans('invoices.date')}}</th>
                    <th>{{trans('invoices.client_id')}}</th>
                    <th>{{trans('invoices.phone')}}</th>
                    <th>{{trans('invoices.address')}}</th>
                    <th>{{trans('invoices.barcode')}}</th>
                    <th>{{trans('invoices.sources')}}</th>
                    {{--<th>{{trans('invoices.currency_id')}}</th>--}}
                    <th>{{trans('invoices.total_invoice')}}</th>
                    <th>{{trans('invoices.notes')}}</th>
                    {{--<th>{{trans('invoices.tax')}}</th>--}}

                    <th>{{trans('عرض')}}</th>

{{--                    <th>{{trans('admin.savedraft')}}</th>--}}
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($invoices->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$invoices->total()}} </div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->





@endsection