<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> offer
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('asst/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('asst/bower_components/font-awesome/css/font-awesome.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('asst_ar/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{url('asst_ar/dist/css/bootstrap-rtl.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Cairo:300,400&amp;subset=arabic,latin-ext" rel="stylesheet">
    <style type="text/css">
        html,body,alart,h1,h2,h3,h4,h5,h6{
            font-family: 'Cairo', sans-serif;
        }
    </style>

    <link rel="stylesheet" href="{{url('js/select2.min.css')}}">




    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        #myDIV {
            width: 100%;
            padding: 50px 0;
            text-align: center;
            background-color: lightblue;
            margin-top: 20px;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
</head>
<body class="sidebar-mini skin-purple">

@include('admin.layouts.message')
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<!-- <a href="{{$links}}" class="btn btn-warning btn-lg btn-block" style="margin-top: 10%;margin-bottom: 10%" target="_blank">الانستجرام</a> -->
<div class="col-md-6">
    <button onclick="myFunction()" class="btn btn-primary btn-lg btn-block" style="margin-top: 10%;margin-bottom: 10%">زبون سابق</button>
    
</div>
<div class="col-md-6">
    <button onclick="myFunctionNew()" class="btn btn-info btn-lg btn-block" style="margin-top: 10%;margin-bottom: 10%">زبون جديد</button> 
  
 
</div>

@foreach($links as $link)
<div class="col-md-3" >
<a href="{{$link->link}}" class="btn btn-warning btn-lg btn-block" style="margin-top: 10%;margin-bottom: 10%" target="_blank">{{$link->name}}</a>
    
</div>
@endforeach




<div id="myDIV" style="display: none">
</div>

<p style="padding: 15px"><b>قم بإختيار إحدى التصنيفين ..</b></p>


<!-- Main content -->
<section class="content" id="oldCustomer" style="display: none">

    <div class="wrapper">

        <div class="box">
            <div class="box-header">
                <h2>{{$offer->name}} <img  src="{{url('upload/offers/'.$offer->image)}}" style="max-width: 100px; max-height: 100px;float:left" alt="" /></h2>
            </div>


            <!-- Start Ahmed Gorashi-->
            <div class="box-body">
                <form class="form-horizontal" method="POST" autocomplete="off" action="{{route('users.login')}}" id="hidd" enctype="multipart/form-data">
                    <input hidden name="id" value="0">
                    {{csrf_field()}}
                    {{--                        <input type="hidden" name="_token" value="dEp4Uj6e4Hfc4nMzRBnP1te1UTLeO9xrld6RzU2z">--}}
                    
                    <div class="box-body">
                        
                        <div class="form-group">
                            <input type="hidden" name="offer" value="{{$offer->id}}">
                            <input type="hidden" name="client_id" value="">
                            <label for="name_client" id="n" class="col-sm-1 control-label">  الايميل</label>
                            <div class="col-sm-3">
                                <input type="hidden" name="offer" class="form-control"  placeholder="الايميل" value="{{$offer->id}}">
                                <input type="email" name="email" class="form-control" id="name_client" placeholder="الايميل" required value="">
                            </div>
                            <label for="city" id="p" class="col-sm-1 control-label">الباسورد</label>
                            <div class="col-sm-3">
                                <input type="password" name="password" class="form-control" id="name_client" placeholder="الباسورد" required value="">
                            </div>
                        </div>
                        

                        <div class="form-group">

                            <table class="table table-bordered">
                                <thead>
                                <tbody id="InsertPdf">

                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for="notes" class="col-sm-1 control-label"> ملاحظات</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="notes" name="notes" placeholder=" ملاحظات"></textarea>
                            </div>
                        </div>



                        <!-- Strat -->
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#settings" data-toggle="tab"> </a></li>

                                </ul>
                                <div class="form-group">
                                    <div class="col-sm-5"></div>

                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="settings">

                                        <div class="box-body">
                                            <div class="form-group">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اختيار اسم الماده</th>
                                                        <th>المواصفة</th>
                                                        <th>مواصفة 2</th>
                                                        <th>سعر البيع</th>
                                                        <th>الصورة</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody id="maindiv">
                                                    @foreach($offer->items as $item)
                                                        <tr id="remove'+zxc+' ">
                                                            <td> <img  src="{{url('upload/offers/'.$item->image)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>
                                                            <td>
                                                                <select required id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'">
                                                                    <option  class="form-control" value="{{$item->id}}" >{{$item->item_name}}</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select required id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="color[]" data-count="'+zxc+'">
                                                                    <option  class="form-control" value="" >-----اختيار المواصفة ----</option>
                                                                    @foreach($specifications as $color)
                                                                        <option value="{{$color->specificolor->id}}">{{$color->specificolor->name}}  </option>
                                                                    @endforeach
                                                                </select>

                                                            </td>
                                                            <td>
                                                                <select required id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="size[]" data-count="'+zxc+'" >
                                                                    <option  class="form-control" value="" >-----اختيار مواصفة 2 ----</option>
                                                                    @foreach($specifications as $size)
                                                                        <option value="{{$size->specificsize->id}}">{{$size->specificsize->name}}  </option>
                                                                    @endforeach
                                                                </select>

                                                            </td>


                                                            <td>
                                                                <input type="text" name="price_b[]" value="{{$offer->selling_price}}" readonly class="form-control" id="No2" placeholder="سعر الماده" >
                                                            </td>
                                                            <td>
                                                                <img  src="{{url('upload/items/'.$item->image)}}" style="max-width: 100px; max-height: 100px;" alt="" />
                                                            </td>
                                                            {{--                                                                       <td>--}}
                                                            {{--                                                                                <input type="button" id="remove" class="btn btn-danger " value="X" />--}}
                                                            {{--                                                                           </td>--}}
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label"> سعر العرض</label>
                                                        <div class="col-sm-3">
                                                            <input hidden type="text" id="Input4" name="offerPrice" class="form-control" readonly value="{{$offer->price}}">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label">مصاريف الشحن</label>
                                                        <div class="col-sm-3">
                                                            <!-- <input type="text" name="shipping_costs" id="shippingCosts" class="form-control" placeholder="مصاريف الشحن"> -->
                                                            <select name="shipping_costs" id="shippingCosts1" class="form-control select2" onchange="calculate1()" required>
                                                                <option value="">   -----   اختيار المدينة     ----- </option>
                                                                @foreach($cities as $city)
                                                                    <option value="{{$city->shipping}}">{{$city->name}} - {{$city->shipping}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label">عدد القطع</label>
                                                        <div class="col-sm-3">
                                                            <input type="number" min="1" id="Input3" max="{{$offer->quantity_b}}" oninput="calculate1()" name="offerQuan" class="form-control" id="quant" placeholder="عدد القطع">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="colcolet">
                                                    {{--                                                        <div class="form-group">--}}
                                                    {{--                                                            <div class="form-group">--}}
                                                    {{--                                                                <label for="total_price" class="col-sm-2 control-label">مصاريف الشحن</label>--}}
                                                    {{--                                                                <div class="col-sm-3">--}}
                                                    {{--                                                                    <input type="text" name="shipping_costs" id="shippingCosts" class="form-control" placeholder="مصاريف الشحن">--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                        </div>--}}



                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label for="total_price" class="col-sm-2 control-label">صافي الفاتورة</label>
                                                            <div class="col-sm-3">
                                                                <input type="number" id="final1" name="afterdiscount" readonly class="form-control" value="{{$offer->price}}" id="tP" placeholder="صافي الفاتورة">
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane " id="settings2">

                                        <div class="box-body hereallzsasd">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>اختيار اسم الجهاز</th>
                                                    <th>كمية</th>
                                                    <th>سعر الافرادي</th>


                                                    <th>الاجمالي</th>

                                                </tr>
                                                </thead>
                                                <tbody id="devices">

                                                </tbody>
                                            </table>
                                            <br>
                                            <div class="form-group ">
                                                <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة جهاز </button>
                                            </div>
                                            <br>

                                            <div class="form-group ">
                                                <label for="value" class="col-sm-1 control-label">سعر الاجهزة</label>
                                                <div class="col-sm-5">
                                                    <input type="text" name="total_final_mogma3"  readonly class="form-control total_final2" id="total_final" placeholder="سعر الجهاز كامل">
                                                </div>
                                            </div>


                                        </div>
                                        <!-- /.box-body -->

                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->





                        <!--End -->



                    </div><!-- /.box-body -->
                    <div class="box-footer ">
                        <div class="col-sm-1">
                            <button type="submit" name="savedraft" value="1" class="btn btn-primary pull-right">اطلب الان زبون جديد</button>
                        </div>


                    </div>
                </form>
            </div>
            <!-- End Ahmed Gorashi -->
            <br><br><br><br>

        </div>
    </div>
</section>
<!-- /.content -->
<!-- Main content -->
<section class="content" id="newCustomer" style="display: none">

    <div class="wrapper">

        <div class="box">
            <div class="box-header">
                <h2>{{$offer->name}} <img  src="{{url('upload/offers/'.$offer->image)}}" style="max-width: 100px; max-height: 100px;float:left" alt="" /></h2>
            </div>



            <!-- Start Ahmed Gorashi-->
            <div class="box-body">
                <form class="form-horizontal" method="POST" autocomplete="off" action="{{route('users.register')}}" id="hidd" enctype="multipart/form-data">
                    <input hidden name="id" value="0">
                    {{csrf_field()}}
                    {{--                        <input type="hidden" name="_token" value="dEp4Uj6e4Hfc4nMzRBnP1te1UTLeO9xrld6RzU2z">--}}
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#settings" data-toggle="tab"> </a></li>

                            </ul>
                            <div class="form-group">
                                <div class="col-sm-5"></div>

                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="box-body">
                                        <div class="form-group">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>

                                                    <th>اختيار اسم الماده</th>
                                                    <th>المواصفة</th>
                                                    <th>مواصفة 2</th>
                                                    <th>المصدر</th>
                                                    <th>سعر البيع</th>
                                                    <th>الصورة</th>
                                                    <th>#</th>
                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">
                                                @foreach($offer->items as $item)
                                                    <tr id="remove'+zxc+' ">
                                                        <td>
                                                            <select required id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'">
                                                                <option  class="form-control" value="{{$item->id}}" >{{$item->item_name}}</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select required id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="color[]" data-count="'+zxc+'">
                                                                <option  class="form-control" value="" >-----اختيار المواصفة ----</option>
                                                                @foreach($specifications as $color)
                                                                    <option value="{{$color->specificolor->id}}">{{$color->specificolor->name}}  </option>
                                                                @endforeach
                                                            </select>

                                                        </td>
                                                        <td>
                                                            <select required id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="size[]" data-count="'+zxc+'" >
                                                                <option  class="form-control" value="" >-----اختيار مواصفة 2 ----</option>
                                                                @foreach($specifications as $size)
                                                                    <option value="{{$size->specificsize->id}}">{{$size->specificsize->name}}  </option>
                                                                @endforeach
                                                            </select>

                                                        </td>
                                                        <td hidden>
                                                        <select required id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="source" data-count="'+zxc+'" >
                                                                <option  class="form-control" value="" >-----اختيار المصدر ----</option>
                                                                @foreach($sources as $source)
                                                                    <option value="{{$source->id}}" selected >{{$source->name}}</option>
                                                                    @break
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" min="1" max="{{$offer->quantity_b}}" id="myInput1" name ="offerQuan"  oninput="calculate()"  class="form-control"  placeholder="عدد القطع" >
                                                        </td>
                                                        <td>
                                                            <input type="text" name="price_b[]" value="{{$offer->selling_price}}" readonly class="form-control" id="No2" placeholder="سعر الماده" >
                                                        </td>
                                                        <td>
                                                            <img  src="{{url('upload/items/'.$item->image)}}" style="max-width: 100px; max-height: 100px;" alt="" />
                                                        </td>
                                                        {{--                                                                       <td>--}}
                                                        {{--                                                                                <input type="button" id="remove" class="btn btn-danger " value="X" />--}}
                                                        {{--                                                                           </td>--}}
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label"> سعر العرض</label>
                                                    <div class="col-sm-3">
                                                        <input  type="text" id="myInput2" name ="offerPrice"  class="form-control" readonly value="{{$offer->price}}">
                                                    </div>
                                                </div>

                                            </div>
                                           
                                            <div id="colcolet"> 
                                                    <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">مصاريف الشحن</label>
                                                    <div class="col-sm-3">
                                                        <!-- <input type="text" name="shipping_costs" id="shippingCosts" class="form-control" placeholder="مصاريف الشحن"> -->
                                                        <select name="shipping_costs" id="shippingCosts" class="form-control select2" onchange="calculate()" required>
                                                            <option value="">   -----   اختيار المدينة     ----- </option>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->shipping}}">{{$city->name}} - {{$city->shipping}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="total_price" class="col-sm-2 control-label">صافي الفاتورة</label>
                                                        <div class="col-sm-3">
                                                            <input type="number" name="finalbill" readonly class="form-control" id="final" placeholder="صافي الفاتورة">
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- /.tab-pane -->

                          
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                  <div class="col-md-12 row-block">
                                      <br>
                                      <br>
                                      <br>
                                      <br>
                                      
                                      <a href="{{ url('auth/facebook') }}" class="btn btn-lg btn-primary btn-block">
                                          <strong>Login With Facebook</strong>
                                      </a>     
                                  </div>
                              </div>
                          </div>
                        <div class="form-group">
                            <input type="hidden" name="offer" value="{{$offer->id}}">
                            <input type="hidden" name="client_id" value="">
                            <label for="name_client" id="n" class="col-sm-1 control-label">  الايميل</label>
                            <div class="col-sm-3">
                                <input type="email" name="email" class="form-control" id="name_client" placeholder="الايميل" value="">
                            </div>
                            <label for="city" id="p" class="col-sm-1 control-label">الباسورد</label>
                            <div class="col-sm-3">
                                <input type="password" name="password" class="form-control" id="name_client" placeholder="الباسورد" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="client_id" value="138">
                            <label for="name_client" class="col-sm-1 control-label">  اسم الزبون</label>
                            <div class="col-sm-3">
                                <input type="text" name="name_client" class="form-control" id="name_client" placeholder="  اسم الزبون" value="" required>
                            </div>

                            
                            <label for="city" class="col-sm-1 control-label" >المدينة</label>
                            <div class="col-sm-3">
                                <input name="city" placeholder="المدينة" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes"  class="col-sm-1 control-label">تفاصيل العنوان</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" id="address"  name="notes_client" placeholder="تفاصيل العنوان"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-1 control-label">رقم التليفون</label>
                            <div class="col-sm-7">
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="رقم التليفون" value="">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-1 control-label"> رقم التليفون إختياري</label>
                            <div class="col-sm-7">
                                <input type="text" name="phone1" class="form-control" id="phone1" placeholder="رقم التليفون إختياري" value="">
                            </div>
                            
                        </div>

                       


                        <div class="form-group">

                            <table class="table table-bordered">
                                <thead>
                                {{--                                    <tr>--}}
                                {{--                                        <th>تحميل PDF</th>--}}

                                {{--                                        <th>--}}
                                {{--                                            <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="AddPdf" type="button"><i class="glyphicon glyphicon-plus"></i> </button>--}}

                                {{--                                        </th>--}}
                                {{--                                    </tr>--}}
                                </thead>
                                <tbody id="InsertPdf">

                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for="notes" class="col-sm-1 control-label"> ملاحظات</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="notes" name="notes" placeholder=" ملاحظات"></textarea>
                            </div>
                        </div>



                        <!-- Strat -->
                        <!-- /.col -->
                     
                        <!-- /.col -->





                        <!--End -->



                    </div><!-- /.box-body -->
                    <div class="box-footer ">
                        <div class="col-sm-1">
                            <button type="submit" name="savedraft" value="1" class="btn btn-primary pull-right">اطلب الان زبون جديد</button>
                        </div>


                    </div>
                </form>
            </div>
            <!-- End Ahmed Gorashi -->
            <br><br><br><br>

        </div>
    </div>
</section>
<!-- /.content -->
<script>
    function calculate()
    {
    var x = document.getElementById('myInput1').value;
    var y = document.getElementById('myInput2').value; 
    var shipping = document.getElementById("shippingCosts");
    var shi = parseInt(shipping.options[shipping.selectedIndex].value);
    document.getElementById('final').value = (parseInt(x)*parseInt(y))+shi;
   }
   function calculate1()
    {
    var x = document.getElementById('Input3').value;
    var y = document.getElementById('Input4').value; 
    var shipping = document.getElementById("shippingCosts1");
    var shi = parseInt(shipping.options[shipping.selectedIndex].value);
    document.getElementById('final1').value = (parseInt(x)*parseInt(y))+shi;
   }
   
    function myFunction() {
        var x = document.getElementById("oldCustomer");
        var y = document.getElementById("newCustomer");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    function myFunctionNew() {
        var x = document.getElementById("newCustomer");
        var y = document.getElementById("oldCustomer");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

         
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- /.content -->


<!-- /.content-wrapper -->
<footer class="main-footer no-print" style="text-align: center">

    <strong>Copyright &copy; 2020 <a href="https://perfect-workgroup.com">Perfect-workgroup.com</a>.</strong> All rights
    reserved.

</footer>









<!-- Select2 -->
<script src="{{url('asst/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<!-- FastClick -->
<script src="{{url('asst/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('asst/dist/js/adminlte.min.js')}}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
        //Money Euro
        $('[data-mask]').inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })

        $('.selectpicker').selectpicker({});

    })



</script>

<script>
    $('#quant').change(function () {
        var count = $('#quant').val();
        // console.log(count);
        var price = count * parseInt({{$offer->price}});
        // console.log(price);
        $('#total').text(price);
        $('#tP').val(price);
    });
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#loginForm').submit(function (event) {
        event.preventDefault();
        var postData ={
            'email':$('#loginEmail').val() ,
            'password':$('#loginPassword').val() ,
        } ;

        $.ajax({
            type:'POST',
            url:'/login',
            data: postData,
            success: function(response){
                console.log(response['client_position']);
                console.log();
                $('input[name="name_client"]').val(response['name_client']);
                $('input[name="country"]').val(response['country']);
                $('input[name="city"]').val(response['city']);
                $('#address').val(response['client_position']);
                $('#notes').val(response['notes']);
                $('input[name="phone"]').val(response['phone']);
                $('input[name="postal"]').val(response['postalCode']);
                $('input[name="id"]').val(response['id']);
                $('#loginForm').hide();
                $('input[name="email"]').hide();
                $('input[name="password"]').hide();
                $('#n').hide();
                $('#p').hide();
                $('#client').text('Welcome '+response['name_client']);
            },
            error: function (response) {
                $('.alert-danger').text(response.responseJSON.error);
                $('.alert-danger').show();
                $('.alert').fadeOut(4000);
            }
        })
    })
</script>
</body>
</html>


