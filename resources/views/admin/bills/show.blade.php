@extends('admin.index')
@section('page_title')
    {{trans('عرض الفاتورة')}}
@endsection
@section('content')
    <style>
        @media print {
                    .cprint
                    {
                        display: none;
                    }
            .no-print{
                display: none;
            }
        }
    </style>
    <a href="{{ aurl('bills') }}" class="btn btn-primary no-print">Back</a>
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header pull-left">
                    <span class=""><img  src="{{url('asst_ar/img/logo.png')}}" style="max-width: 200px; max-height: 100px;" alt="" /></span>
                </h2>
                <h2 class="page-header ">
                    <small class="pull-right"><b>{{trans('bills.bill_number')}} </b> :  {{$bills->id}}<br></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>


        <!-- info row -->

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <td class="pull-left"> <img  src="{{url('upload/barcodebills/'.$bills->barcode)}}" style="max-width: 100px; max-height: 100px;" alt=""/></td>
                <br><br><td class="pull-left"><b>{{trans('bills.phone')}}</b> : {{$bills->suppliers->suppliers_number}}<br></td>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>{{trans('admin.username')}}</b> : {{ Auth::guard('admin')->user()->name }}<br>
                
            </div>
            <div class="col-sm-4 invoice-col">
                <b>{{trans('bills.date')}} </b> :  {{date("Y/m/d",strtotime($bills->created_at))}}<br>
                <b>{{trans('bills.supplier_id')}}</b> : {{$bills->suppliers->suppliers_name}}<br>
                <b>{{trans('bills.manager_name')}}</b> : {{$bills->suppliers->manager_name}}<br>
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
                        <th>المواصفة</th>
                        <th>مواصفة 2</th>
                        <th>العدد</th>
                        <th>سعر الافرادي</th>
                        <th>اجمالي</th>

                        {{--<th> مصاريف الشحن</th>--}}
                        {{--<th> التكلفة الجديدة</th>--}}
                        {{--<th>اجمالي</th>--}}

                        {{--<th> الضربية</th>--}}
                        {{--<th> التكلفة الجديدة</th>--}}
                        {{--<th>اجمالي</th>--}}
                    </tr>
                    </thead>
                    @php
                        $i =0;
                    @endphp
                    <!--
                    <tbody>


                  
                    </tbody>
                        -->

                    <tbody>
                    @foreach ($billitems as $key=>$billdevice)
                        <tr>

                            <td>{{$i+1}}</td>
                            <td>{{$billdevice->items->item_name}}</td>
                           
                         
                           
                            
                           
                            <td>{{$billdevice->Colors->name}}</td>
                           
                                @foreach($billsize as $itemsize)
                                    @if($itemsize->id == $billdevice->size)
                                      
                                        <td>{!! $itemsize->name !!}</td>
                                  
                                    @endif
                                @endforeach

                            <td>{{$billdevice->quantity_b}}</td>
                            @if(!$rate)
                            <td>{{round($billdevice->price_b,2)}} </td>
                            @else
                                <td>{{round($rate->rate*$billdevice->price_b,2)}} </td>
                            @endif

                            @if(!$rate)
                            <td>{{round($billdevice->total_price_b,2)}} </td>
                            @else
                            <td>{{round($rate->rate*$billdevice->price_b,2)}}   </td>
                            @endif
                                <!--


                                    @if(!$rate)
                                    <td>{{round( @(($billdevice->price_b * $bills->percentage)/100),2) }} </td>
                                    @else
                                        <td>{{round($rate->rate*((($billdevice->price_b * $bills->percentage)/100)),2)}}  </td>
                                    @endif

                                    @if(!$rate)
                                    <td>{{ @round((($billdevice->price_b * $bills->percentage)/100) + $billdevice->price_b,2)}} </td>
                                    @else
                                        <td>{{round($rate->rate*(@(($billdevice->price_b * $bills->percentage)/100) + $billdevice->price_b),2)}}  </td>
                                    @endif

                                      @if(!$rate)
                                    <td>{{ round(@((($billdevice->price_b * $bills->percentage)/100) + $billdevice->price_b) * $billdevice->quantity_b,2) }} </td>
                                    @else
                                        <td>{{round($rate->rate*(@((($billdevice->price_b * $bills->percentage)/100) + $billdevice->price_b) * $billdevice->quantity_b),2)}}  </td>
                                    @endif

                                    {{--=========================Start Tax======================--}}
                                    @if(empty($bills->total_addtaxs))
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>

                                    @else
                                        @if(!$rate)
                                            <td>{{round( @(($billdevice->price_b * $bills->percentageTax)/100),2) }} </td>
                                        @else
                                            <td>{{round($rate->rate*((($billdevice->price_b * $bills->percentageTax)/100)),2)}}  </td>
                                        @endif

                                        @if(!$rate)
                                            <td>{{ @round((($billdevice->price_b * $bills->percentageTax)/100) + $billdevice->price_b,2)}} </td>
                                        @else
                                            <td>{{round($rate->rate*(@(($billdevice->price_b * $bills->percentageTax)/100) + $billdevice->price_b),2)}}  </td>
                                        @endif

                                        @if(!$rate)
                                            <td>{{round(@((($billdevice->price_b * $bills->percentageTax)/100) + $billdevice->price_b) * $billdevice->quantity_b ,2) }} </td>
                                        @else
                                            <td>{{round($rate->rate*(@((($billdevice->price_b * $bills->percentageTax)/100) + $billdevice->price_b) * $billdevice->quantity_b),2)}}  </td>
                                        @endif
                                    @endif
                                    {{--=========================End Tax======================--}}
                                </tr>

                        -->
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

            <!-- /.col -->
            <div class="col-xs-12">

                <div class="table-responsive">
                    <table class="table">
                      {{--<tr class="cprint">--}}
                          {{--<th class="cprint">العملة</th>--}}
                          {{--<td >--}}
                              {{--<select class="" name="item_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">--}}
                                  {{--<option value="{{url("/admin/bills/show/$bills->id")}}">-----عملة الفاتورة  ----</option>--}}
                                  {{--@foreach ($currencies as $currency )--}}
                                      {{--<option value="{{url("/admin/bills/show/$bills->id/$bills->currency_id/$currency->id")}}"--}}
                                          {{--@if(isset($rate) && $currency->id == $rate->to_currency_id) selected @endif--}}
                                        {{-->--}}
                                        {{--{{$currency->currency_name}}--}}
                                      {{--</option>--}}
                                  {{--@endforeach--}}
                              {{--</select>--}}
                          {{--</td>--}}
                      {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th style="width:50%"> اجمالي المواد</th>--}}
                              {{--@if(!$rate)--}}
                            {{--<td>{{@$bills->total_final_mgza }} {{@$bills->currency->currency_name}} </td>--}}
                            {{--@else--}}
                                {{--<td>{{$rate->rate*@$bills->total_final_mgza}} {{$rate->currencytorate->currency_name}} </td>--}}
                            {{--@endif--}}

                        {{--</tr>--}}
                        {{--<tr>--}}

                            {{--<th>اجمالي الاجهزة</th>--}}
                            {{--@if(!$rate)--}}
                            {{--<td>{{@$bills->total_final_mogma3}} {{@$bills->currency->currency_name}} </td>--}}
                            {{--@else--}}
                                {{--<td>{{$rate->rate*@$bills->total_final_mogma3}} {{$rate->currencytorate->currency_name}} </td>--}}
                            {{--@endif--}}
                        {{--</tr>--}}
                        <tr>
                            <th>اجمالي سعر الأصناف</th>
                            <td> {{$bills->total_final_bill}}</td>



                            <th>صافي الفاتورة</th>
                                <td> {{$bills->afterdiscount}}</td>
                            </tr>

                        {{--<tr>--}}
                            {{--<th> مصاريف الشحن</th>--}}
                            {{--@if($bills->total_shipments != null)--}}
                                {{--@if(!$rate)--}}
                                    {{--<td>{{round((@$bills->total_shipments),2)}}  {{@$bills->currency->currency_name}}</td>--}}
                                {{--@else--}}
                                    {{--<td>{{round(($rate->rate*(@$bills->total_shipments)),2)}} {{$rate->currencytorate->currency_name}} </td>--}}
                                {{--@endif--}}
                            {{--@else--}}
                                {{--<td>لم تتم إضافة مصاريف</td>--}}
                            {{--@endif--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th> الضربية</th>--}}
                            {{--@if($bills->total_addtaxs != null)--}}
                                {{--@if(!$rate)--}}
                                    {{--<td>{{round((@$bills->total_addtaxs),2)}}  {{@$bills->currency->currency_name}}</td>--}}
                                {{--@else--}}
                                    {{--<td>{{round(($rate->rate*(@$bills->total_addtaxs)),2)}} {{$rate->currencytorate->currency_name}} </td>--}}
                                {{--@endif--}}
                            {{--@else--}}
                                {{--<td>لم تتم إضافة الضربية</td>--}}
                            {{--@endif--}}
                        {{--</tr>--}}


                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="#"onclick="display()"  class="btn btn-default"><i class="fa fa-print"></i> طباعة</a>
            </div>
        </div>
    </section>
    <script>
        function display() {
            window.print();
        }
    </script>

    <!-- /.content -->
    <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->

@endsection
