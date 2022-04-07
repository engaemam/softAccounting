@extends('admin.index')
@section('page_title')
    {{trans('عرض الاستيراد')}}
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
    <a href="{{ URL::previous() }}" class="btn btn-primary no-print">Back</a>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header pull-left">
                    <i class="fa fa-globe pull-left "></i><span class="">LinahSol</span>
                </h2>
                <h2 class="page-header ">
                    <small class="pull-right">{{$imports->date}}</small>.
                </h2>
            </div>
            <!-- /.col -->
        </div>


        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <b>{{trans('imports.number')}} #{{$imports->number}}</b><br>
                <br>
                <b>{{trans('imports.date')}} </b> :  {{$imports->date}}<br>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>{{trans('imports.supplier_id')}}</b> : {{$imports->suppliers->suppliers_name}}<br>
                <br>
                <b> {{trans('imports.notes')}} </b>:  {{$imports->notes}}<br>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>{{trans('imports.price_before_doller')}}</b> : {{$imports->price_doller}}<br>
                <br>
                <b> العملة </b> : {{@$imports->currency->currency_name}}   <br>
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
                    </tr>

                    </thead>
                    @php
                        $i =0;
                    @endphp
                    <tbody>
                    @foreach ($importdevices as $key => $importdevice)

                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$importdevice->devices->devices_name}}</td>
                            <td>{{$importdevice->quantity}}</td>

                            @if(!$rate )
                                <td>{{round($importdevice->onedevices,2)}}  </td>
                            @else
                                <td>{{round($rate->rate * @$importdevice->onedevices ,2) }} </td>
                            @endif

                            @if(!$rate )
                                <td>{{round($importdevice->total_price,2) }}  </td>
                            @else
                                <td>{{round($rate->rate * @$importdevice->total_price,2)  }} </td>
                            @endif


                            @if(!$rate )
                                <td>{{round(@(($importdevice->onedevices * $imports->percentage)/100),2)  }} </td>
                            @else
                                <td>{{round($rate->rate * (@(($importdevice->onedevices * $imports->percentage)/100)),2)  }} </td>
                            @endif

                            @if(!$rate )
                                <td>{{round(@(($importdevice->onedevices * $imports->percentage)/100) + $importdevice->onedevices,2) }} </td>
                            @else
                                <td>{{round($rate->rate * (@(($importdevice->onedevices * $imports->percentage)/100) + $importdevice->onedevices),2)  }} </td>
                            @endif
                            @if(!$rate )
                                <td>{{round(@((($importdevice->onedevices * $imports->percentage)/100) + $importdevice->onedevices) * $importdevice->quantity,2)  }} </td>
                            @else
                                <td>{{round($rate->rate * (@((($importdevice->onedevices * $imports->percentage)/100) + $importdevice->onedevices) * $importdevice->quantity),2)  }} </td>
                            @endif

                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>

                    <tbody>

                    @foreach ($importitems as $key=>$importitem)
                        <tr>

                            <td>{{$i+1}}</td>
                            <td>{{$importitem->items->item_name}}</td>
                            <td>{{$importitem->quantity_b}}</td>
                              @if(!$rate )
                            <td>{{round($importitem->price_b,2)}} </td>
                            @else
                                <td>{{round($rate->rate * @$importitem->price_b,2) }} </td>
                            @endif

                            @if(!$rate )
                            <td>{{round($importitem->total_price_b,2)}} </td>
                            @else
                                <td>{{round($rate->rate * @$importitem->total_price_b,2) }} </td>
                            @endif

                              @if(!$rate )
                            <td>{{round(@(($importitem->price_b * $imports->percentage)/100),2)  }} </td>
                            @else
                                <td>{{round($rate->rate * (@(($importitem->price_b * $imports->percentage)/100)),2) }} </td>
                            @endif
                            @if(!$rate )
                            <td>{{round(@(($importitem->price_b * $imports->percentage)/100) + $importitem->price_b,2) }} </td>
                            @else
                                <td>{{round($rate->rate * (@(($importitem->price_b * $imports->percentage)/100) + $importitem->price_b),2) }} </td>
                            @endif
                              @if(!$rate )
                            <td>{{round(@((($importitem->price_b * $imports->percentage)/100) + $importitem->price_b) * $importitem->quantity_b,2)  }} </td>
                            @else
                                <td>{{round($rate->rate * (@((($importitem->price_b * $imports->percentage)/100) + $importitem->price_b) * $importitem->quantity_b),2) }} </td>
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
                <p class="lead">{{trans('imports.date')}}  {{$imports->date}}</p>

                <div class="table-responsive">
                    <table class="table">
                      <tr class="cprint">
                          <th class="cprint">العملة</th>
                          <td >
                              <select class="" name="item_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                  <option value="{{url("/admin/imports/show/$imports->id")}}">-----اختيار العملة  ----</option>
                                  @foreach ($currencies as $currency )
                                        <option value="{{url("/admin/imports/show/$imports->id/$imports->currency_id/$currency->id")}}"
                                          @if(isset($rate) && $currency->id == $rate->to_currency_id) selected @endif
                                        >
                                        {{$currency->currency_name}}
                                      </option>
                                  @endforeach
                              </select>
                          </td>
                      </tr>

                        {{--<tr>--}}
                            {{--<th style="width:50%">اجمالي ال </th>--}}
                            {{--@if(!$rate )--}}
                            {{--<td>{{@$imports->total_final_mgza}} {{@$imports->currency->currency_name}} </td>--}}
                            {{--@else--}}
                                {{--<td>{{$rate->rate * @$imports->total_final_mgza }} {{$rate->currencytorate->currency_name}}</td>--}}
                            {{--@endif--}}
                        {{--</tr>--}}
                        {{--<tr>--}}

                            {{--<th>اجمالي المجمع</th>--}}
                            {{--@if(!$rate )--}}
                            {{--<td>{{@$imports->total_final_mogma3}} {{@$imports->currency->currency_name}} </td>--}}
                            {{--@else--}}
                                {{--<td>{{$rate->rate * @$imports->total_final_mogma3 }} {{$rate->currencytorate->currency_name}}</td>--}}
                            {{--@endif--}}
                        {{--</tr>--}}

                        <tr>
                            <th>اجمالي الفاتورة</th>
                            @if(!$rate )
                            <td>{{@round($imports->total_final,2)}} {{@$imports->currency->currency_name}} </td>
                            @else
                                <td>{{round($rate->rate * @$imports->total_final ,2)}} {{$rate->currencytorate->currency_name}}</td>
                            @endif
                        </tr>

                        <tr>
                            <th>اجمالي الفاتورة باإضافة مصاريف الاستيراد</th>
                              @if(!$rate )
                            <td>{{$z  =  round($imports->total_final+$imports->total_import,2)}} {{@$imports->currency->currency_name}} </td>
                            @else
                                <td>{{round($rate->rate * ($imports->total_final+$imports->total_import) ,2)}} {{$rate->currencytorate->currency_name}}</td>
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
