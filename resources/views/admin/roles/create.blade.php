@extends('admin.index')
@section('page_title')
    {{trans('roles.create')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('roles.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('roles.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-1 control-label">{{trans('الوظيفية')}}</label>
                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" required  placeholder="{{trans('الوظيفية')}}">
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
                        <div  style="text-align: center">
                        <label>{{trans('roles.create')}}</label>
                        </div>
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
                                    <input type="checkbox" name="allow[]" value="1">
                                </td>
                                <td>
                                    {{ trans('admin.show_user') }}
                                    <input type="checkbox" name="allow[]" value="2">
                                </td>
                                <td>
                                    {{ trans('admin.create_user') }}
                                    <input type="checkbox" name="allow[]" value="3">
                                </td>
                            </tr>
                            <tr>
                                <th style="background: #c4c4c4"></th>
                                <td>
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="4">
                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="5">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--currencies--}}
                            <tr>
                                <td>
                                    {{ trans('currencies.admin') }}
                                    <input type="checkbox" name="allow[]" value="6">
                                </td>
                                <td>
                                    {{ trans('currencies.show') }}
                                    <input type="checkbox" name="allow[]" value="7">
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <th style="background: #c4c4c4"></th>
                                <td>تعديل
                                    <input type="checkbox" name="allow[]" value="8">
                                </td>
                                <td style="background: #dfdfdf"></td>

                            </tr>
                            {{--clients--}}
                            <tr>
                                <td>
                                    {{ trans('clients.admin') }}
                                    <input type="checkbox" name="allow[]" value="9">
                                </td>
                                <td>
                                    {{ trans('clients.show') }}
                                    <input type="checkbox" name="allow[]" value="10">
                                </td>
                                <td>
                                    {{ trans('clients.create') }}
                                    <input type="checkbox" name="allow[]" value="11">
                                </td>

                            </tr>
                            <tr>
                                <th style="background: #c4c4c4"></th>
                                <td>
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="12">


                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="13">
                                </td>
                                <td style="background: #dfdfdf"></td>


                            </tr>
                            {{--suppliers--}}
                            <tr>
                                <td>
                                    {{ trans('suppliers.admin') }}
                                    <input type="checkbox" name="allow[]" value="14">
                                </td>
                                <td >
                                    {{ trans('suppliers.show_suppliers') }}
                                    <input type="checkbox" name="allow[]" value="15">
                                </td>
                                <td>
                                    {{ trans('suppliers.create') }}
                                    <input type="checkbox" name="allow[]" value="16">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>منتجات الموردين</label>
                                    <input type="checkbox" name="allow[]" value="17">

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="18">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="19">
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
                                    <input type="checkbox" name="allow[]" value="54">
                                </td>
                                <td>
                                    {{ trans('supplierproducts.create') }}
                                    <input type="checkbox" name="allow[]" value="55">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="56">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="57">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--items--}}
                            <tr>
                                <td>
                                    {{ trans('items.admin') }}
                                    <input type="checkbox" name="allow[]" value="20">
                                </td>
                                <td >
                                    {{ trans('items.show_itmes') }}
                                    <input type="checkbox" name="allow[]" value="21">
                                </td>
                                <td>
                                    {{ trans('items.create') }}
                                    <input type="checkbox" name="allow[]" value="22">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>رقم التسلسل</label>
                                    <input type="checkbox" name="allow[]" value="23">

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="24">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="25">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--itemserials--}}
                            <tr>
                                <td>
                                    {{ trans('itemserials.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="58">--}}
                                </td>
                                <td >
                                    {{ trans('إستعرض رقم تسلسل المادة') }}
                                    <input type="checkbox" name="allow[]" value="59">
                                </td>
                                <td>
                                    {{ trans('itemserials.create') }}
                                    <input type="checkbox" name="allow[]" value="60">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="61">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="62">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--devices--}}
                            <tr>
                                <td>
                                    {{ trans('devices.admin') }}
                                    <input type="checkbox" name="allow[]" value="26">
                                </td>
                                <td >
                                    {{ trans('devices.show_devices') }}
                                    <input type="checkbox" name="allow[]" value="27">
                                    {{ trans('subdevices.show_devices') }}
                                    <input type="checkbox" name="allow[]" value="28">
                                </td>
                                <td>
                                    {{ trans('devices.create') }}
                                    <input type="checkbox" name="allow[]" value="29">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>مواد الجهاز</label>
                                    <input type="checkbox" name="allow[]" value="30">
                                    <label>الاجهزة الفرعية</label>
                                    <input type="checkbox" name="allow[]" value="31">

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="32">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="33">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--deviceitems--}}
                            <tr>
                                <td>
                                    {{ trans('deviceitems.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="63">--}}
                                </td>
                                <td >
                                    {{ trans('deviceitems.show') }}
                                    <input type="checkbox" name="allow[]" value="64">
                                </td>
                                <td>
                                    {{ trans('deviceitems.create') }}
                                    <input type="checkbox" name="allow[]" value="65">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="66">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="67">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--subdevices--}}
                            <tr>
                                <td>
                                    {{ trans('subdevices.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="68">--}}
                                </td>
                                <td >
                                    {{ trans('subdevices.show') }}
                                    <input type="checkbox" name="allow[]" value="69">
                                </td>
                                <td>
                                    {{ trans('subdevices.create') }}
                                    <input type="checkbox" name="allow[]" value="70">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="71">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="72">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--bills--}}
                            <tr>
                                <td>
                                    {{ trans('bills.admin') }}
                                    <input type="checkbox" name="allow[]" value="34">
                                </td>
                                <td >
                                    {{ trans('bills.show') }}
                                    <input type="checkbox" name="allow[]" value="35">
                                    {{ trans('shipping.show_shipping') }}
                                    <input type="checkbox" name="allow[]" value="36">
                                </td>
                                <td>
                                    {{ trans('bills.create') }}
                                    <input type="checkbox" name="allow[]" value="37">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>مصاريف الشحن	</label>
                                    <input type="checkbox" name="allow[]" value="38">

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="39">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="40">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--shipping--}}
                            <tr>
                                <td>
                                    {{ trans('shipping.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="73">--}}
                                </td>
                                <td >
                                    {{ trans('shipping.show_shipping') }}
                                    <input type="checkbox" name="allow[]" value="74">
                                </td>
                                <td>
                                    {{ trans('shipping.create') }}
                                    <input type="checkbox" name="allow[]" value="75">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="76">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="77">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--shipments--}}
                            <tr>
                                <td>
                                    {{ trans('shipments.admin') }}
                                    {{--<input type="checkbox" name="allow[]" value="78">--}}
                                </td>
                                <td >
                                    {{ trans('shipments.show') }}
                                    <input type="checkbox" name="allow[]" value="79">
                                </td>
                                <td>
                                    {{ trans('shipments.create') }}
                                    <input type="checkbox" name="allow[]" value="80">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >

                                    <label>تعديل</label>
                                    <input type="checkbox" name="allow[]" value="81">

                                    <label>حذف</label>
                                    <input type="checkbox" name="allow[]" value="82">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--projects--}}
                            <tr>
                                <td>
                                    {{ trans('projects.admin') }}
                                    <input type="checkbox" name="allow[]" value="41">
                                </td>
                                <td >
                                    {{ trans('projects.show') }}
                                    <input type="checkbox" name="allow[]" value="42">
                                    {{ trans('expensesitems.show') }}
                                    <input type="checkbox" name="allow[]" value="43">
                                </td>
                                <td>
                                    {{ trans('projects.create') }}
                                    <input type="checkbox" name="allow[]" value="44">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>مصاريف المشروع		</label>
                                    <input type="checkbox" name="allow[]" value="45">

                                    {{--<label>عرض سعر	</label>--}}
                                    {{--<input type="checkbox" name="allow[]" value="46">--}}

                                    {{--<label>عرض المشروع	</label>--}}
                                    {{--<input type="checkbox" name="allow[]" value="47">--}}
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="48">
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
                                    <input type="checkbox" name="allow[]" value="85">

                                </td>
                                <td>
                                    {{ trans('projectcosts.create') }}
                                    <input type="checkbox" name="allow[]" value="86">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل	</label>
                                    <input type="checkbox" name="allow[]" value="87">
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="88">
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
                                    <input type="checkbox" name="allow[]" value="89">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td >
                                    <label>تعديل	</label>
                                    <input type="checkbox" name="allow[]" value="90">
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="91">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--invoices--}}
                            <tr>
                                <td>
                                    {{ trans('invoices.admin') }}
                                    <input type="checkbox" name="allow[]" value="49">
                                </td>
                                <td >
                                    {{ trans('invoices.show') }}
                                    <input type="checkbox" name="allow[]" value="50">
                                </td>
                                <td>
                                    {{ trans('invoices.create') }}
                                    <input type="checkbox" name="allow[]" value="51">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="52">
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="53">
                                </td>
                                <td style="background: #dfdfdf"></td>
                            </tr>
                            {{--Imports--}}
                            <tr>
                                <td>
                                    {{ trans('imports.admin') }}
                                    <input type="checkbox" name="allow[]" value="95">
                                </td>
                                <td >
                                    {{ trans('imports.show') }}
                                    <input type="checkbox" name="allow[]" value="96">
                                </td>
                                <td>
                                    {{ trans('imports.create') }}
                                    <input type="checkbox" name="allow[]" value="97">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="98">
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="99">
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
                                    <input type="checkbox" name="allow[]" value="100">
                                </td>
                                <td>
                                    {{ trans('importnames.create') }}
                                    <input type="checkbox" name="allow[]" value="101">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="102">
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="103">
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
                                    <input type="checkbox" name="allow[]" value="104">
                                </td>
                                <td>
                                    {{ trans('importexpenses.create') }}
                                    <input type="checkbox" name="allow[]" value="105">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="106">
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="107">
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
                                    <input type="checkbox" name="allow[]" value="108">
                                </td>
                                <td>
                                    {{ trans('banktransfers.create') }}
                                    <input type="checkbox" name="allow[]" value="109">
                                </td>
                            </tr>
                            <tr>
                                <td style="background: #c4c4c4"></td>
                                <td>
                                    <label>تعديل 	</label>
                                    <input type="checkbox" name="allow[]" value="110">
                                    <label>حذف	</label>
                                    <input type="checkbox" name="allow[]" value="111">
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