@extends('admin.index')
@section('page_title')
    {{trans('تقرير قيمة المخزن')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('التقرير اليومي للمستخدم')}} </h3>
            <br><br>
            <h3 class="box-title">{{trans('اسم المستخدم')}} : {{@$item->item_name}}</h3>
        </div>
        <div class="box-header">

            <div class="col-md-4">
                @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                    <select name="user_id" class="form-control py-2 w-100 select2" required onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                        <option value=""> برجاء اختيار اسم المستخدم</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if( $user->id == $id) selected @endif>{{$user->name}}</option>
                        @endforeach

                    </select>
                @else
                    <input type="text" class="form-control py-2 w-100 " name="user_id" value="{{Auth::guard('admin')->user()->name}}" readonly>
                @endif
            </div>
            <div class="col-md-5">
                    <h4>عدد فواتير المستخدم لليوم :
                        @if($userdd == 0)
                        <span style="color: red">لم يتم إدخال فواتير من قبل المستخدم</span>
                        @else
                        <span style="color: green">{{$userdd}}</span>
                        @endif
                    </h4>
                <h4>عدد القطع جميعها :
                    @if($itemsCount == 0 OR $itemsCount == '')
                        <span style="color: red">لم يتم بيع قطع</span>
                    @else
                        <span style="color: green">{{$itemsCount}}</span>
                    @endif
                </h4>
                <h4>عدد القطع التي تم تسليمها :
                    @if($countItems == 0 OR $countItems == '')
                        <span style="color: red">لم يتم تسليم قطع</span>
                    @else
                        <span style="color: green">{{$countItems}}</span>
                    @endif
                </h4>
                <h4>عدد القطع المرفوضة :
                    @if($countItems2 == 0 OR $countItems2 == '')
                        <span style="color: green">0</span>
                    @else
                        <span style="color: red">{{$countItems2}}</span>
                    @endif
                </h4>
            </div>
            <div class="col-md-3">
                <form method="get" action="{{aurl('report/daily').'/'.request()->route('id')}}">
                    <div class="input-group">
                        <input type="hidden" value="{{request()->route('id')}}" name="user_id">
                        <span class="col-sm-12">
                          <button type="submit" name="exports" value="excel" class="btn btn-success btn-lg btn-flat pull-left"><i class="fa fa-database"></i> Excel!</button>
                        </span>
                    </div>
                </form>
            </div>


        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>
                    <th>{{ trans('رقم الفاتورة')}}</th>
                    <th>{{ trans('إسم المادة')}}</th>
                    <th>{{ trans('عدد القطع منها')}}</th>
                    <th>{{ trans('تاريخ الطلب')}}</th>
                    <th>{{ trans('حالة الطلب')}}</th>
                </tr>
                </thead>
                <tbody>

                @foreach($invoices as $invoice)
                    @if(date("Y/m/d",strtotime($invoice->created_at)) == $today)
                        @foreach($invoicesitems as $item)
                            @if($item->invoice_id == $invoice->id)
                            <tr>
                                <td>{{$invoice->id}}</td>
                                <td>{{$item->items->item_name}}</td>
                                <td>{{$item->quantity_b}}</td>
                                <td>{{date("Y/m/d",strtotime($invoice->created_at))}}</td>
                                @if($invoice->status_id == 1)
                                    <td style="font-weight: bold">{{$invoice->status->name}}</td>
                                @elseif($invoice->status_id == 2)
                                    <td style="background-color: lightgreen;font-weight: bold">{{$invoice->status->name}}</td>
                                @else($invoice->status_id == 3)
                                    <td style="background-color: red ;color: white;font-weight: bold">{{$invoice->status->name}}</td>
                                @endif
                            </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                <tr>
                    <th>{{ trans('رقم الفاتورة')}}</th>
                    <th>{{ trans('إسم المادة')}}</th>
                    <th>{{ trans('عدد القطع منها')}}</th>
                    <th>{{ trans('تاريخ الطلب')}}</th>
                    <th>{{ trans('حالة الطلب')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->


    <!-- Trigger the modal with a button -->






@endsection