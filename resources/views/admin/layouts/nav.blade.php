<?php
$user_role_id = auth()->guard('admin')->User()->roles;
$allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
$temp = [];
foreach ($allowRoles as $role)
{
    $temp[] = $role->allow;
}

?>
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>A</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>soft </b>accounting</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        @include('admin.layouts.menu')
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<style>
    .stuck {
        position: fixed;
        height: 100%;
        overflow: auto;
    }
</style>
<aside class="main-sidebar stuck">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">

.
            </div>
            <div class="pull-left info">
                <p>{{ admin()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>

        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">



            <li>
                <a href="{{aurl('/')}}">
                    <i class="fa fa-list"></i> <span>{{ trans('لوحة التحكم') }}</span>
                </a>
            </li>



            <li>
                <a href="{{aurl('Shipping_account')}}">
                    <i class="fa fa-ship"></i> <span>{{ trans('ربط  الشحن') }}</span>
                </a>
            </li>


              <li>
                <a href="{{aurl('social')}}">
                <i class="fa fa-facebook-f  "></i> <span>روابط مواقع التواصل </span>
                </a>
            </li>





            @if(in_array(1, $temp))

            <li class="treeview {{ active_menu('admin')[0] }}">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{ trans('admin.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('admin')[1] }}">
                    @if(in_array(2, $temp))

                    <li class=""><a href="{{ aurl('admin') }}"><i class="fa fa-users"></i> {{ trans('admin.show_user') }}
                        </a></li>
                    @endif
                        @if(in_array(3, $temp))
                    <li class=""><a href="{{ aurl('admin/create') }}"><i
                                    class="fa fa-users"></i> {{ trans('admin.create_user') }}</a></li>
                        @endif
                </ul>
            </li>


                    @endif

            {{--@if(in_array(6, $temp))--}}
            {{--<li class=" {{ active_menu('currencies')[0] }}">--}}
                {{--<a href="{{aurl('currencies')}}">--}}
                    {{--<i class="fa fa-money"></i> <span>{{ trans('currencies.admin') }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--@endif--}}
                    {{--@if(in_array(6, $temp))--}}
            {{--<li class="treeview {{ active_menu('currencies')[0] }}">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-money"></i> <span>{{ trans('currencies.admin') }}</span>--}}
                    {{--<span class="pull-right-container">--}}

                    {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu" style="{{ active_menu('currencies')[1] }}">--}}


                    {{--@if(in_array(7, $temp))--}}
                    {{--<li class=""><a href="{{ aurl('currencies') }}"><i class="fa fa-eye"></i> {{ trans('currencies.show') }}--}}
                        {{--</a></li>--}}
                    {{--@endif--}}
                    {{--<li class=""><a href="{{ aurl('currencies/create') }}"><i--}}
                                    {{--class="fa fa-plus"></i> {{ trans('currencies.create') }}</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
                    {{--@endif--}}

            @if(in_array(9, $temp))
            <li class="treeview {{ active_menu('clients')[0] }}">
                <a href="#">
                    <i class="fa fa-user"></i> <span>{{ trans('clients.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('clients')[1] }}">
                    @if(in_array(10, $temp))
                    <li class=""><a href="{{ aurl('clients') }}"><i class="fa fa-eye"></i> {{ trans('clients.show') }}
                        </a></li>
                    @endif
                        @if(in_array(11, $temp))
                    <li class=""><a href="{{ aurl('clients/create') }}"><i
                                    class="fa fa-plus"></i> {{ trans('clients.create') }}</a></li>
                        @endif
                </ul>
            </li>
                    @endif
                    
            
             @if(in_array(9, $temp))
            <li class="treeview {{ active_menu('supplier')[0] }}">
                <a href="#">
                    <i class="fa fa-plane"></i> <span>استعراض عناصر الشحن</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('suppliers')[1] }}{{ active_menu('supplierproducts')[1] }}">
                    @if(in_array(10, $temp))
                    <li class=""><a href="{{ url('api/allinvoices') }}"><i class="fa fa-eye"></i>استعراض بوالص الشحن
                        </a></li>
                    @endif
                        @if(in_array(11, $temp))
                    <li class=""><a href="{{ url('api/allbills') }}"><i
                                    class="fa fa-plus"></i> استعراض فواتير الشحن</a></li>
                        @endif
                          

                </ul>
            </li>
            @endif

            @if(in_array(14, $temp))
            <li class="treeview {{ active_menu('supplier')[0] }}">
                <a href="#">
                    <i class="fa fa-plane"></i> <span>{{ trans('suppliers.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('suppliers')[1] }}{{ active_menu('supplierproducts')[1] }}">
                    @if(in_array(15, $temp))
                    <li class=""><a href="{{ aurl('suppliers') }}"><i class="fa fa-eye"></i> {{ trans('suppliers.show_suppliers') }}
                        </a></li>
                    @endif
                        @if(in_array(17, $temp))
                    <li class=""><a href="{{ aurl('suppliers/create') }}"><i
                                    class="fa fa-plus"></i> {{ trans('suppliers.create') }}</a></li>
                        @endif
                            @if(in_array(16, $temp))
                    <li class=""><a href="{{ aurl('supplierproducts') }}"><i class="fa fa-eye"></i> {{ trans('supplierproducts.show') }}
                        </a></li>
                            @endif

                </ul>
            </li>
            @endif
            <!--<li class="treeview {{ active_menu('cities')[0] }}">-->
            <!--    <a href="#">-->
            <!--        <i class="fa fa-file-excel-o"></i> <span>{{ trans('cities.admin') }}</span>-->
            <!--        <span class="pull-right-container">-->

            <!--        </span>-->
            <!--    </a>-->
            <!--    <ul class="treeview-menu" style="{{ active_menu('cities')[1] }}">-->

            <!--        <li class=""><a href="{{ aurl('cities') }}"><i class="fa fa-eye"></i> {{ trans('cities.show_cities') }}-->
            <!--            </a></li>-->

            <!--        {{--<li class=""><a href="{{ aurl('itemserials') }}"><i class="fa fa-eye"></i> {{ trans('itemserials.itemserials') }}--}}-->
            <!--        {{--</a></li>--}}-->

            <!--    </ul>-->
            <!--</li>-->
            @if(in_array(20, $temp))
                <li class="treeview {{ active_menu('sources')[0] }}">
                    <a href="#">
                        <i class="fa fa-sort"></i> <span>{{ trans('sources.admin') }}</span>
                        <span class="pull-right-container">

                    </span>
                    </a>
                    <ul class="treeview-menu" style="{{ active_menu('sources')[1] }}">
                        @if(in_array(21, $temp))
                            <li class=""><a href="{{ aurl('sources') }}"><i class="fa fa-eye"></i> {{ trans('sources.show_sources') }}
                                </a></li>
                        @endif
                        @if(in_array(22, $temp))
                            <li class=""><a href="{{ aurl('sources/create') }}">
                            <i class="fa fa-plus"></i> {{ trans('sources.create') }}</a></li>
                        @endif
                        {{--<li class=""><a href="{{ aurl('itemserials') }}"><i class="fa fa-eye"></i> {{ trans('itemserials.itemserials') }}--}}
                        {{--</a></li>--}}

                    </ul>
                </li>
            @endif











            @if(in_array(20, $temp))
            <li class="treeview {{ active_menu('items')[0] }}">
                <a href="#">
                    <i class="fa fa-sitemap"></i> <span>{{ trans('items.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('items')[1] }}">
                    <li class="treeview {{ active_menu('cats')[0] }}">
                        <a href="#">
                            <i class="fa fa-file-excel-o"></i> <span>{{ trans('cats.admin') }}</span>
                            <span class="pull-right-container">

                    </span>
                        </a>
                        <ul class="treeview-menu" style="{{ active_menu('cats')[1] }}">

                            <li class=""><a href="{{ aurl('cats') }}"><i class="fa fa-eye"></i> {{ trans('cats.show_cats') }}
                                </a></li>

                            <li class=""><a href="{{ aurl('cats/create') }}"><i
                                            class="fa fa-plus"></i> {{ trans('cats.create') }}</a></li>

                            {{--<li class=""><a href="{{ aurl('itemserials') }}"><i class="fa fa-eye"></i> {{ trans('itemserials.itemserials') }}--}}
                            {{--</a></li>--}}

                        </ul>
                    </li>
                    <li class="treeview {{ active_menu('itemscolors')[0] }}">
                        <a href="#">
                            <i class="fa fa-sort"></i> <span>ادارة مواصفة 1</span>
                            <span class="pull-right-container">

                    </span>
                        </a>
                        <ul class="treeview-menu" style="{{ active_menu('itemscolors')[1] }}">

                            <li class=""><a href="{{ aurl('itemscolors') }}"><i class="fa fa-eye"></i>استعراض مواصفة 1
                                </a></li>


                            <li class=""><a href="{{ aurl('itemscolors/create') }}">
                                    <i class="fa fa-plus"></i> اضافة مواصفة 1</a></li>

                            {{--<li class=""><a href="{{ aurl('itemserials') }}"><i class="fa fa-eye"></i> {{ trans('itemserials.itemserials') }}--}}
                            {{--</a></li>--}}

                        </ul>
                    </li>
                    <li class="treeview {{ active_menu('sizes')[0] }}">
                        <a href="#">
                            <i class="fa fa-sort"></i> <span>ادارة مواصفة 2</span>
                            <span class="pull-right-container">

                    </span>
                        </a>
                        <ul class="treeview-menu" style="{{ active_menu('itemssizes')[1] }}">

                            <li class=""><a href="{{ aurl('itemssizes') }}"><i class="fa fa-eye"></i> استعراض مواصفة 2
                                </a></li>

                            <li class=""><a href="{{ aurl('itemssizes/create') }}">
                                    <i class="fa fa-plus"></i> اضافة مواصفة 2</a></li>

                            {{--<li class=""><a href="{{ aurl('itemserials') }}"><i class="fa fa-eye"></i> {{ trans('itemserials.itemserials') }}--}}
                            {{--</a></li>--}}

                        </ul>
                    </li>

                    @if(in_array(21, $temp))
                    <li class=""><a href="{{ aurl('items') }}"><i class="fa fa-eye"></i> {{ trans('items.show_itmes') }}
                        </a></li>
                    @endif
                        @if(in_array(22, $temp))
                    <li class=""><a href="{{ aurl('items/create') }}"><i
                                    class="fa fa-plus"></i> {{ trans('items.create') }}</a></li>
                        @endif
                    {{--<li class=""><a href="{{ aurl('itemserials') }}"><i class="fa fa-eye"></i> {{ trans('itemserials.itemserials') }}--}}
                    {{--</a></li>--}}


                </ul>
            </li>
            @endif



            @if(in_array(20, $temp))
                <li class="treeview {{ active_menu('items')[0] }}">
                    <a href="#">
                        <i class="fa fa-sitemap"></i> <span>ادارة العروض</span>
                        <span class="pull-right-container">

                    </span>
                    </a>
                    <ul class="treeview-menu" style="{{ active_menu('items')[1] }}">
                        <li class="">
                            <a href="{{aurl('offers')}}">
                                <i class="fa fa-file-excel-o"></i> <span>العروض</span>
                                <span class="pull-right-container">

                    </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{aurl('offers/create')}}">
                                <i class="fa fa-file-excel-o"></i> <span>اضافة عرض</span>
                                <span class="pull-right-container">

                    </span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{aurl('offer/requests')}}">
                                <i class="fa fa-file-excel-o"></i> <span>الطلبات</span>
                                <span class="pull-right-container">
                    </span>
                            </a>
                        </li>




                    </ul>
            @endif




            {{--@if(in_array(26, $temp))--}}
            {{--<li class="treeview {{ active_menu('devices')[0] }}">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-desktop"></i> <span>{{ trans('devices.admin') }}</span>--}}
                    {{--<span class="pull-right-container">--}}

                    {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu" style="{{ active_menu('devices')[1] }}{{ active_menu('subdevices')[1] }}{{ active_menu('deviceitems')[1] }}">--}}
                    {{--@if(in_array(27, $temp))--}}
                    {{--<li class=""><a href="{{ aurl('devices') }}"><i class="fa fa-desktop"></i> {{ trans('devices.show_devices') }}--}}
                        {{--</a></li>--}}
                    {{--@endif--}}
                        {{--@if(in_array(29, $temp))--}}
                    {{--<li class=""><a href="{{ aurl('devices/create') }}"><i--}}
                                    {{--class="fa fa-plus"></i> {{ trans('devices.create') }}</a></li>--}}
                        {{--@endif--}}
                    {{--<li class=""><a href="{{ aurl('deviceitems') }}"><i class="fa fa-desktop"></i> {{ trans('deviceitems.show') }}--}}
                    {{--</a></li>--}}
                            {{--@if(in_array(28, $temp))--}}
                    {{--<li class=""><a href="{{ aurl('subdevices') }}"><i class="fa fa-desktop"></i> {{ trans('subdevices.show_devices') }}--}}
                        {{--</a></li>--}}
                            {{--@endif--}}
                    {{--<li class=""><a href="{{ aurl('subdevices/create') }}"><i--}}
                    {{--class="fa fa-plus"></i> {{ trans('subdevices.create') }}</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--@endif--}}

            @if(in_array(34, $temp))
            <li class="treeview {{ active_menu('bills')[0] }}">
                <a href="#">
                    <i class="fa fa-credit-card"></i> <span>{{ trans('bills.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('bills')[1] }}{{ active_menu('shipments')[1] }}{{ active_menu('shipping')[1] }}{{ active_menu('addtaxnames')[1] }}">
                    @if(in_array(35, $temp))
                    <li class=""><a href="{{ aurl('bills') }}"><i class="fa fa-eye"></i> {{ trans('bills.show') }}
                        </a></li>
                    @endif
                        @if(in_array(37, $temp))
                    <li class=""><a href="{{ aurl('bills/create') }}"><i
                                    class="fa fa-plus"></i> {{ trans('bills.create') }}</a></li>
                        @endif

                    {{--<li class=""><a href="{{ aurl('shipments') }}"><i class="fa fa-truck"></i> {{ trans('shipments.show') }}--}}
                    {{--</a></li>--}}
                    {{--<li class=""><a href="{{ aurl('shipments/create') }}"><i--}}
                    {{--class="fa fa-plus"></i> {{ trans('shipments.create') }}</a></li>--}}
                            {{--@if(in_array(36, $temp))--}}
                    {{--<li class=""><a href="{{ aurl('shipping') }}"><i class="fa fa-truck"></i> {{ trans('shipping.show_shipping') }}--}}
                        {{--</a></li>--}}
                            {{--@endif--}}
                        {{--<li class=""><a href="{{ aurl('addtaxnames') }}"><i class="fa fa-money"></i> {{ trans('addtaxnames.show') }}--}}
                            {{--</a></li>--}}
                    {{--<li class=""><a href="{{ aurl('shipping/create') }}"><i--}}
                    {{--class="fa fa-plus"></i> {{ trans('shipping.create') }}</a></li>--}}
                </ul>
            </li>
            @endif

        <!-- Start Project-->
<!--
            @if(in_array(41, $temp))
            <li class="treeview {{ active_menu('projects')[0] }}">
                <a href="#">
                    <i class="fa fa-tag"></i> <span>{{ trans('projects.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('projects')[1] }}{{ active_menu('projectitems')[1] }}{{ active_menu('projectcosts')[1] }}{{ active_menu('expenses')[1] }}">
                    @if(in_array(42, $temp))
                    <li class=""><a href="{{ aurl('projects') }}"><i class="fa fa-eye"></i> {{ trans('projects.show') }}
                        </a></li>
                    @endif
                        @if(in_array(44, $temp))
                    <li class=""><a href="{{ aurl('projects/create') }}"><i
                                    class="fa fa-plus"></i> {{ trans('projects.create') }}</a></li>
                        @endif

                    {{--<li class=""><a href="{{ aurl('projectitems') }}"><i class="fa fa-eye"></i> {{ trans('projectitems.show') }}--}}
                    {{--</a></li>--}}
                            @if(in_array(43, $temp))
                    <li class=""><a href="{{ aurl('expensesitems') }}"><i class="fa fa-eye"></i> {{ trans('expensesitems.show') }}
                        </a></li>
                        @endif
                    {{--<li class=""><a href="{{ aurl('expensesitems/create') }}"><i--}}
                    {{--class="fa fa-plus"></i> {{ trans('expensesitems.create') }}</a></li>--}}
                    {{--<li class=""><a href="{{ aurl('projectcosts') }}"><i class="fa fa-eye"></i> {{ trans('projectcosts.show') }}--}}
                    {{--</a></li>--}}
                    {{--<li class=""><a href="{{ aurl('projectcosts/create') }}"><i--}}
                    {{--class="fa fa-plus"></i> {{ trans('projectcosts.create') }}</a></li>--}}

                </ul>
            </li>
            @endif

            -->
            <!-- End Project-->

            {{--<li class="treeview {{ active_menu('projectcosts')[0] }}">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-copy"></i> <span>{{ trans('projectcosts.admin') }}</span>--}}
            {{--<span class="pull-right-container">--}}

            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu" style="{{ active_menu('projectcosts')[1] }}{{ active_menu('expenses')[1] }}">--}}

            {{----}}
            {{--</ul>--}}
            {{--</li>--}}
            @if(in_array(49, $temp))
            <li class="treeview {{ active_menu('invoices')[0] }}">
                <a href="#">
                    <i class="fa fa-money"></i> <span>{{ trans('invoices.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('invoices')[1] }}">
                    @if(in_array(50, $temp))
                    <li class=""><a href="{{ aurl('invoices') }}"><i class="fa fa-eye"></i> {{ trans('invoices.show') }}
                        </a></li>
                    @endif

                    <!--    @if(in_array(51, $temp))-->
                    <!--<li class=""><a href="{{ aurl('invoices/create') }}"><i-->
                    <!--                class="fa fa-plus"></i> {{ trans('invoices.create') }}</a></li>-->
                    <!--    @endif-->
                        @if(in_array(52, $temp))
                        <li class=""><a href="{{ aurl('invoices/inv/create') }}"><i
                                        class="fa fa-plus"></i>انشاء فاتورة بيع مباشر</a></li>
                            @endif
                </ul>
            </li>

        @endif

        <!-- Start imports-->
        <!--
            @if(in_array(95, $temp))
                <li class="treeview {{ active_menu('imports')[0] }}">
                    <a href="#">
                        <i class="fa fa-download"></i> <span>{{ trans('imports.admin') }}</span>
                        <span class="pull-right-container">

                    </span>
                    </a>
                    <ul class="treeview-menu" style="{{ active_menu('imports')[1] }}{{ active_menu('importnames')[1] }}{{ active_menu('banktransfers')[1] }}">
                        @if(in_array(96, $temp))
                            <li class=""><a href="{{ aurl('imports') }}"><i class="fa fa-eye"></i> {{ trans('imports.show') }}
                                </a></li>
                        @endif

                        @if(in_array(97, $temp))
                            <li class=""><a href="{{ aurl('imports/create') }}"><i
                                            class="fa fa-plus"></i> {{ trans('imports.create') }}</a></li>
                        @endif
                            @if(in_array(100, $temp))
                                <li class=""><a href="{{ aurl('importnames') }}"><i
                                                class="fa fa-eye"></i> {{ trans('importnames.show') }}</a></li>
                            @endif
                            @if(in_array(104, $temp))
                                <li class=""><a href="{{ aurl('banktransfers') }}"><i
                                                class="fa fa-eye"></i> {{ trans('banktransfers.show') }}</a></li>
                            @endif
                    </ul>
                </li>

        @endif
                -->
        <!-- Start imports-->
<!-- Start Ahmed Gorashi -->
            @if(in_array(20, $temp))
                <li class="treeview {{ active_menu('returnedbills')[0] }}">
                    <a href="#">
                        <i class="fa fa-sitemap"></i> <span>{{ trans('returned_bills.admin') }}</span>
                        <span class="pull-right-container">

                    </span>
                    </a>
                    <ul class="treeview-menu" style="{{ active_menu('items')[1] }}">
                        @if(in_array(21, $temp))
                            <li class=""><a href="{{ aurl('returnedbills') }}"><i class="fa fa-eye"></i> {{ trans('returned_bills.show') }}
                                </a></li>
                        @endif
                        @if(in_array(22, $temp))
                            <li class=""><a href="{{ aurl('returnedbills/create') }}"><i
                                            class="fa fa-plus"></i> {{ trans('returned_bills.create') }}</a></li>
                        @endif
                        {{--<li class=""><a href="{{ aurl('itemserials') }}"><i class="fa fa-eye"></i> {{ trans('itemserials.itemserials') }}--}}
                        {{--</a></li>--}}

                    </ul>
                </li>
        @endif
<!-- End Ahmed Gorashi -->
            @if(Auth::guard('admin')->user()->id == 1)
            <li class="treeview {{ active_menu('companyexpenses')[0] }}">
                <a href="#">
                    <i class="fa fa-phone"></i> <span>{{ trans('companyexpenses.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('companyexpenses')[1] }}">
                    <li class="active"><a href="{{ aurl('catcompanyexpenses') }}"><i class="fa fa-eye"></i> {{ trans('catcompanyexpenses.show') }}
                        </a></li>
                    <li class="active"><a href="{{ aurl('companyexpenses') }}"><i class="fa fa-eye"></i> {{ trans('companyexpenses.show') }}
                        </a></li>

                </ul>
            </li>
            <!-- Start taxes--> @endif
        <!--
            @if(in_array(95, $temp))
                <li class="treeview {{ active_menu('taxes')[0] }}">
                    <a href="#">
                        <i class="fa fa-download"></i> <span>{{ trans('taxes.admin') }}</span>
                        <span class="pull-right-container">

                    </span>
                    </a>
                    <ul class="treeview-menu" style="{{ active_menu('taxes')[1] }}">
                        @if(in_array(96, $temp))
                            <li class=""><a href="{{ aurl('taxes') }}"><i class="fa fa-eye"></i> {{ trans('taxes.show') }}
                                </a></li>
                        @endif
                            <li class=""><a href="{{ aurl('TaxClearance') }}"><i class="fa fa-eye"></i> {{ trans('taxes.TaxClearance') }}
                                </a></li>
                    </ul>
                </li>

            @endif
                -->
        <!-- Start taxes-->


            <!-- Start custodys-->
            @if(Auth::guard('admin')->user()->id == 1)
            <li class="treeview {{ active_menu('custodys')[0] }}">
                <a href="#">
                    <i class="fa fa-download"></i> <span>{{ trans('moneyorders.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>

                <ul class="treeview-menu" style="{{ active_menu('custodys')[1] }}{{ active_menu('moneyorders')[1] }}">
                    <li class=""><a href="{{ aurl('moneyorders') }}"><i class="fa fa-eye"></i> {{ trans('moneyorders.show') }}
                        </a></li>
                <!--
                        <li class=""><a href="{{ aurl('custodys') }}"><i class="fa fa-eye"></i> {{ trans('custodys.show') }}
                            </a></li>
                            -->

                </ul>
            </li>
            @endif
            <!-- Start taxes-->
            <li class="treeview {{ active_menu('reports')[0] }}">
                <a href="#">
                    <i class="fa fa-download"></i> <span>{{ trans('reports.admin') }}</span>
                    <span class="pull-right-container">

                    </span>
                </a>

                <ul class="treeview-menu" style="{{ active_menu('report')[1] }}">
                    <li class=""><a href="{{ aurl('report/daily/'.Auth::guard('admin')->user()->id) }}"><i class="fa fa-eye"></i> {{ trans('reports.daily') }}
                        </a></li>
                    <li class=""><a href="{{ aurl('report/monthly/'.Auth::guard('admin')->user()->id) }}"><i class="fa fa-eye"></i> {{ trans('reports.monthly') }}
                        </a></li>
                    @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                    <li class=""><a href="{{ aurl('report/items/'.Auth::guard('admin')->user()->id) }}"><i class="fa fa-eye"></i> {{ trans('reports.items') }}
                        </a></li>
                    <li class=""><a href="{{ aurl('report/store/'.Auth::guard('admin')->user()->id) }}"><i class="fa fa-eye"></i> {{ trans('reports.store') }}
                        </a></li>
                        <li class=""><a href="{{ aurl('report/locker/'.Auth::guard('admin')->user()->id) }}"><i class="fa fa-eye"></i> {{ trans('reports.locker') }}
                        </a></li>

                                            <li class=""><a href="{{ aurl('report/revenu/'.Auth::guard('admin')->user()->id) }}"><i class="fa fa-eye"></i> {{ trans('reports.revenu') }}
                        </a></li>
                    @endif

                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
