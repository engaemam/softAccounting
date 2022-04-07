@extends('admin.index')
@section('page_title')
    {{trans('تقرير قيمة المخزن')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('التقرير الشهري للمستخدم')}} </h3>
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
            <div class="col-md-3">
                    <!-- <h4>عدد فواتير المستخدم للشهر :
                        @if($userdd == 0 OR $userdd == '')
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
                </h4> -->
            </div>
            <div class="col-md-5">
                <form method="get" action="{{aurl('locker/monthly').'/'.request()->route('id')}}">
                    <div class="input-group">
                        <input type="hidden" value="{{request()->route('id')}}" name="user_id">
                        <div class="form-group col-sm-6">
                            {!! Form::label('from', 'من') !!}
                            {!! Form::date('from', null, ['class' => 'form-control',"id" => "datepicker1",'autocomplete="off"']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('to', 'الي') !!}
                            {!! Form::date('to', null, ['class' => 'form-control',"id" => "datepicker",'autocomplete="off"']) !!}
                        </div>
                        @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                            <br><br>
                            <div class="form-group col-sm-12">
                            <label class="label-primary">نوع الفاتورة</label>
                            <select name="save_value" class="form-control py-2 w-100 select2">
                                <option value="" readonly> اختيار نوع الفاتورة</option>
                                <option value="0">حفظ مؤقت</option>
                                <option value="1">حفظ</option>
                            </select>
                            </div>
                        @endif
                        <span class="col-sm-12">
                          <button type="submit" class="btn btn-info btn-lg btn-flat">بحث!</button>
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
                    <th>إجمالي فاتورة بيع مباشر</th>
                    <th>إجمالي إمر قبض</th>
                    <th>إجمالي فواتير الشحن</th>
                    <th>إجمالي امر دفع</th>
                    <th>صافي الخزنة</th>
                   
                </tr>
                </thead>
                <tbody>

            
                            <tr>
                                <td>{{$suminvoices}}</td>
                                <td>{{$getmoneys}}</td>
                                <td>{{$sumSh}}</td>
                                <td>{{$paymoneys}}</td>
                                <td>{{$final}}</td>
                            </tr>
                         
                    
                </tbody>

                <tfoot>

                <tr>
                <tr>
             
                    <th>إجمالي فاتورة بيع مباشر</th>
                    <th>إجمالي إمر قبض</th>
                    <th>إجمالي فواتير الشحن</th>
                    <th>إجمالي امر دفع</th>
                    <th>صافي الخزنة</th>
                   
                </tr>
                </tfoot>

            </table>
            <br>
            {{--@if($items->count()>0)--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$items->total()}} </div>--}}

                    {{--<div class="col-md-7 col-sm-7"> {{ $items->appends(\Request::except('_token'))->render() }}</div>--}}
                {{--</div>--}}
            {{--@endif--}}
            @if($invoices->count()>0)
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-6 col-sm-6 text-center">{{$invoices->appends(\Request::except('_token'))->render()}}</div>
                    <div class="col-md-2"></div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->


    <!-- Trigger the modal with a button -->






@endsection