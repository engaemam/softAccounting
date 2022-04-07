@extends('admin.index')
@section('page_title')
    {{trans('عرض الفاتورة بالدينار العراقي')}}
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
                    <i class="fa fa-globe pull-left "></i><span class="">LinahSol</span>
                </h2>
                <h2 class="page-header ">
                    <small class="pull-right">{{$bills->date}}</small>.
                </h2>
            </div>
            <!-- /.col -->
        </div>


        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
{{--                <b>{{trans('bills.bill_number')}} #{{$bills->bill_number}}</b><br>--}}
                <br>
                <b>{{trans('bills.date')}} </b> :  {{$bills->date}}<br>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>{{trans('bills.supplier_id')}}</b> : {{$bills->suppliers->suppliers_name}}<br>
                <br>
                <b> {{trans('bills.notes')}} </b>:  {{$bills->notes}}<br>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>{{trans('bills.price_before_doller')}}</b> : {{$bills->price_before_doller}}<br>
                <br>
                <b> العملة </b>: {{@$bills->currency->currency_name}}  <br>
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
                        <th> مصاريف الشحن</th>
                        <th> التكلفة الجديدة</th>
                        <th>اجمالي</th>

                        <th> الضربية</th>
                        <th> التكلفة الجديدة</th>
                        <th>اجمالي</th>
                    </tr>
                    </thead>
                    @php
                        $i =0;
                    @endphp
                    <tbody>


                    @foreach ($billdevies as $key=>$billdevice)



                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$billdevice->devices->devices_name}}</td>
                            <td>{{$billdevice->quantity}}</td>
                            @if(!$rate)
                                <td>{{round($billdevice->onedevices_egy,2)}} </td>
                            @else
                                <td>{{round($rate->rate*$billdevice->onedevices_egy,2)}}  </td>
                            @endif

                            @if(!$rate)
                                <td>{{round($billdevice->total_price_egy,2)}} </td>
                            @else
                                <td>{{round($rate->rate*$billdevice->total_price_egy,2)}}  </td>
                            @endif
                        <!--  مصاريف الشحن-->

                            @if(!$rate)
                                <td>{{round(@(($billdevice->onedevices_egy * $bills->percentage)/100),2)  }} </td>
                            @else
                                <td>{{round($rate->rate*((($billdevice->onedevices_egy * $bills->percentage)/100)),2)}}  </td>
                            @endif
                        <!--  مصاريف الشحن-->
                            {{--التكلفة الجديدة--}}
                            @if(!$rate)
                                <td>{{ round(@(($billdevice->onedevices_egy * $bills->percentage)/100) + $billdevice->onedevices_egy,2)}} </td>
                            @else
                                <td>{{round($rate->rate*(@(($billdevice->onedevices_egy * $bills->percentage)/100) + $billdevice->onedevices_egy),2)}}  </td>
                            @endif
                            {{--التكلفة الجديدة--}}

                            {{--اجمالي--}}
                            @if(!$rate)
                                <td>{{round(@((($billdevice->onedevices_egy * $bills->percentage)/100) + $billdevice->onedevices_egy) * $billdevice->quantity,2)  }} </td>
                            @else
                                <td>{{round($rate->rate*(@((($billdevice->onedevices_egy * $bills->percentage)/100) + $billdevice->onedevices_egy) * $billdevice->quantity),2)}}  </td>
                            @endif
                            {{--اجمالي--}}

                            {{--=============================Start Tax=================================--}}

                        <!--  مصاريف الشحن-->
                            @if(empty($bills->total_addtaxs_egy))
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>

                            @else
                                @if(!$rate)
                                    <td>{{round(@(($billdevice->onedevices_egy * $bills->percentageTax)/100),2)  }} </td>
                                @else
                                    <td>{{round($rate->rate*((($billdevice->onedevices_egy * $bills->percentageTax)/100)),2)}}  </td>
                                @endif
                            <!--  مصاريف الشحن-->
                                {{--التكلفة الجديدة--}}
                                @if(!$rate)
                                    <td>{{ round(@(($billdevice->onedevices_egy * $bills->percentageTax)/100) + $billdevice->onedevices_egy,2)}} </td>
                                        
                                @else
                                    <td>{{round($rate->rate*(@(($billdevice->onedevices_egy * $bills->percentageTax)/100) + $billdevice->onedevices_egy),2)}}  </td>
                                @endif
                                {{--التكلفة الجديدة--}}

                                {{--اجمالي--}}
                                @if(!$rate)
                                    <td>{{ round(@((($billdevice->onedevices_egy * $bills->percentageTax)/100) + $billdevice->onedevices_egy) * $billdevice->quantity,2) }} </td>
                                @else
                                    <td>{{round($rate->rate*(@((($billdevice->onedevices_egy * $bills->percentageTax)/100) + $billdevice->onedevices_egy) * $billdevice->quantity),2)}}  </td>
                                @endif
                            @endif
                            {{--اجمالي--}}
                            {{--=============================END Tax=================================--}}
                        </tr>

                        @php
                            $i++;
                        @endphp

                    @endforeach
                    </tbody>
                    <tbody>

                    @foreach ($billitems as $key=>$billdevice)
                        <tr>

                            <td>{{$i+1}}</td>
                            <td>{{$billdevice->items->item_name}}</td>
                            <td>{{$billdevice->quantity_b}}</td>

                            @if(!$rate)
                            <td>{{round($billdevice->price_b_egy,2)}} </td>
                            @else
                                <td>{{round($rate->rate*$billdevice->price_b_egy,2)}} </td>
                            @endif

                            @if(!$rate)
                            <td>{{round($billdevice->total_price_b_egy,2)}} </td>
                            @else
                                <td>{{round($rate->rate*$billdevice->total_price_b_egy,2)}}  </td>
                            @endif

                            @if(!$rate)
                            <td>{{round( @(($billdevice->price_b_egy * $bills->percentage)/100),2) }} </td>
                            @else
                                <td>{{round($rate->rate*((($billdevice->price_b_egy * $bills->percentage)/100)),2)}}  </td>
                            @endif

                            @if(!$rate)
                            <td>{{ @round((($billdevice->price_b_egy * $bills->percentage)/100) + $billdevice->price_b_egy,2)}} </td>
                            @else
                                <td>{{round($rate->rate*(@(($billdevice->price_b_egy * $bills->percentage)/100) + $billdevice->price_b_egy),2)}}  </td>
                            @endif

                              @if(!$rate)
                            <td>{{ round(@((($billdevice->price_b_egy * $bills->percentage)/100) + $billdevice->price_b_egy) * $billdevice->quantity_b,2) }} </td>
                            @else
                                <td>{{round($rate->rate*(@((($billdevice->price_b_egy * $bills->percentage)/100) + $billdevice->price_b_egy) * $billdevice->quantity_b),2)}}  </td>
                            @endif

                            {{--=========================Start Tax======================--}}
                            @if(empty($bills->total_addtaxs_egy))
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>

                            @else
                                @if(!$rate)
                                    <td>{{round( @(($billdevice->price_b_egy * $bills->percentageTax)/100),2) }} </td>
                                @else
                                    <td>{{round($rate->rate*((($billdevice->price_b_egy * $bills->percentageTax)/100)),2)}}  </td>
                                @endif

                                @if(!$rate)
                                    <td>{{ @round((($billdevice->price_b_egy * $bills->percentageTax)/100) + $billdevice->price_b_egy,2)}} </td>
                                @else
                                    <td>{{round($rate->rate*(@(($billdevice->price_b_egy * $bills->percentageTax)/100) + $billdevice->price_b_egy),2)}}  </td>
                                @endif

                                @if(!$rate)
                                    <td>{{round(@((($billdevice->price_b_egy * $bills->percentageTax)/100) + $billdevice->price_b_egy) * $billdevice->quantity_b ,2) }} </td>
                                @else
                                    <td>{{round($rate->rate*(@((($billdevice->price_b_egy * $bills->percentageTax)/100) + $billdevice->price_b_egy) * $billdevice->quantity_b),2)}}  </td>
                                @endif
                            @endif
                            {{--=========================End Tax======================--}}
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
                <p class="lead">{{trans('bills.date')}}  {{$bills->date}}</p>

                <div class="table-responsive">
                    <table class="table">
                      <tr class="cprint">
                          <th class="cprint">العملة</th>
                          <td >
                              <select class="" name="item_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                  <option value="{{url("/admin/bills/egyptshow/$bills->id")}}">-----عملة الفاتورة بالدينار العراقي  ----</option>
                                  @foreach ($currencies as $currency )
                                      <option value="{{url("/admin/bills/show/$bills->id/$bills->currency_id/$currency->id")}}"
                                          @if(isset($rate) && $currency->id == $rate->to_currency_id) selected @endif
                                        >
                                        {{$currency->currency_name}}
                                      </option>
                                  @endforeach
                              </select>
                          </td>
                      </tr>
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
                            <th>اجمالي </th>
                            @if(!$rate)
                            <td>{{round((@$bills->total_final_bill_egy),2)}} {{trans('EGY')}} </td>
                            @else
                                <td>{{round(($rate->rate*$bills->total_final_bill_egy),2)}} {{$rate->currencytorate->currency_name}} </td>
                            @endif
                        </tr>
                        <tr>
                            <th> مصاريف الشحن</th>
                            @if($bills->total_shipments_egy != null)
                                @if(!$rate)
                                    <td>{{round((@$bills->total_shipments_egy),2)}}  {{trans('EGY')}}</td>
                                @else
                                    <td>{{round(($rate->rate*(@$bills->total_shipments_egy)),2)}} {{$rate->currencytorate->currency_name}} </td>
                                @endif
                            @else
                                <td>لم تتم إضافة مصاريف</td>
                            @endif
                        </tr>
                        <tr>
                            <th> الضربية</th>
                            @if($bills->total_addtaxs_egy != null)
                                @if(!$rate)
                                    <td>{{round((@$bills->total_addtaxs_egy),2)}}  {{trans('EGY')}}</td>
                                @else
                                    <td>{{round(($rate->rate*(@$bills->total_addtaxs_egy)),2)}} {{$rate->currencytorate->currency_name}} </td>
                                @endif
                            @else
                                <td>لم تتم إضافة الضربية</td>
                            @endif
                        </tr>

                        <tr>
                            <th>اجمالي الفاتورة </th>
                            @if(!$rate)
                            <td>{{round((@$bills->total_final_bill_egy+($bills->total_shipments_egy-$bills->total_addtaxs_egy)),2)}}  {{trans('EGY')}}</td>
                            @else
                                <td>{{round(($rate->rate*($bills->total_final_bill_egy+($bills->total_shipments_egy-$bills->total_addtaxs_egy))),2)}} {{$rate->currencytorate->currency_name}} </td>
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
                <a href="#"onclick="myFunction()"  class="btn btn-default"><i class="fa fa-print"></i> طباعة</a>
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
