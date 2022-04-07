@extends('admin.index')
@section('page_title')
    {{trans('returneditems.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('returneditems.show')}}</h3>
        </div>
        <div class="box-header">
{{--            @if(in_array(51, $temp))--}}
{{--            <div class="col-md-2">--}}
{{--                <a href="{{aurl('returned_invoices/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('returneditems.create')}} </a>--}}
{{--            </div>--}}
{{--            @endif--}}
            <div class="col-md-2">
                <a href="{{Route('admin.invoices.exportinvoices')}}" class="btn btn-success"> <i class="fa fa-database"></i> Excel </a>
            </div>
            <div class="col-md-6">
                <form method="get" action="{{aurl('returned_invoices')}}" >
                    <div class="input-group">

                        <div class="form-group col-sm-5">
                            <label class="label-info"> اسم المسؤول</label>
                            <select  class="form-control select2" name="name_client">
                                <option value="" >اختيار اسم المسؤول</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->name_client}}" @if($client->name_client == request()->name_client) selected @endif >{{$client->name_client}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-5">
                            {!! Form::label('from', 'من') !!}
                            {!! Form::date('from', null, ['class' => 'form-control',"id" => "datepicker1",'autocomplete="off"']) !!}
                        </div>
                        <div class="form-group col-sm-5">
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
                    <th>{{trans('returneditems.date')}}</th>
                    <th>{{trans('returneditems.client_id')}}</th>
                    <th>{{trans('returneditems.phone')}}</th>
                    <th>{{trans('returneditems.address')}}</th>
                    <th>{{trans('returneditems.sources')}}</th>
                    {{--<th>{{trans('returneditems.currency_id')}}</th>--}}
                    <th>{{trans('returneditems.total_invoice')}}</th>
                    <th>{{trans('bills.pdf')}}</th>
                    <th>{{trans('returneditems.notes')}}</th>
                    <th>{{trans('returneditems.status')}}</th>
                    {{--<th>{{trans('returneditems.tax')}}</th>--}}

                    <th>{{trans('عرض')}}</th>

                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.savedraft')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($invoices->count()>0)
                    @foreach($invoices as $invoice)

                        <tr>
                            <td>{{$invoice->id}}</td>
{{--                            <td><a href="{{aurl('returned_invoices/show/'.$invoice->id)}}" >{{$invoice->invoice_number}}</a></td>--}}
                            <td>{{$invoice->date}}</td>
                            <td>{{@$invoice->clients->name_client}}</td>
                            <td>{{@$invoice->clients->phone}}</td>
                            <td>{{@$invoice->clients->city}}</td>
                            <td>{{@$invoice->invoiceSource->name}}</td>
                            {{--<td>{{@$invoice->currencies->currency_name}}</td>--}}
                            <td>{{$invoice->total_invoice}}</td>
                            <td>
                            @if(\App\Model\Invoicespdf::where('id_invoices',$invoice->id)->count() > 0)

                            <a href="{{aurl('returned_invoices/getpdf/'.$invoice->id)}}" class="btn btn-primary" style="background-color: indianred;"> <i class="fa fa-eye"></i> </a>

                            @else
                                    <a href="{{aurl('returned_invoices/createGetPdf/'.$invoice->id)}}" class="btn btn-warning" > <i class="fa fa-plus"></i> </a>

                                @endif
                                </td>

                            <td>{{$invoice->notes}}</td>
                            @if($invoice->status_id == 1 )
                            <td style="color: green;font-weight: bold">{{trans('returneditems.notreturned')}}</td>
                            @else
                            <td style="color: red;font-weight: bold">{{trans('returneditems.returned')}}</td>
                            @endif
                            {{--<td>--}}
                            {{--@if($invoice->taxes)--}}
                                {{--<a href="#" class="btn btn-success" > <i class="fa fa-check"></i> </a>--}}
                            {{--@else--}}
                                {{--<a href="{{aurl('returned_invoices/addtaxs/'.$invoice->id)}}" class="btn btn-warning" > <i class="fa fa-plus"></i> </a>--}}

                             {{--@endif--}}
                            {{--</td>--}}
                            <td><a href="{{aurl('returned_invoices/show/'.$invoice->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>
                            @if($invoice->savedraft == 0)
                                @if(in_array(52, $temp))
                                <td><a href="{{aurl('returned_invoices/'.$invoice->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                                @else
                                    <td>{{trans('admin.role')}}</td>
                                @endif
                            @else
                                <td> <span class="label label-danger">لا يمكنك التعديل</span></td>
                            @endif

                            <td>
                                @if($invoice->savedraft == 0)
                                    <form action="{{route('admin.invoices.savedraftTosave')}}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id"  value="{{$invoice->id}}">
                                        <button type="submit"  class="btn btn-microsoft">تحويل</button>
                                    </form>
                                @else
                                    <p>حفظ</p>
                                @endif
                            </td>

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
                                            <form method="POST" action="{{url('admin/returned_invoices/')}}/{{$invoice->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">
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
                    <th>{{trans('returneditems.date')}}</th>
                    <th>{{trans('returneditems.client_id')}}</th>
                    <th>{{trans('returneditems.phone')}}</th>
                    <th>{{trans('returneditems.address')}}</th>
                    <th>{{trans('returneditems.sources')}}</th>
                    {{--<th>{{trans('returneditems.currency_id')}}</th>--}}
                    <th>{{trans('returneditems.total_invoice')}}</th>
                    <th>{{trans('bills.pdf')}}</th>
                    <th>{{trans('returneditems.notes')}}</th>
                    <th>{{trans('returneditems.status')}}</th>
                    {{--<th>{{trans('returneditems.tax')}}</th>--}}

                    <th>{{trans('عرض')}}</th>

                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.savedraft')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($invoices->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$invoices->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$invoices->appends(\Request::except('_token'))->render()}}</div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->





@endsection