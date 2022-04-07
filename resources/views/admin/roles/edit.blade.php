@extends('admin.index')
@section('page_title')
    {{trans('تعديل')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">تعديل</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/roles/')}}/{{$roles->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-1 control-label">{{trans('الاسم')}}</label>
                        <div class="col-sm-3">
                            <input type="text" name="name"  value="{{$roles->name}}" class="form-control"  placeholder="{{trans('الاسم')}}">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <style>
                        th {
                            text-align: center;
                        }
                        tr {
                            text-align: center;
                        }
                    </style>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الاسم</th>
                                <th>الاسم</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>

                                    {{ trans('admin.admin') }}
                                    <input type="checkbox" name="allow[]" value="1"  @if(in_array(1, $temp)) checked @endif>

                                </td>
                                <td>
                                    {{ trans('admin.show_user') }}
                                    <input type="checkbox" name="allow[]" value="2"  @if(in_array(2, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('admin.create_user') }}
                                    <input type="checkbox" name="allow[]" value="3"  @if(in_array(3, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <th style="background: #c4c4c4"></th>
                                <td>
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="4" @if(in_array(4, $temp)) checked @endif>
                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="5"  @if(in_array(5, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--currencies--}}
                            <tr>
                                <td>
                                    {{ trans('currencies.admin') }}
                                    <input type="checkbox" name="allow[]" value="6" @if(in_array(6, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('currencies.show') }}
                                    <input type="checkbox" name="allow[]" value="7" @if(in_array(7, $temp)) checked @endif>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <th style="background: #c4c4c4"></th>
                                <td>تعديل
                                    <input type="checkbox" name="allow[]" value="8" @if(in_array(8, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>

                            </tr>
                            {{--clients--}}
                            <tr>
                                <td>
                                    {{ trans('clients.admin') }}
                                    <input type="checkbox" name="allow[]" value="9" @if(in_array(9, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('clients.show') }}
                                    <input type="checkbox" name="allow[]" value="10" @if(in_array(10, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('clients.create') }}
                                    <input type="checkbox" name="allow[]" value="11" @if(in_array(11, $temp)) checked @endif>
                                </td>

                            </tr>
                            <tr>
                                <th style="background: #c4c4c4"></th>
                                <td>
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="12" @if(in_array(12, $temp)) checked @endif>


                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="13" @if(in_array(13, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>


                            </tr>
                            {{--suppliers--}}
                            <tr>
                                <td>
                                    {{ trans('suppliers.admin') }}
                                    <input type="checkbox" name="allow[]" value="14" @if(in_array(14, $temp)) checked @endif>
                                </td>
                                <td >
                                    {{ trans('suppliers.show_suppliers') }}
                                    <input type="checkbox" name="allow[]" value="15" @if(in_array(15, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('suppliers.create') }}
                                    <input type="checkbox" name="allow[]" value="16" @if(in_array(16, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>منتجات الموردين</label>
                                    <input type="checkbox" name="allow[]" value="17" @if(in_array(17, $temp)) checked @endif>

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="18" @if(in_array(18, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="19" @if(in_array(19, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--supplierproducts--}}
                            <tr>
                                <td>
                                    {{ trans('supplierproducts.admin') }}
                                </td>
                                <td >
                                    {{ trans('supplierproducts.show') }}
                                    <input type="checkbox" name="allow[]" value="54" @if(in_array(54, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('supplierproducts.create') }}
                                    <input type="checkbox" name="allow[]" value="55" @if(in_array(55, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="56" @if(in_array(56, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="57" @if(in_array(57, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--items--}}
                            <tr>
                                <td>
                                    {{ trans('items.admin') }}
                                    <input type="checkbox" name="allow[]" value="20" @if(in_array(20, $temp)) checked @endif>
                                </td>
                                <td >
                                    {{ trans('items.show_itmes') }}
                                    <input type="checkbox" name="allow[]" value="21" @if(in_array(21, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('items.create') }}
                                    <input type="checkbox" name="allow[]" value="22" @if(in_array(22, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>رقم التسلسل</label>
                                    <input type="checkbox" name="allow[]" value="23" @if(in_array(23, $temp)) checked @endif>

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="24" @if(in_array(24, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="25" @if(in_array(25, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--itemserials--}}
                            <tr>
                                <td>
                                    {{ trans('itemserials.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="58" @if(in_array(58, $temp)) checked @endif>--}}
                                </td>
                                <td >
                                    {{ trans('إستعرض رقم تسلسل المادة') }}
                                    <input type="checkbox" name="allow[]" value="59" @if(in_array(59, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('itemserials.create') }}
                                    <input type="checkbox" name="allow[]" value="60" @if(in_array(60, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="61" @if(in_array(61, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="62" @if(in_array(62, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--devices--}}
                            <tr>
                                <td>
                                    {{ trans('devices.admin') }}
                                    <input type="checkbox" name="allow[]" value="26" @if(in_array(26, $temp)) checked @endif>
                                </td>
                                <td >
                                    {{ trans('devices.show_devices') }}
                                    <input type="checkbox" name="allow[]" value="27" @if(in_array(27, $temp)) checked @endif>
                                    {{ trans('subdevices.show_devices') }}
                                    <input type="checkbox" name="allow[]" value="28" @if(in_array(28, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('devices.create') }}
                                    <input type="checkbox" name="allow[]" value="29" @if(in_array(29, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>مواد الجهاز</label>
                                    <input type="checkbox" name="allow[]" value="30" @if(in_array(30, $temp)) checked @endif>
                                    <label>الاجهزة الفرعية</label>
                                    <input type="checkbox" name="allow[]" value="31" @if(in_array(31, $temp)) checked @endif>

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="32" @if(in_array(32, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="33" @if(in_array(33, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>

                            {{--deviceitems--}}
                            <tr>
                                <td>
                                    {{ trans('deviceitems.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="63" @if(in_array(63, $temp)) checked @endif>--}}
                                </td>
                                <td >
                                    {{ trans('deviceitems.show') }}
                                    <input type="checkbox" name="allow[]" value="64" @if(in_array(64, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('deviceitems.create') }}
                                    <input type="checkbox" name="allow[]" value="65" @if(in_array(65, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="66" @if(in_array(66, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="67" @if(in_array(67, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--subdevices--}}
                            <tr>
                                <td>
                                    {{ trans('subdevices.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="68" @if(in_array(68, $temp)) checked @endif>--}}
                                </td>
                                <td >
                                    {{ trans('subdevices.show') }}
                                    <input type="checkbox" name="allow[]" value="69" @if(in_array(69, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('subdevices.create') }}
                                    <input type="checkbox" name="allow[]" value="70" @if(in_array(70, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="71" @if(in_array(71, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="72" @if(in_array(72, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--bills--}}
                            <tr>
                                <td>
                                    {{ trans('bills.admin') }}
                                    <input type="checkbox" name="allow[]" value="34" @if(in_array(34, $temp)) checked @endif>
                                </td>
                                <td >
                                    {{ trans('bills.show') }}
                                    <input type="checkbox" name="allow[]" value="35" @if(in_array(35, $temp)) checked @endif>
                                    {{ trans('shipping.show_shipping') }}
                                    <input type="checkbox" name="allow[]" value="36" @if(in_array(36, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('bills.create') }}
                                    <input type="checkbox" name="allow[]" value="37" @if(in_array(37, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>مصاريف الشحن	</label>
                                    <input type="checkbox" name="allow[]" value="38" @if(in_array(38, $temp)) checked @endif>

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="39" @if(in_array(39, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="40" @if(in_array(40, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>

                            {{--shipping--}}
                            <tr>
                                <td>
                                    {{ trans('shipping.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="73" @if(in_array(73, $temp)) checked @endif>--}}
                                </td>
                                <td >
                                    {{ trans('shipping.show_shipping') }}
                                    <input type="checkbox" name="allow[]" value="74" @if(in_array(74, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('shipping.create') }}
                                    <input type="checkbox" name="allow[]" value="75" @if(in_array(75, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="76" @if(in_array(76, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="77" @if(in_array(77, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--shipments--}}
                            <tr>
                                <td>
                                    {{ trans('shipments.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="78" @if(in_array(78, $temp)) checked @endif>--}}
                                </td>
                                <td >
                                    {{ trans('shipments.show') }}
                                    <input type="checkbox" name="allow[]" value="79" @if(in_array(79, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('shipments.create') }}
                                    <input type="checkbox" name="allow[]" value="80" @if(in_array(80, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="81" @if(in_array(81, $temp)) checked @endif>

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="82" @if(in_array(82, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--projects--}}
                            <tr>
                                <td>
                                    {{ trans('projects.admin') }}
                                    <input type="checkbox" name="allow[]" value="41" @if(in_array(41, $temp)) checked @endif>
                                </td>
                                <td >
                                    {{ trans('projects.show') }}
                                    <input type="checkbox" name="allow[]" value="42" @if(in_array(42, $temp)) checked @endif>
                                    {{ trans('expensesitems.show') }}
                                    <input type="checkbox" name="allow[]" value="43" @if(in_array(43, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('projects.create') }}
                                    <input type="checkbox" name="allow[]" value="44" @if(in_array(44, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>مصاريف المشروع		</label>
                                    <input type="checkbox" name="allow[]" value="45" @if(in_array(45, $temp)) checked @endif>

                                    {{--<label>عرض سعر	</label>--}}
                                    {{--<input type="checkbox" name="allow[]" value="46" @if(in_array(46, $temp)) checked @endif>--}}

                                    {{--<label>عرض المشروع	</label>--}}
                                    {{--<input type="checkbox" name="allow[]" value="47"  @if(in_array(47, $temp)) checked @endif>--}}
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="48" @if(in_array(48, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--projectcosts--}}
                            <tr>
                                <td>
                                    {{ trans('projectcosts.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="84">--}}
                                </td>
                                <td >
                                    {{ trans('projectcosts.show') }}
                                    <input type="checkbox" name="allow[]" value="85"  @if(in_array(85, $temp)) checked @endif>

                                </td>
                                <td>
                                    {{ trans('projectcosts.create') }}
                                    <input type="checkbox" name="allow[]" value="86"  @if(in_array(86, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل	</label>
                                    <input type="checkbox" name="allow[]" value="87"   @if(in_array(87, $temp)) checked @endif>
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="88"   @if(in_array(88, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--expensesitems--}}
                            <tr>
                                <td>
                                    {{ trans('expensesitems.admin') }}
                                </td>
                                <td >
                                    {{ trans('expensesitems.show') }}

                                </td>
                                <td>
                                    {{ trans('expensesitems.create') }}
                                    <input type="checkbox" name="allow[]" value="89"   @if(in_array(89, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل	</label>
                                    <input type="checkbox" name="allow[]" value="90"  @if(in_array(90, $temp)) checked @endif>
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="91"  @if(in_array(91, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--invoices--}}
                            <tr>
                                <td>
                                    {{ trans('invoices.admin') }}
                                    <input type="checkbox" name="allow[]" value="49" @if(in_array(49, $temp)) checked @endif>
                                </td>
                                <td >
                                    {{ trans('invoices.show') }}
                                    <input type="checkbox" name="allow[]" value="50"  @if(in_array(51, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('invoices.create') }}
                                    <input type="checkbox" name="allow[]" value="51" @if(in_array(51, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="52" @if(in_array(52, $temp)) checked @endif>
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="53" @if(in_array(53, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>

                            {{--Imports--}}
                            <tr>
                                <td>
                                    {{ trans('imports.admin') }}
                                    <input type="checkbox" name="allow[]" value="95" @if(in_array(95, $temp)) checked @endif>
                                </td>
                                <td >
                                    {{ trans('imports.show') }}
                                    <input type="checkbox" name="allow[]" value="96" @if(in_array(96, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('imports.create') }}
                                    <input type="checkbox" name="allow[]" value="97" @if(in_array(97, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="98" @if(in_array(98, $temp)) checked @endif>
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="99" @if(in_array(99, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--Importnames--}}
                            <tr>
                                <td>
                                    {{ trans('importnames.admin') }}

                                </td>
                                <td >
                                    {{ trans('importnames.show') }}
                                    <input type="checkbox" name="allow[]" value="100" @if(in_array(100, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('importnames.create') }}
                                    <input type="checkbox" name="allow[]" value="101" @if(in_array(101, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="102" @if(in_array(102, $temp)) checked @endif>
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="103" @if(in_array(103, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--importexpenses--}}
                            <tr>
                                <td>
                                    {{ trans('importexpenses.admin') }}

                                </td>
                                <td >
                                    {{ trans('importexpenses.show') }}
                                    <input type="checkbox" name="allow[]" value="104" @if(in_array(104, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('importexpenses.create') }}
                                    <input type="checkbox" name="allow[]" value="105" @if(in_array(105, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="106" @if(in_array(106, $temp)) checked @endif>
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="107" @if(in_array(107, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--BankTrasfers--}}
                            <tr>
                                <td>
                                    {{ trans('banktransfers.admin') }}

                                </td>
                                <td >
                                    {{ trans('banktransfers.show') }}
                                    <input type="checkbox" name="allow[]" value="108" @if(in_array(108, $temp)) checked @endif>
                                </td>
                                <td>
                                    {{ trans('banktransfers.create') }}
                                    <input type="checkbox" name="allow[]" value="109" @if(in_array(109, $temp)) checked @endif>
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="110" @if(in_array(110, $temp)) checked @endif>
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="111" @if(in_array(111, $temp)) checked @endif>
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>

                            </tbody>

                            <tfoot>
                            <tr>
                                <th>الاسم</th>
                                <th >الاسم</th>
                                <th>الاسم</th>

                            </tr>
                            </tfoot>
                        </table>
                    </div>


                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection