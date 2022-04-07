@extends('admin.index')
@section('page_title')
    {{trans('طباعة فواتير بيع')}}
@endsection
@section('content')
    <style>
        @media print {
            .no-print {
                visibility: hidden;
            }
            .checkbox{
                display: none;
            }
            .main-footer{
                display: none;
            }
            .zzz{
                display: none;
            }
            .no-print{
                display: none;
            }
        }
    </style>
    <a href="{{ aurl('invoices') }}" class="btn btn-primary btn-lg no-print">رجوع</a>
    <div class="row no-print pull-left" style="margin-top: 0px">
        <div class="col-xs-12">
            <a onclick="print()" class="btn btn-success btn-lg"><i class="fa fa-print"></i> طباعة</a>
        </div>
    </div>
    <!-- Main content -->
    @foreach($invoices as $invoices)
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header pull-left">
                                <span class=""><img  src="{{url('asst_ar/img/logo.png')}}" style="max-width: 200px; max-height: 100px;" alt="" /></span>
                            </h2>
                            <h2 class="page-header ">
                                <small class="pull-right"><b>{{trans('invoices.invoices_number')}} </b> :  {{$invoices->id}}<br></small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>


                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <td class="pull-left"> <img  src="{{url('upload/barcode/'.$invoices->barcode)}}" style="max-width: 100px; max-height: 100px;" alt=""/></td>
                            {{--<b> العملة </b>:  {{@$invoices->currencies->currency_name}}<br>--}}
                            <br><br><td class="pull-left"><b>{{trans('invoices.phone')}}</b> : @if($invoices->clients->phone == '') {{'لايوجد'}} @else {{$invoices->clients->phone}} @endif<br></td>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>{{trans('admin.username')}}</b> : {{ $invoices->Admin->name }}<br>
                            <td class="pull-left"><div style="margin-top: 10px">
                                    <b></div></td>
                            <b> {{trans('invoices.address')}} </b>: @if($invoices->clients->notes == '') {{'لاتوجد تفاصيل'}} @else {{$invoices->clients->notes}} @endif<br>
                            <b> {{trans('invoices.notes')}} </b>: @if($invoices->notes == '') {{'لاتوجد'}} @else {{$invoices->notes}} @endif<br>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            {{--                <b>{{trans('invoices.invoices_number')}} #{{$invoices->invoice_number}}</b><br>--}}
                            <b>{{trans('invoices.date')}} </b> :  {{date("Y/m/d",strtotime($invoices->created_at))}}<br>

                            <b>{{trans('invoices.client_id')}}</b> : {{$invoices->clients->name_client}}<br>
                            {{--                <b>{{trans('invoices.invoice_source')}} </b> :  {{@$invoices->invoiceSource->name}}<br>--}}
                            <b>{{trans('invoices.city')}}</b> : {{$invoices->city}}<br>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <br><br>

                    <!-- Table row ITEMS -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <!-- <h4 style="color: red">ال </h4> -->
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>عدد</th>
                                    <th>الموديل</th>
                                    <th>المواصفة</th>
                                    <th>مواصفة 2</th>
                                    <th>العدد</th>

                                    <th>السعر</th>
                                    <th>الإجمالي</th>

                                </tr>
                                </thead>
                                {{--Device--}}
                                <tbody>
                                @php
                                    $i =0;
                                @endphp
                                </tbody>
                                {{--ITems--}}
                                <tbody>

                                @foreach ($invoiceitems as $key => $invoiceitem)
                                    @if($invoiceitem->invoice_id == $invoices->id)
                                        <tr>

                                            <td>{{$i+1}}</td>
                                            <td>{{@$invoiceitem->items->item_name}}</td>
                                            <td>{{@$invoiceitem->ItemColor->name}}</td>
                                            <td>{{@$invoiceitem->ItemSize->name}}</td>
                                            <td>{{$invoiceitem->quantity_b}}</td>
                                            <td>{{round(($invoiceitem->price_b),2)}} </td>
                                            <td>{{round(($invoiceitem->total_price_b),2)}} </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                      @endif
                                @endforeach



                                </tbody>

                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    {{--row--}}

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-responsive">
                                <table class="table">
                                    <tr class="no-print">

                                    </tr>

                                    <tr>
                                        <th>اجمالي سعر الأصناف</th>
                                        <td>{{round((@$invoices->total_invoice),2)}} {{@$invoices->currencies->currency_name}} </td>


                                        <th>مصاريف الشحن </th>
                                        @if($invoices->shipping_costs == null)
                                            <td>لاتوجد</td>
                                        @else
                                            <td>{{$invoices->shipping_costs}}</td>
                                        @endif
                                        <th>الخصم</th>
                                        @if($invoices->discount == null)
                                            <td>لايوجد</td>
                                        @else
                                            <td>{{$invoices->discount}} </td>
                                        @endif
                                        <th>صافي الفاتورة</th>
                                        @if($invoices->afterdiscount == null)
                                            <td> {{(round((@$invoices->total_invoice),2) - $invoices->discount) + $invoices->shipping_costs}}</td>
                                        @else
                                            <td> {{$invoices->afterdiscount}}</td>
                                        @endif

                                    </tr>

                                    <tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                </section >
                <center>
                    --------------------------------------------------
                    --------------------------------------------------
                    --------------------------------------------------
                </center>
    @endforeach
    <script>
        function print() {
            window.print();
        }
    </script>

    <!-- /.content -->
    <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->

@endsection
