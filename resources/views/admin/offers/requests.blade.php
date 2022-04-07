@extends('admin.index')
@section('page_title')
    طلبات العروض
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">طلبات العروض</h3>
        </div>

{{--        <div class="box-header">--}}
{{--            @if(in_array(51, $temp))--}}
{{--                <div class="col-md-2">--}}
{{--                    <a href="{{aurl('invoices/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('invoices.create')}} </a>--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <div class="col-md-6">--}}
{{--                <form method="get" action="{{aurl('invoices')}}" >--}}
{{--                    <div class="input-group">--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label for="city" class="control-label">{{trans('clients.city')}}</label>--}}
{{--                            <div>--}}
{{--                                <select name="city" class="form-control select2">--}}
{{--                                    <option value="">   -----   اختيار المدينة     ----- </option>--}}

{{--                                    @foreach($cities as $ids => $city)--}}
{{--                                        <option value="{{$city}}">{{ $city}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div><br>--}}
{{--                            <label class="label-info"> اسم الزبون</label>--}}
{{--                            <select  class="form-control select2" name="name_client">--}}
{{--                                <option value="" >اختيار اسم الزبون</option>--}}
{{--                                @foreach($clients as $ids => $client)--}}
{{--                                    <option value="{{$ids}}">{{$client}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select><br><br>--}}
{{--                            <label class="label-success"> رقم الزبون</label>--}}
{{--                            <select  class="form-control select2" name="client_phone">--}}
{{--                                <option value="" >اختيار رقم الزبون</option>--}}
{{--                                @foreach($clients_phone as $ids => $phone)--}}
{{--                                    <option value="{{$ids}}" >{{$phone}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)--}}
{{--                                <br><br>--}}
{{--                                <label class="label-primary"> اسم المستخدم</label>--}}
{{--                                <select name="user_id" class="form-control py-2 w-100 select2">--}}
{{--                                    <option value=""> اختيار اسم المستخدم</option>--}}
{{--                                    @foreach($users as $ids => $user)--}}
{{--                                        <option value="{{$ids}}">{{$user}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            {!! Form::label('from', 'من') !!}--}}
{{--                            {!! Form::date('from', null, ['class' => 'form-control',"id" => "datepicker1",'autocomplete="off"']) !!}--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            {!! Form::label('to', 'الي') !!}--}}
{{--                            {!! Form::date('to', null, ['class' => 'form-control',"id" => "datepicker",'autocomplete="off"']) !!}--}}
{{--                        </div>--}}
{{--                        <span class="form-group col-sm-6"><br>--}}
{{--                          <button type="submit" class="btn btn-info btn-lg btn-flat">بحث!</button>--}}
{{--                          <button type="submit" name="exports" value="excel" class="btn btn-success btn-lg btn-flat pull-left"><i class="fa fa-database"></i> Excel!</button>--}}
{{--                        </span>--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div class="col-md-3">--}}
{{--                <form method="POST" action="{{route('admin.invoices.printInvoices')}}" >--}}
{{--                    {!! csrf_field() !!}--}}
{{--                    <div class="input-group">--}}
{{--                        <div class="form-group col-sm-12">--}}
{{--                            <label for="city" class="control-label">{{trans('clients.city')}}</label>--}}
{{--                            <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">--}}
{{--                            <div>--}}
{{--                                <select name="city[]" class="form-control select2" multiple>--}}
{{--                                    <option value="" readonly>   -----   اختيار المدينة     ----- </option>--}}
{{--                                    @foreach($cities as $ids => $city)--}}
{{--                                        <option value="{{$city}}">{{$city}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <span class="col-sm-12">--}}
{{--                          <button type="submit" class="btn btn-bitbucket btn-lg btn-flat btn-block">طباعة <i class="fa fa-print"></i></button>--}}
{{--                        </span>--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /.box-header -->--}}
{{--        --}}{{--        <form method="POST" onsubmit="return atleast_onecheckbox(event)" id="form_check" class="form" action="{{route('admin.invoices.getInvoices')}}" >--}}
        {{--            {!! csrf_field() !!}--}}
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>تاريخ الطلب</th>
                    <th>رقم الطلب</th>
                    <th>{{trans('invoices.client_id')}}</th>
                    <th> عدد مرات الإلغاء</th>
                    <th>المدينة</th>
                    <th>مصدر الطلب</th>

                    <th>حالة الطلب</th>
                    @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                        <th colspan="3">تغيير حالة الطلب</th>
                    @else
                        <th>{{trans('invoices.barcode')}}</th>
                    @endif
                    <th>{{trans('عرض')}}</th>
                    <th>رفض الطلب</th>
                </tr>
                </thead>
                <tbody>
                @if($invoices->count()>0)
                    <?php
                            $i=0;
                            $j=0;
                            $k=-1;
                            $x =0;
                    ?>
                    @foreach($invoices as $invoice)

                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{date("Y/m/d",strtotime($invoice->created_at))}}</td>

                            <td>{{$invoice->id}}</td>
                           <td hidden>{{++$j}}</td>
                            <td>{{str_limit(@$invoice->clients->name_client,15)}}</td>

                            <td style="color:red">
                                @foreach ($data as $d)
                                @if ($d->clients_id == $invoice->client_id && $d->count != 0)
                                 {{$d->count}}
                                 @break
                                @endif
                                @endforeach
                                </td>


                            <td>{{str_limit(@$invoice->clients->city,15)}}</td>
                            {{--                                <td> <img  src="{{url('upload/barcode/'.$invoice->barcode)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>--}}

                                    @if(isset($invoice->invoiceSource->name))
                                 <td>{{$invoice->invoiceSource->name}}</td>
                                        @else
                                <td>غير محدد</td>

                            @endif

                            @if($invoice->status_id == 1 && $invoice->direct == 0)
                                <td style="font-weight: bold">{{$invoice->status->name}}</td>
                            @elseif($invoice->status_id == 0 && $invoice->direct == 0)
                                <td style="background-color: lightgreen;font-weight: bold">{{$invoice->status->name}}</td>
                            @elseif($invoice->status_id == 2 && $invoice->direct == 0)
                                <td style="background-color: lightgreen;font-weight: bold">{{$invoice->status->name}}</td>
                            @elseif($invoice->status_id == 3 && $invoice->direct == 0)
                                <td style="background-color: red ;color: white;font-weight: bold">{{$invoice->status->name}}</td>
                            @endif

                            @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                            @if($invoice->status_id != 3 And $invoice->direct == 0)

                                <td colspan="3">
                                    <form method="POST" action="{{route('confirmRequest')}}" id="statusform" >
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id" value="{{$invoice->id}}">
                                        <button type="submit" class="btn btn-bitbucket btn-flat btn-block"><i class="fa fa-save"></i> تأكيد الطلب</button>
                                    </form>
                                </td>
                                @else
                                    <td style="background-color: lightgreen ;color: white;font-weight: bold"colspan="3">
                                  لا يمكن

                                    </td>

                                @endif
                            @else
                                <td> <img  src="{{url('upload/barcode/'.$invoice->barcode)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>
                            @endif
                            <td><a href="{{route('showReq',$invoice->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>
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

                                                    <div class="modal-body">
                                                        <h4>{{ trans('admin.delete_this',['name'=>$i]) }}</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                    @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                                                    <input type="hidden" name="id" value="{{$reqs[0]}}">
                                                    <form method="get" action="{{route('request.changestatus',[$reqs[0]])}}" id="statusform" >
                                                        <button type="submit" class="btn btn-bitbucket btn-flat btn-block"><i class="fa fa-save"></i></button>
                                                    </form>
                                                    @endif
                                                    </div>

                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <!-- End Commented -->
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                        </tr>

                    @endforeach

                @else
                    <tr>
                        <td class="center" colspan="11" style="text-align: center">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif


                </tbody>
            </table>
        </div>

        {{--        </form>--}}
        <br>
        @if($invoices->count()>0)
            <div class="row">
                @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$invoices->total()}} </div>
                @else @endif
                <div class="col-md-7 col-sm-7">{{$invoices->appends(\Request::except('_token'))->render()}}</div>
            </div>
        @endif
    <!-- /.box-body -->

    </div>
    <!-- /.box -->





@endsection
<script>
    function atleast_onecheckbox(e) {
        if ($("input[type=checkbox]:checked").length === 0) {
            e.preventDefault();
            alert('الرجاء إختيار فاتورة واحده على الأقل لطباعتها');
            return false;
        }
    }
    $('#statusform').submit(function (event) {
        event.preventDefault();
        alert('test');
        var postData ={
            'email':$('#loginEmail').val() ,
            'password':$('#loginPassword').val() ,
        } ;

        $.ajax({
            type:'POST',
            url:'/login',
            data: postData,
            success: function(response){
                console.log();
                console.log();
                $('input[name="name_client"]').val(response['name_client']);
                $('input[name="country"]').val(response['country']);
                $('input[name="city"]').val(response['city']);
                $('#address').val(response['client_position']);
                $('#notes').val(response['notes']);
                $('input[name="phone"]').val(response['phone']);
                $('input[name="postal"]').val(response['postalCode']);
                $('input[name="id"]').val(response['id']);
                $('#loginForm').hide();
                $('input[name="email"]').hide();
                $('input[name="password"]').hide();
                $('#client').text('Welcome '+response['name_client']);
            },
            error: function (response) {
                $('.alert-danger').text(response.responseJSON.error);
                $('.alert-danger').show();
                $('.alert').fadeOut(4000);
            }
        })
    })</script>
