@extends('admin.index')
@section('page_title')
    {{trans('عرض الفاتورة بيع')}}
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
    <a href="{{ aurl('returned_invoices') }}" class="btn btn-primary no-print">Back</a>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header pull-left">
                    <i class="fa fa-globe pull-left "></i><span class="">LinahSol</span>
                </h2>
                <h2 class="page-header ">
                    <small class="pull-right"></small>.
                </h2>
            </div>
            <!-- /.col -->
        </div>


        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
{{--                <b>{{trans('returneditems.invoices_number')}} #{{$invoices->invoice_number}}</b><br>--}}
                <br>
                <b>{{trans('returneditems.date')}} </b> :  {{$invoices->date}}<br>
                <b>{{trans('returneditems.invoice_source')}} </b> :  {{@$invoices->invoiceSource->name}}<br>
                <b>{{trans('returneditems.city')}}</b> : {{$invoices->city}}<br>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>{{trans('returneditems.client_id')}}</b> : {{$invoices->clients->name_client}}<br>
                <b>{{trans('returneditems.phone')}}</b> : {{$invoices->clients->phone}}<br>
                <b>{{trans('returneditems.address')}}</b> : {{$invoices->clients->city}}<br>
                <br>
                <b> {{trans('returneditems.notes')}} </b>:  {{$invoices->notes}}<br>
            </div>
            <div class="col-sm-4 invoice-col">
                {{--<b> العملة </b>:  {{@$invoices->currencies->currency_name}}<br>--}}
                <b>{{trans('returneditems.status')}}</b> :
                @if($invoices->status_id == 1 )
                    <span style="color: green;font-weight: bold">{{trans('returneditems.notreturned')}}</span>
                @else
                    <span style="color: red;font-weight: bold">{{trans('returneditems.returned')}}</span>
                @endif
                <br>
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
                        <th>الاسم</th>
                        <th>كمية</th>
                        <th>سعر الافرادي</th>
                        <th>اجمالي</th>

                    </tr>
                    </thead>
{{--Device--}}
                    <tbody>
@php
    $i =0;
@endphp
                    @foreach ($invoicedevices as $key=>$invoicedevice)



                        <tr>
                            <td>{{$i+1}}</td>

                            <td>{{@$invoicedevice->devices->devices_name}}</td>
                            <td>{{$invoicedevice->quantity}}</td>
                            @if(!$rate )
                                <td>{{round(($invoicedevice->onedevice),2)}} </td>
                            @else
                                <td>{{round(($rate->rate*@$invoicedevice->onedevice),2)}} </td>
                            @endif


                            @if(!$rate )
                                <td>{{round(($invoicedevice->total_price),2)}} </td>
                            @else
                                <td>{{round(($rate->rate*@$invoicedevice->total_price),2)}} </td>
                            @endif
                        </tr>

                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>
                    {{--ITems--}}
                    <tbody>

                    @foreach ($invoiceitems as $key => $invoiceitem)
                        <tr>

                            <td>{{$i+1}}</td>
                            <td>{{@$invoiceitem->items->item_name}}</td>
                            <td>{{$invoiceitem->quantity_b}}</td>
                              @if(!$rate )
                            <td>{{round(($invoiceitem->price_b),2)}} </td>
                            @else
                                <td>{{round(($rate->rate*@$invoiceitem->price_b),2)}} </td>
                            @endif

                              @if(!$rate )
                            <td>{{round(($invoiceitem->total_price_b),2)}} </td>
                            @else
                                <td>{{round(($rate->rate*@$invoiceitem->total_price_b),2)}} </td>
                            @endif

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
    {{--row--}}

    <!-- Table Devices row -->


    {{--row--}}

    <!-- Table Devices row -->



        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">

            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">{{trans('returneditems.date')}}  {{$invoices->date}}</p>

                <div class="table-responsive">
                    <table class="table">
                      <tr class="no-print">
                          {{--<th class="no-print">العملة</th>--}}
                          {{--<td >--}}
                              {{--<select class="" name="item_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">--}}
                                  {{--<option value="{{url("/admin/invoices/show/$invoices->id")}}">-----اختيار العملة  ----</option>--}}
                                  {{--@foreach ($currencies as $currency )--}}
                                      {{--<option value="{{url("/admin/invoices/show/$invoices->id/$invoices->currency_id/$currency->id")}}"--}}
                                          {{--@if(isset($rate) && $currency->id == $rate->to_currency_id) selected @endif--}}
                                        {{-->--}}
                                        {{--{{$currency->currency_name}}--}}
                                      {{--</option>--}}
                                  {{--@endforeach--}}
                              {{--</select>--}}
                          {{--</td>--}}
                      </tr>
                        {{--<tr>--}}
                            {{--<th style="width:50%">اجمالي ال </th>--}}
                            {{--@if(!$rate )--}}
                            {{--<td>{{@$invoices->total_final_mgza}} {{@$invoices->currencies->currency_name}}</td>--}}
                            {{--@else--}}
                                {{--<td>{{$rate->rate*@$invoices->total_final_mgza}} {{$rate->currencytorate->currency_name}} </td>--}}
                            {{--@endif--}}

                        {{--</tr>--}}
                        {{--<tr>--}}

                            {{--<th>اجمالي المجمع</th>--}}
                            {{--@if(!$rate )--}}
                            {{--<td>{{@$invoices->total_final_mogma3}} {{@$invoices->currencies->currency_name}} </td>--}}
                            {{--@else--}}
                                {{--<td>{{$rate->rate*@$invoices->total_final_mogma3}} {{$rate->currencytorate->currency_name}} </td>--}}
                            {{--@endif--}}
                        {{--</tr>--}}

                        <tr>
                            <th>اجمالي الفاتورة</th>
                            @if(!$rate )
                            <td>{{round((@$invoices->total_invoice),2)}} {{@$invoices->currencies->currency_name}} </td>
                            @else
                                <td>{{round(($rate->rate*@$invoices->total_invoice),2)}} {{$rate->currencytorate->currency_name}} </td>
                            @endif
                        </tr>

                        {{--<tr>--}}
                            {{--<th>اجمالي الفاتورة مع الضريبة</th>--}}
                            {{--@if($invoices->taxes)--}}
                                {{--@if(!$rate )--}}
                                    {{--<td>{{round((@$invoices->taxes),2)}} {{@$invoices->currencies->currency_name}} </td>--}}
                                {{--@else--}}
                                    {{--<td>{{round(($rate->rate*@$invoices->taxes),2)}} {{$rate->currencytorate->currency_name}} </td>--}}
                                {{--@endif--}}
                            {{--@else--}}
                                {{--<td>لم يتم اضافة ضريبة</td>--}}
                            {{--@endif--}}
                        {{--</tr>--}}

                        <tr>
                            {{--{{dd($invoices->total_invoice)}}--}}
                            {{--<th>اجمالي الفاتورة باإضافة مصاريف الشحن</th>--}}
                            {{--@if(!$rate )--}}
                            {{--<td>{{@$z=$invoices->total_final_mgza+$invoices->total_final_mogma3+$invoices->total_shipments}} {{@$invoices->currencies->currency_name}} </td>--}}
                            {{--@else--}}
                                {{--<td>{{$rate->rate*(@$z=$invoices->total_final_mgza+$invoices->total_final_mogma3+$invoices->total_shipments)}} {{$rate->currencytorate->currency_name}} </td>--}}
                            {{--@endif--}}
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
                <a onclick="myFunction()" class="btn btn-default"><i class="fa fa-print"></i> طباعة</a>
            </div>
        </div>
    </section>
    <script>
        function myFunction() {
            window.print();
        }
    </script>

    <!-- /.content -->
    <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->

@endsection
