@extends('admin.index')
@section('page_title')
    {{trans('soft Accounting')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
{{--            <img src="{{url('/')}}/js/logo.png" class="img-responsive" alt="soft Accounting" style="width: 20%;">--}}
                {{--<img  src="{{url('asst_ar/img/logo.png')}}" width="350"  alt="" />--}}
            <h3 class="box-title"></h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            @if(Auth::guard('admin')->user()->id != 1)
            <p style="text-align: center">مرحباً بك   <strong style="text-transform: uppercase;">{{ admin()->user()->name }}</strong></p>
            <div class="row">

                <div class="col-md-4">
                    <a href="{{ aurl('invoices') }}" class="btn btn-info btn-lg btn-block">إستعراض فواتير البيع</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ aurl('items') }}" class="btn btn-primary btn-lg btn-block">المواد</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ aurl('invoices/create') }}" class="btn btn-success btn-lg btn-block">إضافة فاتورة بيع</a>
                </div>
            </div>
            <br><br>
            <div class="row">

                <!-- Start AHMED GORASHI -->

@else
                <!-- ./Start Users -->
                @if(in_array(2, $temp))
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{count($users)}}</h3>
                            <p>المستخدمين</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{aurl('admin')}}" class="small-box-footer">
                                 استعراض المستخدمين
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                    </div>

                </div>
                @endif
                <!-- ./End Users -->

                <!-- ./Start Clients -->
                @if(in_array(10, $temp))
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{count($clients)}}</h3>

                            <p>الزبائن</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="{{aurl('clients')}}" class="small-box-footer">
                            إستعرض الزبائن
                            <i class="fa fa-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
                @endif
                <!-- ./End Clients -->
                <!-- ./Start suppliers -->
                @if(in_array(15, $temp))
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <h3>{{count($suppliers)}}</h3>
                                <p>الموردين</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-plane"></i>
                            </div>
                            <a href="{{aurl('suppliers')}}" class="small-box-footer">
                                إستعرض الموردين
                                <i class="fa fa-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                @endif
            <!-- ./End suppliers -->

                <!-- ./Start Items -->
                @if(in_array(21, $temp))
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{count($items)}}</h3>

                                <p> المواد</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="{{aurl('items')}}" class="small-box-footer">
                                استعراض المواد
                                <i class="fa fa-arrow-circle-left"></i>
                            </a>
                        </div>

                    </div>
                @endif
                <!-- ./End Items -->

                <!-- ./End Devices -->


                <!-- ./Start bills -->
                @if(in_array(35, $temp))
                    <div class="col-lg-6 col-xs-8">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3>{{count($bill)}}</h3>

                                <p>فواتير شراء</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <a href="{{aurl('bills')}}" class="small-box-footer">
                                إستعرض فواتير شراء
                                <i class="fa fa-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                @endif
            <!-- ./End bills -->

            <!-- ./End projects -->

                <!-- ./Start invoices -->
                @if(in_array(50, $temp))
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-maroon">
                            <div class="inner">
                                <h3>{{count($invoices)}}</h3>
                                <p> فواتير البيع</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="{{aurl('invoices')}}" class="small-box-footer">
                                إستعرض فواتير البيع

                                <i class="fa fa-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                @endif
@endif
                <!-- End AHMED GORASHI -->
<br><br><br><br>
            <!-- ./End invoices -->
                <!-- /.box-Bills -->
                @if(in_array(35, $temp))
                <div class="col-lg-6 col-xs-6 box-body">
                    <table  id=""  class="table table-bordered table-striped ">


                        <thead>
                        <tr >
                            <th colspan="4" style="text-align: center"> اخر 5  فواتير شراء</th>
                        </tr>
                        <tr>
                            <th>{{trans('bills.bill_number')}}</th>
                            <th>{{trans('bills.date')}}</th>
                            <th>{{trans('bills.bill')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($bills->count()>0)
                            @foreach($bills as $bill)
                                @if(Auth::guard('admin')->user()->id == $bill->user_id OR Auth::guard('admin')->user()->role_id == 1)
                                <tr>
                                    <td><a href="{{aurl('bills/show/'.$bill->id)}}">{{$bill->id}}</a></td>
                                    <td>{{date("Y/m/d",strtotime($bill->created_at))}}</td>
                                    <td><a href="{{aurl('bills/show/'.$bill->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>

                                </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td class="center" colspan="9" style="text-align: center">
                                    {{trans('الجدول خالي')}}
                                </td>
                            </tr>
                        @endif

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>{{trans('bills.bill_number')}}</th>
                            <th>{{trans('bills.date')}}</th>
                            <th>{{trans('bills.bill')}}</th>
                        </tr>
                        </tfoot>

                    </table>
                    <br>
                    @if($bills->count()>0)

                    @endif
                </div>
                <!-- /.box-Bills -->
                @endif
            <!-- /.box-Projects -->

            <!-- /.box-invoices -->
                @if(in_array(50, $temp))
                    <div class="col-lg-6 col-xs-6 box-body">
                        <table  id=""  class="table table-bordered table-striped ">


                            <thead>
                            <tr >
                                <th colspan="4" style="text-align: center"> اخر 5  فواتير بيع</th>
                            </tr>
                            <tr>
                                <th>{{trans('bills.bill_number')}}</th>
                                <th>{{trans('bills.date')}}</th>
                                <th>{{trans('bills.bill')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($invoice->count()>0)
                                @foreach($invoice as $value)
                                    @if(Auth::guard('admin')->user()->id == $value->user_id OR Auth::guard('admin')->user()->role_id == 1)

                                    <tr>
                                        <td><a href="{{aurl('invoices/show/'.$value->id)}}">{{$value->id}}</a></td>
                                        <td>{{date("Y/m/d",strtotime($value->created_at))}}</td>
                                        <td><a href="{{aurl('invoices/show/'.$value->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>

                                    </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td class="center" colspan="9" style="text-align: center">
                                        {{trans('الجدول خالي')}}
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{trans('bills.bill_number')}}</th>
                                <th>{{trans('bills.date')}}</th>
                                <th>{{trans('bills.bill')}}</th>
                            </tr>
                            </tfoot>

                        </table>
                        <br>
                        @if($bills->count()>0)

                        @endif
                    </div>
                    <!-- /.box-Bills -->
                @endif



            </div>

        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->




@endsection