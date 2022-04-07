@extends('admin.index')
@section('page_title')
    {{trans('returned_bills.edit')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('returned_bills.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/returnedbills/')}}/{{$returned_bill->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">أضافة مورد</label>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">{{trans('suppliers.create')}}</button>
                            <br><span style="color: red">*برجاء إضافة مورد جديد قبل انشاء فاتورة</span>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" onClick="window.location.href=window.location.href">&times;</button>
                                            <h4 class="modal-title">{{trans('suppliers.create')}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{route('admin.suppliers.createBills')}}" style="height:400px;width:500px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" value="Close" class="btn btn-danger" data-dismiss="modal" onClick="window.location.href=window.location.href">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Modal -->
                        </div>
                        <label class="col-sm-1 control-label" for="name">{{trans('returned_bills.supplier_id')}}</label>

                        <div class="col-sm-3">
                            <select class="form-control select2" name="supplier_id" required>
                                <option class="form-control " value="">-----اختيار اسم المورد ----</option>
                                @foreach ($suppliers as $supplier )
                                    <option value="{{$supplier->id}}" @if($returned_bill->supplier_id == $supplier->id) selected @endif>{{ $supplier->suppliers_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-sm-1 control-label">{{trans('returned_bills.date')}}</label>
                        <div class="col-sm-2">
                            <input type="date" name="date" value="{{$returned_bill->date}}" required class="form-control" id="date" placeholder="{{trans('returned_bills.date')}}">
                        </div>
                        {{--<label for="price_before_doller" class="col-sm-1 control-label">{{trans('returned_bills.price_before_doller')}}</label>--}}
                        {{--<div class="col-sm-2">--}}
                            {{--<input type="number" step="any" name="price_before_doller" value="{{$returned_bill->price_before_doller}}" class="form-control" id="price_before_doller" placeholder="{{trans('returned_bills.price_before_doller')}}">--}}
                        {{--</div>--}}
                        {{--<label class="col-sm-1 control-label" for="name">العملة</label>--}}
                        {{--<div class="col-sm-3">--}}
                            {{--<select class="form-control" name="currency_id">--}}
                                {{--<option class="form-control" value="">-----اختيار اسم العملة ----</option>--}}
                                {{--@foreach ($currencies as $currency )--}}
                                    {{--<option value="{{$currency->id}}" @if($returned_bill->currency_id == $currency->id) selected @endif>{{ $currency->currency_name }} </option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}



                    </div>


                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('returned_bills.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('returned_bills.notes')}}">{{$returned_bill->notes}}</textarea>
                        </div>
                    </div>



                    <!-- Strat -->
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#settings" data-toggle="tab"> </a></li>
                                <li><a href="#settings2" data-toggle="tab">مجمع</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="box-body">
                                        <div class="form-group">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>اختيار اسم الماده  </th>
                                                    <th>كمية</th>
                                                    <th>المواصفة</th>
                                                    <th>الحجم</th>
                                                    <th>مصاريف الشحن</th>
                                                    <th>سعر الماده</th>
                                                    <th>الاجمالي</th>
                                                    <th>#</th>
                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">
                                                @foreach($returned_billitems as $value)

                                                    <tr id="remove'+zxc+' ">

                                                        <td>
                                                            <select class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'" required>
                                                                <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>
                                                                @foreach ($items as $item )
                                                                    <option value="{{$item->id}}" @if($value->item_id == $item->id) selected @endif>{{ $item->item_name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input id="No1" type="number"   name="quantity_b[]" value="{{$value->quantity_b}}" class="form-control"  placeholder="كمية" required>
                                                        </td>
                                                        <td>
                                                            <select name="color[]" class="form-control select2  items" data-live-search="true">
                                                                <option value=""> ----إختر المواصفة ---- </option>
                                                                @foreach($itemscolors as $itemcolor)
                                                                    <option value="{!! $itemcolor->id !!}" @if( $itemcolor->id == $value->color) selected @endif>{!! $itemcolor->name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="size[]" class="form-control select2  items" data-live-search="true">
                                                                <option value=""> ----إختر مواصفة 2 ---- </option>
                                                                @foreach($itemsizes as $itemsize)
                                                                    <option value="{!! $itemsize->id !!}" @if($itemsize->id == $value->size) selected @endif>{!! $itemsize->name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input id="No1" type="text"   name="shipping_costs[]" value="{{$value->shipping_costs}}" class="form-control"  placeholder="مصاريف الشحن" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="price_b[]"  value="{{$value->price_b}}" class="form-control" id="No2" placeholder="سعر الماده" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="total_price_b[]" value="{{$value->total_price_b}}" class="form-control" id="No3" readonly placeholder="الاجمالي" required>
                                                        </td>
                                                        <td>
                                                            <input type="button" id="remove" class="btn btn-danger " value="X" />
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>

                                            <div class="form-group">
                                                <div class="form-gourp">
                                                    <label for="total_price" class="col-sm-3 control-label"><b style="color: red">* ضع قيمة الخصم أولاً إذا كان هنالك خصم >></b></label>
                                                    <label for="total_price" class="col-sm-2 control-label">قيمة الخصم</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="discount" class="form-control" id="discount" placeholder="قيمة الخصم">
                                                    </div>
                                                </div><br><br><br>
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">سعر الاجمالي</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" value="{{$returned_bill->total_final_mgza}}" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>
                                                    <label for="total_price" class="col-sm-2 control-label">السعر بعد الخصم</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="afterdiscount" value="{{$afterdis}}" readonly class="form-control" id="mo_textm2" placeholder="السعر بعد الخصم">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة مواد جديدة</button>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- /.tab-pane -->

                                <div class="tab-pane " id="settings2">
                                    <div  class="box-body hereallzsasd">

                                        <div class="devices">
                                            @php $temp = 1; @endphp
                                            @foreach($returned_billdevices as $k => $value)
                                                <div class="row device">
                                                    <label class="col-sm-1 control-label" for="name"> اسم الجهاز</label>
                                                    <div class="col-sm-4">
                                                        {{--<input type="hidden" name="countdiv[]" class="form-control countdiv" value="{{ $k  }}" placeholder="كمية">--}}

                                                        <input type="hidden" name="devices[{{$value->device_id}}][device_id]" value="{{$value->device_id}}" readonly class="from-control">
                                                        <input type="text"  readonly value="{{$value->devices->devices_name}}" class="form-control">
                                                    </div>
                                                    <label for="value" class="col-sm-1 control-label">كمية</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="devices[{{$value->device_id}}][device_quantity]" value="{{ $value->quantity }}"  class="form-control device_quantity"  placeholder="كمية" required>
                                                    </div>
                                                    <label for="value"  class="col-sm-1 control-label">الاجمالي</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" name="devices[{{$value->device_id}}][device_total_price]" value="{{$value->total_price}}" class="form-control device_total"  readonly placeholder="الاجمالي">
                                                    </div>


                                                    <div id="gettItems">  <!-- GET ITEMS -->

                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>

                                                                        <th scope="col"> اسم الماده</th>
                                                                        <th scope="col">كمية</th>
                                                                        <th scope="col">سعر الماده</th>
                                                                        <th scope="col">الاجمالي</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($value->Billdevicesitems as $key2 => $ItemsDevices)

                                                                            <tr class="device_materials">
                                                                                <td class="col-md-3 ">
                                                                                    <input type="hidden" name="devices[{{$value->device_id}}][device_items][{{$temp}}][id]" value="{{$ItemsDevices->item_id_devices}}">
                                                                                    <input class="form-control" readonly value="{{@$ItemsDevices->items->item_name}}"/>
                                                                                </td>
                                                                                <td class="col-md-1">
                                                                                    <input  type="text" readonly name="devices[{{$value->device_id}}][device_items][{{$temp}}][qu]" value="{{$ItemsDevices->quantity_devices}}"  data-value="{{$ItemsDevices->quantity_old}}" class="form-control device_material_quantity" placeholder="كمية" required>
                                                                                    <input  type="hidden"  name="devices[{{$value->device_id}}][device_items][{{$temp}}][quantity_old]" value="{{$ItemsDevices->quantity_old}}" data-value="{{$ItemsDevices->quantity_old}}"  placeholder="كمية">

                                                                                </td>
                                                                                <td class="col-md-1">
                                                                                    <input type="text"  name="devices[{{$value->device_id}}][device_items][{{$temp}}][p]" value="{{$ItemsDevices->price_devices}}" class="form-control device_material_price" placeholder="سعر الماده" required>
                                                                                </td>
                                                                                <td class="col-md-1">
                                                                                    <input type="text" name="devices[{{$value->device_id}}][device_items][{{$temp}}][total_p]" value="{{$ItemsDevices->total_devices}}" class="form-control device_material_quantity_total" readonly  placeholder="الاجمالي">

                                                                                </td>
                                                                            </tr>
                                                                        @php $temp++ @endphp

                                                                    @endforeach

                                                                    </tbody>
                                                                </table>



                                                    </div>
                                                    <input type="button" class="btn btn-danger remove_device" value="X" />

                                                </div>
                                        @endforeach
                                        <!-- <div class="form-group" id="new_devices" ></div> -->
                                        </div>





                                        <div class="form-group ">
                                            <label for="value" class="col-sm-2 control-label">سعر الاجهزة</label>
                                            <div class="col-sm-3">
                                                <input type="text"  name="total_final_mogma3"  value="{{ $returned_bill->total_final_mogma3 }}" readonly class="form-control total_final" id="total_final" placeholder="سعر الجهاز كامل">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <button class="btn btn-success add_field_button_mo" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة جهاز جديد</button>
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
                    <div class="col-sm-2">
                        <button type="submit" name="savedraft" value="0" class="btn btn-warning pull-right">{{trans('admin.savedraft')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>

                    <div class="col-sm-2">
                        <a href="{{aurl('returnedbills/')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
                    </div>
                </div>
                <!-- /.box-footer -->
                </form>
            </form>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- Modal -->
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{route('items.store')}}"  enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-1 control-label">{{trans('items.item_name')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" required name="item_name" class="form-control" id="inputEmail3" placeholder="{{trans('items.item_name')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="specifications" class="col-sm-1 control-label">{{trans('items.specifications')}}</label>
                                    <div class="col-sm-10">
                                        <textarea name="specifications" class="form-control" placeholder="{{trans('items.specifications')}}" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="specifications" class="col-sm-1 control-label">{{trans('items.city')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="city" class="form-control" id="city" required placeholder="{{trans('items.city')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-1 control-label">{{trans('items.image')}}</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image"  id="image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="col-sm-1 control-label">{{trans('items.quantity')}}</label>
                                    <div class="col-sm-5">
                                        <input type="number" name="quantity" readonly class="form-control" id="quantity" placeholder="{{trans('items.quantity')}}">
                                    </div>
                                    <label for="quantity" class="col-sm-1 control-label">{{trans('items.price')}}</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="price" readonly  class="form-control" id="price" placeholder="{{trans('items.price')}}">
                                    </div>
                                    <label for="total_price" class="col-sm-2 control-label">الخصم بعد التخفيض</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="total_final_mgza" readonly class="form-control" id="mo_textm2" placeholder="الخصم بعد التخفيض">
                                    </div>
                                </div>
                                <div class="form-group">

                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer ">
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                                    <input type="submit" name="cancelvalue" value="CANCEL" onClick="self.close()">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <script>
            $(function () {
                var zxc = 1;
                $("#AddPdf").click(function () {

                    $("#InsertPdf").append(
                        // Add new row

                        ' <tr id="remove'+zxc+' ">' +

                        '            <td>' +
                        '                <input type="file" name="pdf[]" class="form-control"required>' +
                        '            </td>' +
                        '            <td>' +
                        '                <input type="button" id="remove" class="btn btn-danger " value="X" />' +
                        '            </td>' +
                        ' </tr>'+

                        ''
                    );
                    $('.select2').select2();
                    zxc++;
                });

                //remove selected Row
                $("#InsertPdf").on("click", "#remove", function () {
                    $(this).closest("tr").remove();

                });

            });


        </script>

        <script>
            $(function () {
                var zxc = 1;
                $("#Badd").click(function () {

                    $("#maindiv").append(
                        // Add new row

                        ' <tr id="remove'+zxc+' ">' +
                        '            <td>' +
                        '                <select class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'" required>' +
                        '                    <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>' +
                        '                    @foreach ($items as $item )' +
                        '                        <option value="{{$item->id}}">{{ $item->item_name }} </option>' +
                        '                    @endforeach' +
                        '                </select>' +
                        '            </td>' +
                        '            <td>' +
                        '                <input id="No1" type="number" name="quantity_b[]" class="form-control"  placeholder="كمية" required>' +
                        '            </td>' +
                        '            <td>' +
                        '                <select class="form-control select2  items" data-live-search="true" name="color[]" data-count="'+zxc+'" required>' +
                        '                    <option  class="form-control" value="" >--اختيار لون الماده --</option>' +
                        '                    @foreach ($itemscolors as $itemcolor )' +
                        '                        <option value="{{$itemcolor->id}}">{{ $itemcolor->name }} </option>' +
                        '                    @endforeach' +
                        '                </select>' +
                        '            </td>' +
                        '            <td>' +
                        '                <select class="form-control select2  items" data-live-search="true" name="size[]" data-count="'+zxc+'" required>' +
                        '                    <option  class="form-control" value="" >--اختيار مواصفة 2 الماده --</option>' +
                        '                    @foreach ($itemsizes as $itemsize )' +
                        '                        <option value="{{$itemsize->id}}">{{ $itemsize->name }} </option>' +
                        '                    @endforeach' +
                        '                </select>' +
                        '            </td>' +
                        '            <td>' +
                        '                <input  type="text" name="shipping_costs[]" class="form-control"  placeholder="مصاريف الشحن" required>' +
                        '            </td>' +
                        '            <td>' +
                        '               <input type="text" name="price_b[]" class="form-control" id="No2" placeholder="سعر الماده" required>' +
                        '            </td>' +
                        '            <td>' +
                        '                <input type="text" name="total_price_b[]" class="form-control" id="No3" readonly placeholder="الاجمالي" required>' +
                        '            </td>' +
                        '            <td>' +
                        '                <input type="button" id="remove" class="btn btn-danger " value="X" />' +
                        '            </td>' +
                        ' </tr>'+

                        ''
                    );
                    $('.select2').select2();
                    zxc++;
                });

                //remove selected Row
                $("#maindiv").on("click", "#remove", function () {
                    $(this).closest("tr").remove();

                });

                //field No1 calculation
                $("#maindiv").on("keyup", "#No1", function () {
                    var x = $(this).val();
                    var y = $(this).closest("tr").find("input[id='No2']").val();
                    var z = parseFloat(x) * parseFloat(y);
                    $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                    sum();
                })

                //field No2 calculation
                $("#maindiv").on("keyup", "#No2", function () {
                    var x = $(this).val();
                    var y = $(this).closest("tr").find("input[id='No1']").val();
                    var z = parseFloat(y) * parseFloat(x);
                    $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                    sum();
                })

                //Sum All No3
                function sum() {
                    var sum = 0;
                    $("input[id *='No3']").each(function () {
                        sum += +$(this).val();
                    });
                    $("#mo_textm").val(Math.round(sum * 100) / 100 );
                    discont()
                };

                function discont() {
                    var sum = 0;
                    var disc = $("input[id *='discount']").val();
                    var dec = (disc / 100).toFixed(2);
                    $("input[id *='No3']").each(function () {
                        sum += +$(this).val();
                    });

                    $("#mo_textm2").val(Math.round(sum) - disc);
                };
            });

        </script>



        {{--Get Devices--}}
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on("change",".devic",function(){
                    var count = $(this).attr('selectNumber');
                    $.get("{{ route('deviceid') }}/"+ $(this).val(), function(data){

                        $("#gettItems"+count).last().html(data);
                        $('.select2').select2();
                    });


                    $(this).attr('name', 'devices['+$(this).val()+'][device_id]');

                    $('.device_quantityy'+count).attr('name', 'devices['+$(this).val()+'][device_quantity]');
                    $('.device_total_price'+count).attr('name', 'devices['+$(this).val()+'][device_total_price]');

                    $('#remove'+count).find('.device').attr('name', 'quantity['+$(this).val()+']');

                });
            });
        </script>

        <script>

            $(function () {
                var i = 1;
                // add new row in Main Dive
                $("#add_devices").click(function () {

                    $(".devices").append(

                        '<div class="row device" >'+
                        '<label class="col-sm-1 control-label" for="name"> اسم الجهاز</label>'+
                        '<div class="col-sm-4">'+
                        '<input type="hidden" name="countdiv[]" class="form-control countdiv" value="'+i+'" placeholder="كمية">'+
                        '<select class="form-control  devic select2" selectNumber="'+i+'" name="devices[][device_id]" required>'+
                        '<option class="form-control" value="null" >-----اختيار اسم الجهاز ----</option>'+
                        '@foreach ($devices as $device)'+
                        '<option value="{{$device->id}}">{{ $device->devices_name }} </option>'+
                        '@endforeach'+
                        '</select>'+
                        '</div>'+
                        '<label for="value" class="col-sm-1 control-label">كمية</label>'+
                        '<div class="col-sm-3">'+
                        '<input type="text" id="Nu1" name="devices[][device_quantity]" class="form-control device_quantity device_quantityy'+i+'"  placeholder="كمية" required>'+
                        '</div>'+
                        '<label for="value"  class="col-sm-1 control-label">الاجمالي</label>'+
                        '<div class="col-sm-2">'+
                        '<input id="Nu31" type="text" name="devices[][device_total_price]" class="form-control device_total device_total_price'+i+'"  readonly placeholder="الاجمالي">'+
                        '</div>'+
                        '<div id="gettItems'+i+'"></div>'+
                        '<input type="button" class="btn btn-danger remove_device" value="X" />'+
                        '</div>'
                    );
                    i++;
                    $('.select2').select2();
                });

                //remove selected Row
                // $("#devices").on("click", ".btn", function () {
                //     $(this).parent().remove();
                //
                // });


            });


        </script>
    @include('admin.bills.script')
@endsection
