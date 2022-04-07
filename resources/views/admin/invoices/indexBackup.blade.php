@extends('admin.index')
@section('page_title')
    {{trans('invoices.show')}}
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('invoices.show')}}</h3>
        </div>

        <div class="box-header">
            @if(in_array(51, $temp))
                <div class="col-md-2">
                    <a href="{{aurl('invoices/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('invoices.create')}} </a>
                </div>
            @endif
            {{--                <form class="form-horizontal" method="POST" action="{{route('admin.invoices.printInvoices')}}"  enctype="multipart/form-data">--}}
            {{--                    {!! csrf_field() !!}--}}
            {{--                <button class="btn btn-success pull-left">طباعة المزيد</button>--}}
            {{--                </form>--}}
            <div class="col-md-6">
                <form method="get" action="{{aurl('invoices')}}" >
                    <div class="input-group">
                        <div class="form-group col-sm-12">
                            <label for="city" class="control-label">{{trans('clients.city')}}</label>
                            <div>
                                <select name="city" class="form-control select2">
                                    <option value="">   -----   اختيار المدينة     ----- </option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->name}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <label class="label-info"> اسم الزبون</label>
                            <select  class="form-control select2" name="name_client">
                                <option value="" >اختيار اسم الزبون</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->name_client}}" @if($client->name_client == request()->name_client) selected @endif >{{$client->name_client}}</option>
                                @endforeach
                            </select>
                            @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                                <br><br>
                                <label class="label-info"> اسم المستخدم</label>
                                <select name="user_id" class="form-control py-2 w-100 select2">
                                    <option value=""> اختيار اسم المستخدم</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('from', 'من') !!}
                            {!! Form::date('from', null, ['class' => 'form-control',"id" => "datepicker1",'autocomplete="off"']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('to', 'الي') !!}
                            {!! Form::date('to', null, ['class' => 'form-control',"id" => "datepicker",'autocomplete="off"']) !!}
                        </div>
                        <span class="col-sm-12">
                          <button type="submit" class="btn btn-info btn-lg btn-flat">بحث!</button>
                          <button type="submit" name="exports" value="excel" class="btn btn-success btn-lg btn-flat pull-left"><i class="fa fa-database"></i> Excel!</button>
                        </span>

                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <form method="POST" action="{{route('admin.invoices.printInvoices')}}" >
                    {!! csrf_field() !!}
                    <div class="input-group">
                        <div class="form-group col-sm-12">
                            <label for="city" class="control-label">{{trans('clients.city')}}</label>
                            <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">
                            <div>
                                <select name="city[]" class="form-control select2" multiple>
                                    <option value="">   -----   اختيار المدينة     ----- </option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->name}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <span class="col-sm-12">
                          <button type="submit" class="btn btn-bitbucket btn-lg btn-flat btn-block">طباعة <i class="fa fa-print"></i></button>
                        </span>

                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table  id=""  class="table table-bordered table-striped col-md-5">

                <thead>
                <tr>
                    <th>#</th>
                    <th>رقم الفاتورة</th>
                    <th>{{trans('invoices.date')}}</th>
                    <th>{{trans('invoices.client_id')}}</th>
                    <th>{{trans('invoices.address')}}</th>
                    <th>{{trans('invoices.sources')}}</th>

                    <th>{{trans('bills.pdf')}}</th>
                    <th>{{trans('invoices.notes')}}</th>
                    <th>{{trans('invoices.status')}}</th>
                    @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                        <th colspan="3">{{trans('invoices.statuschange')}}</th>
                    @else
                        <th>{{trans('invoices.barcode')}}</th>
                    @endif
                    <th>{{trans('عرض')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.savedraft')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>
                <form method="POST" action="{{route('admin.invoices.getInvoices')}}" >
                    {!! csrf_field() !!}
                    <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">

                    <button type="submit" name="save" value="print"  class="btn btn-primary btn-lg btn-flat btn-block">طباعة <i class="fa fa-print"></i></button>

                    @if($invoices->count()>0)
                        @foreach($invoices as $invoice)
                            @if(Auth::guard('admin')->user()->id == $invoice->user_id OR Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                                <tr>

                                    <td style="padding-top: 0px !important;padding-bottom: 62px !important;white-space:pre-line">
                                        <input type="checkbox" name="id[]"  value="{{$invoice->id}}"/>
                                        <input type="checkbox" name="invoice_id[{{$invoice->id}}]"  value="{{$invoice->id}}"/>
                                    </td>



                                    <td>{{$invoice->id}}</td>
                                    <td>{{date("Y/m/d",strtotime($invoice->created_at))}}</td>
                                    <td>{{str_limit(@$invoice->clients->name_client,15)}}</td>
                                    <td>{{str_limit(@$invoice->clients->city,15)}}</td>
                                    {{--                                <td> <img  src="{{url('upload/barcode/'.$invoice->barcode)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>--}}
                                    <td>{{str_limit(@$invoice->invoiceSource->name,15)}}</td>
                                    <td>
                                        @if(\App\Model\Invoicespdf::where('id_invoices',$invoice->id)->count() > 0)

                                            <a href="{{aurl('invoices/getpdf/'.$invoice->id)}}" class="btn btn-primary" style="background-color: indianred;"> <i class="fa fa-eye"></i> </a>

                                        @else
                                            <a href="{{aurl('invoices/createGetPdf/'.$invoice->id)}}" class="btn btn-warning" > <i class="fa fa-plus"></i> </a>

                                        @endif
                                    </td>
                                    @if($invoice->notes == null)
                                        <td>لاتوجد</td>
                                    @else
                                        <td>{{str_limit($invoice->notes,5)}}</td>
                                    @endif
                                    @if($invoice->status_id == 1)
                                        <td style="font-weight: bold">{{$invoice->status->name}}</td>
                                    @elseif($invoice->status_id == 2)
                                        <td style="background-color: lightgreen;font-weight: bold">{{$invoice->status->name}}</td>
                                    @else($invoice->status_id == 3)
                                        <td style="background-color: red ;color: white;font-weight: bold">{{$invoice->status->name}}</td>
                                    @endif
                                    @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                                        <td colspan="3">
                                            <form method="POST" action="{{route('admin.invoices.InvoicesStatus')}}" >
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="id" value="{{$invoice->id}}">
                                                <select class="form-control select2" name="status_id" required>
                                                    @foreach($invoicesStatus as $status)
                                                        <option value="{{$status->id}}" @if($status->id == $invoice->status_id) selected @endif>{{$status->name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-bitbucket btn-flat btn-block"><i class="fa fa-save"></i></button>
                                            </form>
                                        </td>
                                    @else
                                        <td> <img  src="{{url('upload/barcode/'.$invoice->barcode)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>
                                    @endif
                                    <td><a href="{{aurl('invoices/show/'.$invoice->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>
                                    @if($invoice->savedraft == 0)
                                        @if(in_array(52, $temp))
                                            <td><a href="{{aurl('invoices/'.$invoice->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
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
                                    <!-- Start Commented -->
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
                                                        <form method="POST" action="{{url('admin/invoices/')}}/{{$invoice->id}}" accept-charset="UTF-8">
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
                                        <!-- End Commented -->
                                    @else
                                        <td>{{trans('admin.role')}}</td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach

                </form>
                @else
                    <tr>
                        <td class="center" colspan="11" style="text-align: center">
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
                    <th>{{trans('invoices.address')}}</th>
                    <th>{{trans('invoices.sources')}}</th>
                    {{--<th>{{trans('invoices.currency_id')}}</th>--}}
                    {{--                    <th>{{trans('invoices.total')}}</th>--}}
                    <th>{{trans('bills.pdf')}}</th>
                    <th>{{trans('invoices.notes')}}</th>
                    <th>{{trans('invoices.status')}}</th>
                    @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                        <th colspan="2">{{trans('invoices.statuschange')}}</th>
                    @else
                        <th>{{trans('invoices.barcode')}}</th>
                    @endif
                    {{--<th>{{trans('invoices.tax')}}</th>--}}
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
                    @if(Auth::guard('admin')->user()->role_id == 1)
                        <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$invoices->total()}} </div>
                    @else @endif
                    <div class="col-md-7 col-sm-7">{{$invoices->appends(\Request::except('_token'))->render()}}</div>
                </div>
            @endif

        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->





@endsection
