@extends('admin.index')
@section('page_title')
    {{trans('report.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('تقرير المواد')}} </h3>
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
                <th>{{ trans('رقم الفاتورة شراء')}}</th>
                <th>{{ trans('اسم المورد')}}</th>
                <th>{{ trans('الكمية')}}</th>


                @if(@$item)


                        @foreach(@$item->billitems as $Key=>$billitem)
                            <tr>
                                <td><a href="{{aurl('bills/show/'.$billitem->bill_id)}}">{{$billitem->bills->id}}</a></td>
                                <td>{{@$billitem->bills->suppliers->suppliers_name}}</td>
                                <td>{{$billitem->quantity_b}}</td>

                                </tr>

                        @endforeach




                    @if(!empty(@$item->Billdevicesitems))
                            @foreach(@$item->Billdevicesitems as $billdevicesitem)
                                <tr>
                                    <td><a href="{{aurl('bills/show/'.$billdevicesitem->bill_id)}}">{{$billdevicesitem->bills->bill_number}}</a></td>
                                    <td>{{@$billitem->bills->suppliers->suppliers_name}}</td>
                                    <td>{{$billdevicesitem->quantity_devices}}</td>
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
                    <td><span class="label label-success">مجموع</span></td>
<td></td>
                    <td><span class="label label-success">{{@$sumBills}}</span></td>

                </tr>
                </thead>
                <thead>
                <tr>
                    <th colspan="2" style="color: red">{{ trans('بيع')}}</th>
                </tr>
                </thead>
                <thead>
                <th>{{ trans('رقم الفاتورة بيع')}}</th>
                <th>{{ trans('اسم الزبون')}}</th>
                <th>{{ trans('الكمية')}}</th>


                @if($item)


                    @foreach(@$item->Invoiceitems as $Key => $billitem)
                        <tr>
                            <td><a href="{{aurl('invoices/show/'.$billitem->invoice_id)}}">{{@$billitem->invoices->id}}</a></td>
                            <td>{{@$billitem->invoices->clients->name_client}}</td>
                            <td>{{@$billitem->quantity_b}}</td>
                        </tr>

                    @endforeach




                    @if(!empty(@$item->Invoicedeviceitems))
                        @foreach(@$item->Invoicedeviceitems as $vInvoice)
                            <tr>
                                <td><a href="{{aurl('invoices/show/'.$vInvoice->invoice_id)}}">{{@$vInvoice->invoices->invoice_number}}</a></td>
                                <td>{{$vInvoice->invoices->clients->name_client}}</td>
                                <td>{{$vInvoice->quantity_devices}}</td>
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
                    <td><span class="label label-success">مجموع</span></td>
                    <td></td>
                    <td><span class="label label-success">{{@$sumInvoice}}</span></td>

                </tr>
                <tr>
                    <td><span class="label label-warning">الاجمالي</span></td>
                    <td></td>

                    <td><span class=" ">{{@$Total = $sumBills - $sumInvoice}}</span></td>

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