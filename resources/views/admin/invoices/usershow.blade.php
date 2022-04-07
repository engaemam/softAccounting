
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> offer
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('asst/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('asst/bower_components/font-awesome/css/font-awesome.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('asst_ar/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{url('asst_ar/dist/css/bootstrap-rtl.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Cairo:300,400&amp;subset=arabic,latin-ext" rel="stylesheet">
    <style type="text/css">
        html,body,alart,h1,h2,h3,h4,h5,h6{
            font-family: 'Cairo', sans-serif;
        }
    </style>

    <link rel="stylesheet" href="{{url('js/select2.min.css')}}">




    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        #myDIV {
            width: 100%;
            padding: 50px 0;
            text-align: center;
            background-color: lightblue;
            margin-top: 20px;
        }
    </style>
</head>

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
    <body>
 
    <a href="{{ url('offers/user/'.$invoices->client_id) }}" class="btn btn-primary no-print">رجوع</a>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header pull-left">
                    <span class=""><img  src="{{url('asst_ar/img/logo.png')}}" style="max-width: 200px; max-height: 100px;" alt="" /></span>
                </h2>
                @if(!isset($req))
                <h2 class="page-header ">
                    <small class="pull-right"><b>{{trans('invoices.invoices_number')}} </b> :  {{$invoices->id}}<br></small>
                </h2>

                    @elseif(isset($offer))
                    <h2 class="page-header ">
                        <small class="pull-right"><b>Offer </b> :  {{$offer->name}}<br></small>
                    </h2>
                @endif
            </div>
            <!-- /.col -->
        </div>


        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                @if(!isset($req))

                <td class="pull-left"> <img  src="{{url('upload/barcode/'.$invoices->barcode)}}" style="max-width: 100px; max-height: 100px;" alt=""/></td>
                @endif
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
                @if(!isset($req))
                <b>{{trans('invoices.date')}} </b>
                @else
                    <b>تاريخ الطلب</b>
                @endif
                :  {{date("Y/m/d",strtotime($invoices->created_at))}}<br>

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
                        <th>صافي الفاتورة</th>
                       
                        
                    </tr>
                    </thead>
                @php
                    $i =0;
                @endphp

                    {{--ITems--}}
                    <tbody>

                    @foreach ($invoiceitems as $key => $invoiceitem)
                        <tr>

                            <td>{{$i+1}}</td>
                            <td>{{@$invoiceitem->items->item_name}}</td>

                            <td>{{@$invoiceitem->Colors->name}}</td>
                           
                           
                               
                            @foreach($billsize as $itemsize)
                                    @if($itemsize->id == $invoiceitem->size)
                                        <td>{!! $itemsize->name !!}</td>
                                    @endif
                                @endforeach

                            <td>{{$invoiceitem->quantity_b}} </td>
                           <td>{{$invoiceitem->price_b}} </td>
                           <td>{{$invoiceitem->total_price_b}} </td>
                        
                             
                         
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach



                    </tbody>

                </table>
            </div>
            <!-- /.col -->
        </div>


        <div class="row">
            <!-- accepted payments column -->

            <!-- /.col -->
            <div class="col-xs-12">
{{--                <p class="lead">{{trans('invoices.date')}}  {{$invoices->date}}</p>--}}

                <div class="table-responsive">
                    <table class="table">
                        <tr>
{{--                            <th>اجمالي سعر الأصناف</th>--}}
{{--                            @if(!$rate )--}}
{{--                            <td>{{round((@$invoices->total_invoice),2)}} {{@$invoices->currencies->currency_name}} </td>--}}
{{--                            @else--}}
{{--                                <td>{{round(($rate->rate*@$invoices->total_invoice),2)}} {{$rate->currencytorate->currency_name}} </td>--}}
{{--                            @endif--}}


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
                            @if(isset($offer))
                            <th>سعر العرض</th>
                            <td><span id="offer">{{$offer->price}}</span></td>
                            @endif
                            <th>عدد العروض</th>
                            @if($invoices->offersCount == null)
                            <td>0</td>
                            @else
                            <td>{{$invoices->offersCount}}</td>
                            @endif
                            <th>صافي الفاتورة بعد الشحن</th>
                            @if($invoices->afterdiscount == null)
                                <td> {{(round((@$invoices->total_invoice),2) - $invoices->discount) + $cities}}</td>
                            @else
                                <td> {{$invoices->afterdiscount}}</td>
                            @endif



                        </tr>


                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a onclick="display()" class="btn btn-default"><i class="fa fa-print"></i> طباعة</a>
            </div>
        </div>
    </body>
        {{-- @if(isset($req))
            <form method="POST" action="{{route('confirmRequest')}}" id="statusform" >
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{$invoices->id}}">
                <button type="submit" class="btn btn-bitbucket btn-flat btn-block"><i class="fa fa-save"></i> تأكيد الطلب</button>
            </form>
            @endif --}}
    </section>
    <script>
        function display() {
            window.print();
        }
    </script>


    <!-- /.content-wrapper -->
    </html>

