@extends('admin.index')
@section('page_title')
    {{trans('تقرير قيمة المخزن')}}
@endsection
@section('content')
@php
@$total=0;
@$total1=0;
@endphp
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('تقرير قيمة المخزن')}} </h3>
            <br><br>
            <h3 class="box-title">{{trans('اسم المادة')}} : {{@$item->item_name}}</h3>
        </div>
        <div class="box-header">

            <div class="col-md-5">
                <select name="city_id" class="form-control py-2 w-100 select2" required onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <option value=""> برجاء اختيار اسم المادة</option>
                    @foreach($items as $itt)
                        <option value="{{$itt->id}}" @if( $itt->id == $id) selected @endif>{{$itt->item_name}}</option>
                    @endforeach
                </select>
            </div>
            {{--<div class="col-md-5">--}}
                {{--<select class="" name="item_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">--}}

                    {{--@foreach($items as $itt)--}}
                    {{--@foreach ($currencies as $currency )--}}
                        {{--<option value="{{url("/admin/report/store/$itt->id/$itt->currency_id/$currency->id")}}"--}}
                                {{--@if(isset($rate) && $currency->id == $rate->to_currency_id) selected @endif--}}
                        {{-->--}}
                            {{--{{$currency->currency_name}}--}}
                        {{--</option>--}}
                    {{--@endforeach--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}


        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>
                    <th colspan="2">{{ trans('شراء')}}</th>
                </tr>
                </thead>
                <thead>
                <th>{{ trans('كمية')}}</th>
                <th>{{ trans('اخر سعر شراء')}}</th>
                {{--<th>{{ trans('اخر تكليف')}}</th>--}}
                <th>{{ trans('إجمالي')}}</th>


                @if(@$item)


                        @foreach(@$item->billitems as $Key=>$billitem)
                            @php
                                @$bills                  = \App\Model\Bills::with('suppliers','currency')->find($billitem->bill_id);
                                @$bills['percentage']    = round(($bills['total_shipments'] * 100 ) / $bills['total_final_bill'] ,2);//new
                                @$bills['percentageTax'] = round(( ($bills['total_shipments'] - $bills['total_addtaxs']) * 100) / $bills['total_final_bill'] ,2);//new
                            @$total = $total+$billitem->total_price_b_egy;
                            @endphp


                            <tr>
                                <td>{{$billitem->quantity_b}}</td>
                                <td>{{@$billitem->price_b}}</td>
                                {{--@if(empty($bills->percentageTax) )--}}
                                    {{--<td>{{@round((($billitem->price_b_egy * $bills->percentage)/100) + $billitem->price_b_egy,2)}} </td>--}}
                                {{--@else--}}
                                    {{--<td>{{@round((($billitem->price_b_egy * $bills->percentageTax)/100) + $billitem->price_b_egy,2)}} </td>--}}
                                {{--@endif--}}
                                <td>{{$billitem->total_price_b_egy}}</td>

                                </tr>

                        @endforeach




                    @if(!empty(@$item->Billdevicesitems))
                            @foreach(@$item->Billdevicesitems as $billdevicesitem)
                                @php
                                    @$bills                  = \App\Model\Bills::with('suppliers','currency')->find($billdevicesitem->bill_id);
                                    @$bills['percentage']    = round(($bills['total_shipments'] * 100 ) / $bills['total_final_bill'] ,2);//new
                                    @$bills['percentageTax'] = round(( ($bills['total_shipments'] - $bills['total_addtaxs']) * 100) / $bills['total_final_bill'] ,2);//new
                                      
                                @endphp
                                <tr>
                                    <td>{{$billdevicesitem->quantity_devices}}</td>
                                    <td>{{$billdevicesitem->price_devices_egy}}</td>
                                    {{--@if(empty($bills->percentageTax))--}}
                                        {{--<td>{{@round((($billdevicesitem->price_b_egy * $bills->percentage)/100) + $billdevicesitem->price_b_egy,2)}} </td>--}}
                                    {{--@else--}}
                                        {{--<td>{{@round((($billdevicesitem->price_b_egy * $bills->percentageTax)/100) + $billdevicesitem->price_b_egy,2)}} </td>--}}
                                    {{--@endif--}}
                                    <td>{{$billdevicesitem->total_devices_egy}}</td>
                                </tr>
                        @endforeach
                    @else
<tr>
                        <td></td>
                        <td></td>
                        <td></td>
</tr>
                    @endif




                    {{--@endforeach--}}
                @else
                    <tr>
                        <td class="center" colspan="9">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td><span class="label label-success">{{@$sumBills}}</span></td>
                    <td><span class="label label-success">{{$sumBillsprice}}</span></td>
                   
                    <td><span class="label label-success">{{@$total}}</span></td>


                </tr>
                </thead>
                <thead>
                <tr>
                    <th colspan="2" style="color: red">{{ trans('بيع')}}</th>
                </tr>
                </thead>
                <thead>
                <th>{{ trans('كمية')}}</th>
                <th>اخر سعر بيع</th>
                {{--<th>{{ trans('اخر تكليف')}}</th>--}}
                <th>{{ trans('إجمالي')}}</th>


                @if($item)


                    @foreach(@$item->Invoiceitems as $Key => $billitem)
                           @php
                            @$total1 = $total1 +   $billitem->total_price_b;
                            @endphp
                        <tr>
                            <td>{{$billitem->quantity_b}}</td>
                            <td>{{@$billitem->price_b}}</td>
                            {{--<td>#</td>--}}
                            <td>{{$billitem->total_price_b}}</td>

                        </tr>

                    @endforeach




                    @if(!empty(@$item->Invoicedeviceitems))
                        @foreach(@$item->Invoicedeviceitems as $vInvoice)
                            <tr>
                                <td>{{$vInvoice->quantity_devices}}</td>
                                <td>{{$vInvoice->price_devices}}</td>
                                {{--<td>#</td>--}}
                                <td>{{$vInvoice->total_devices}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif




                    {{--@endforeach--}}
                @else
                    <tr>
                        <td class="center" colspan="9">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td><span class="label label-success">{{@$sumInvoice}}</span></td>
                    <td><span class="label label-success">{{@$sumInvoiceprice}}</span></td>
                    {{--<td>#</td>--}}
                    <td><span class="label label-success">{{@$total1}}</span></td>
                </tr>
                <tr>


                    <td><span class="label label-warning">{{@$Total = $sumBills - $sumInvoice}}</span></td>
                    <td><span class=" ">#</span></td>
                    {{--<td><span class=" ">#</span></td>--}}
                    <td><span class=" ">#</span></td>

                </tr>
                </thead>



            </table>
            <br>
            {{--@if($items->count()>0)--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$items->total()}} </div>--}}

                    {{--<div class="col-md-7 col-sm-7"> {{ $items->appends(\Request::except('_token'))->render() }}</div>--}}
                {{--</div>--}}
            {{--@endif--}}
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->


    <!-- Trigger the modal with a button -->






@endsection