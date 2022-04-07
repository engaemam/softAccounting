@extends('admin.index')
@section('page_title')
    {{trans('bills.edit')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('bills.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/bills/')}}/{{$bill->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">

                        <label class="col-sm-1 control-label" for="name">{{trans('bills.supplier_id')}}</label>

                        <div class="col-sm-3">
                            <select class="form-control select2" name="supplier_id" required>
                                <option class="form-control " value="">-----اختيار اسم المورد ----</option>
                                @foreach ($suppliers as $supplier )
                                    <option value="{{$supplier->id}}" @if($bill->supplier_id == $supplier->id) selected @endif>{{ $supplier->suppliers_name }} </option>
                                @endforeach
                            </select>
                        </div>


                    </div>



                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('bills.notes')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="notes" placeholder="{{trans('bills.notes')}}">{{$bill->notes}}</textarea>
                        </div>
                    </div>



                    <!-- Strat -->
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">


                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="col-sm-5"></div>

                                                <div class="col-sm-4">
                                                    <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> اضافة مواد</button>
                                                </div>
                                                <div class="col-sm-3"></div>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>اختيار اسم الماده</th>
                                                    <th>المواصفة</th>
                                                    <th>مواصفة 2</th>
                                                    <th> الكميه</th>
                                                    <th> السعر</th>
                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">

                                                @foreach($billitems as $key=>$value)

                                                    @if(count($value->unique('color'))== 1)
                                                    <tr id="remove{{$key}} ">
                                                        <td>
                                                            <input name="bill_id"  type="hidden" value="{{$value[0]->id}}">
                                                            <select id="items{{$key}}" class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="{{$key}}" required>
                                                                <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>
                                                                @foreach ($items as $item )
                                                                    <option value="{{$item->id}}" @if($value[0]->item_id == $item->id) selected @endif>{{ $item->item_name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td>


                                                            <select class="form-control colors"  id="getColor{{$key}}" data-live-search="true" name="color[]" data-count="{{$key}}" required>
                                                                <option class="form-control" value="">-----أختر مواصفة المادة ----</option>
                                                                @foreach ($value[0]->item_color->unique('color_id') as $color )

                                                                    <option value="{{$color->specificolor->id}}" @if($color->color_id == $value[0]->color) selected @endif>{{ @$color->specificolor->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <div id="getSize{{$key}}">

                                                            <table  id=""  class="table table-bordered table-striped ">

                                                                @foreach($value as $key_item=> $item_color)

                                                                        <tr>
                                                                            <td><input type="checkbox" checked name="u_size[{{$value[0]->item_id}}][{!! $value[0]->color !!}][]" value="{!! $item_color->size !!}" > {{ @$item_color->Size->name }}</td>
                                                                            <td><input id="No1" type="number" name="u_quantity[{{$value[0]->item_id}}][{!! $value[0]->color !!}][]"   class="form-control q{{$key}} u_quantity" value="{{$item_color->quantity_b}}" ></td>
                                                                            <td><input id="No2" type="number" name="u_price[{{$value[0]->item_id}}][{!! $value[0]->color !!}][]"  value="{{$item_color->price_b}}"  class="form-control p{{$key}} u_price" ></td>
                                                                            <td><input id="No3" type="text" name="total_price_b[]" class="form-control t{{$key}}"  value="{{$item_color->total_price_b_egy}}"   readonly placeholder="الاجمالي" required>
                                                                        </tr>


                                                                @endforeach

                                                            </table>
                                        </div>
                                                        </td>
                                                        <td>
                                                            <input id="No1" type="number" name="quantity_b[]" class="form-control"  placeholder="كمية" >
                                                        </td>
                                                        <td>
                                                            <input type="text" name="price_b[]" class="form-control" id="No2" placeholder="سعر الماده" >
                                                        </td>


                                                    </tr>
                                                  @else
                                                        @foreach ($value[0]->item_color->unique('color_id') as $item_key=>$more_color )

                                                            <tr id="remove{{$item_key+1}} ">
                                                                <input name="bill_id"  type="hidden" value="{{$value[0]->id}}">

                                                                <td>
                                                                    <select id="items{{$item_key+1}}" class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="{{$item_key+1}}" required>
                                                                        <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>
                                                                        @foreach ($items as $item )
                                                                            <option value="{{$item->id}}" @if($value[0]->item_id == $item->id) selected @endif>{{ @$item->item_name }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>

                                                                <td>


                                                                    <select class="form-control colors"  id="getColor{{$item_key+1}}" data-live-search="true" name="color[]" data-count="{{$item_key+1}}" required>
                                                                        <option class="form-control" value="">-----أختر مواصفة المادة ----</option>
                                                                        @foreach ($value[0]->item_color->unique('color_id') as $color )

                                                                            <option value="{{$color->specificolor->id}}" @if($color->color_id == $value[$item_key]->color) selected @endif>{{ @$color->specificolor->name }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>

                                                                <td>
                                                                    <div id="getSize{{$item_key+1}}">

                                                                    <table class="table table-bordered table-striped ">

                                                                        @foreach($value->groupby('color') as $item_key_item3=> $item_color3)
                                                                        @if($more_color->color_id == $item_key_item3)
                                                                        @foreach($item_color3 as $item_key_item=> $item_color2)


                                                                                <tr>
                                                                                    <td><input type="checkbox" checked name="u_size[{{$value[0]->item_id}}][{!! $value[0]->color !!}][]" value="{!! @$item_color2->size !!}" > {{ @$item_color2->Size->name }}</td>
                                                                                    <td><input id="No1" type="number" name="u_quantity[{{$value[0]->item_id}}][{!! $value[0]->color !!}][]"   class="form-control q{{$item_key+1}} u_quantity" value="{{@$item_color2->quantity_b}}" ></td>
                                                                                    <td><input id="No2" type="number" name="u_price[{{$value[0]->item_id}}][{!! $value[0]->color !!}][]"  value="{{@$item_color2->price_b}}"  class="form-control p{{@$item_key+1}} u_price" ></td>
                                                                                    <td><input id="No3" type="text" name="total_price_b[]" class="form-control t{{$item_key+1}}"  value="{{@$item_color2->price_b*$item_color2->quantity_b}}"   readonly placeholder="الاجمالي" required>
                                                                                </tr>


                                                                        @endforeach

                                                                            @endif
                                                                        @endforeach
                                                                    </table>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input id="No1" type="number" name="quantity_b[]" class="form-control"  placeholder="كمية"  value="0">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="price_b[]" class="form-control" id="No2" placeholder="سعر الماده" value="0">
                                                                </td>


                                                            </tr>
                                                            @endforeach
                                                    @endif
                                                @endforeach

                                                {{--<tr id="remove{{$key}}">--}}

                                                {{--<td>--}}
                                                {{--<select class="form-control select2  items{{$key}}" data-live-search="true" name="item_id[]" data-count="{{$key}}" required>--}}
                                                {{--<option  class="form-control" value="" >-----اختيار اسم الماده ----</option>--}}
                                                {{--@foreach ($items as $item )--}}
                                                {{--<option value="{{$item->id}}" @if($value->item_id == $item->id) selected @endif>{{ $item->item_name }} </option>--}}
                                                {{--@endforeach--}}
                                                {{--</select>--}}
                                                {{--</td>--}}
                                                {{--<td>--}}


                                                {{--<select name="color[]" class="form-control select2  items"  id="getColor{{$key}}" data-count="{{$key}}" data-live-search="true">--}}
                                                {{--<option value=""> ----إختر المواصفة ---- </option>--}}
                                                {{--@foreach($itemscolors as $itemcolor)--}}
                                                {{--<option value="{!! $itemcolor->id !!}" @if( $itemcolor->id == $value->color) selected @endif>{!! $itemcolor->name !!}</option>--}}
                                                {{--@endforeach--}}
                                                {{--</select>--}}
                                                {{--</td>--}}
                                                {{--<td>--}}

                                                {{--<select name="size[]" class="form-control select2  items" id="getSize{{$key}}" data-count="{{$key}}" data-live-search="true">--}}
                                                {{--<option value=""> ----إختر مواصفة 2 ---- </option>--}}
                                                {{--@foreach($itemSizes as $itemSize)--}}
                                                {{--<option value="{!! $itemSize->size !!}" @if($itemSize->size == $value->size) selected @endif>{!! @$itemSize->specificsize->name !!}</option>--}}
                                                {{--@endforeach--}}
                                                {{--</select>--}}
                                                {{--</td>--}}

                                                {{--<td>--}}
                                                {{--<input type="text" class="quantity{{$key}} q_change" id="q_change"  value="0" name="quantity[]"  />--}}
                                                {{--</td>--}}
                                                {{--<td>--}}
                                                {{--<input type="text" class="price{{$key}} p_change" value="0" id="p_change"  name="price[]"  />--}}

                                                {{--</td>--}}
                                                {{--<td>--}}
                                                {{--<input type="button" id="remove" class="btn btn-danger " value="X" />--}}
                                                {{--</td>--}}
                                                {{--</tr>--}}
                                                </tbody>
                                            </table>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="total_price" class="col-sm-2 control-label">إجمالي سعر الأصناف</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="total_final_mgza" value="{{$bill->total_final_mgza}}" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                                    </div>

                                                </div>
                                            </div>







                                        </div>
                                    </div>
                                </div>

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
                        <a href="{{aurl('bills')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
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
        <script type="text/javascript">

            $(document).on("change",".items",function(){
                var count = $(this).attr('data-count');

                $.get("{{ route('itemsid') }}/"+ $(this).val(), function(data){
                    $("#go"+count).html(data);
                });
                $.get("{{ route('getItemsQuantity') }}/"+ $(this).val(), function(data){
                    $("#getQuantity"+count).html(data);
                });
                $.get("{{ route('getItemsColor') }}/"+ $(this).val(), function(data){
                    $("#getColor"+count).html(data);
                });
            });

        </script>
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


        <script type="text/javascript">

            $(document).on("change",".colors",function(){
                var count = $(this).attr('data-count');
                var itemId = $('#items'+count).val();
                var colorId = $(this).val();
                var sizeId = $('#items'+count).val();


                $.get("{{ route('getItemsSize') }}/"+ itemId + '/' + colorId +'/' + count, function(data){

                    $("#getSize"+count).empty().html(data);


                });

                $.get("{{ route('getItemsPrice') }}/"+ itemId + '/' + colorId + '/' + sizeId, function(data){

                    $("#getPrice"+count).empty().html(data);
                });
            });

        </script>
        <script>
            $(function () {
                var zxc = 999;
                $("#Badd").click(function () {

                    $("#maindiv").append(
                        // Add new row

                        ' <tr id="remove'+zxc+' ">' +
                        '            <td>' +
                        '                <select id="items'+zxc+'" class="form-control select2  items" data-live-search="true" name="item_id[]" data-count="'+zxc+'" required>' +
                        '                    <option  class="form-control" value="" >-----اختيار اسم الماده ----</option>' +
                        '                    @foreach ($items as $item )' +
                        '                        <option value="{{$item->id}}">{{ $item->item_name }} </option>' +
                        '                    @endforeach' +
                        '                </select>' +
                        '            </td>' +
                        '            <td>' +
                        '                <select class="form-control colors"  id="getColor'+zxc+'" data-live-search="true" name="color[]" data-count="'+zxc+'" required>' +
                        '                    <option class="form-control" value="">-----أختر مواصفة المادة ----</option>' +
                        '<color>red<color>                ' +
                        '</select>' +
                        '            </td>' +
                        '            <td>' +
                        '                <div class="quantity" id="getSize'+zxc+'" data-live-search="true" data-count="'+zxc+'" required>' +
                        '                </div>' +
                        '            </td>' +
                        // '            <td>' +
                        // '                <div id="getQuantity'+zxc+'" name="quantity_b[]" ></div>' +
                        // '            </td>' +
                        // '            <td>' +
                        // '                <div id="getPrice'+zxc+'" name="price_b[]" ></div>' +
                        // '            </td>' +
                        // '            <td>' +
                        // '                <input type="text" name="total_price_b[]" class="form-control" id="No3" readonly placeholder="الاجمالي" required>' +
                        // '            </td>' +
                        '            <td>' +
                        '                <input type="text" class="quantity'+zxc+' q_change" id="q_change"  value="0" name="quantity[]"  />' +
                        '' +

                        '            </td>' +
                        '            <td>' +
                        '                <input type="text" class="price'+zxc+' p_change" value="0" id="p_change"  name="price[]"  />' +

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
                });

                //field No2 calculation
                $("#maindiv").on("keyup", "#No2", function () {
                    var x = $(this).val();
                    var y = $(this).closest("tr").find("input[id='No1']").val();
                    var z = parseFloat(y) * parseFloat(x);
                    $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                    sum();
                });
                //////////////////////////////////////////////////////////////
                //field No2 calculation
                $("#maindiv").on("keyup", "#No3", function () {
                    // var x = $(this).val();
                    // var y = $(this).closest("tr").find("input[id='No1']").val();
                    // var z = parseFloat(y) * parseFloat(x);
                    // $(this).closest("tr").find("input[id='No3']").val(z);

                    sum();
                });


                $("#maindiv").on("keyup", ".q_change", function () {

                    var x = $(this).val();
                    var y = $(this).closest("tr").find("input[id='No1']").val(x);
                    var y2 = $(this).closest("tr").find("input[id='No2']").val();
                    var z = parseFloat(y2) * parseFloat(x);
                    $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                    var check = $(this).closest("tr").find("select[class='form-control colors']").val();

                    if(check == 20){
                        var no3 =$(this).closest("tr").find("input[id='No3']").val();

                        if(no3 == undefined) {
                            $(this).append(' <input type="hidden"  value="0"  id="No3"  />');

                        }
                        var q = $(this).val();
                        var e = $(this).closest("tr").find("input[id='p_change']").val();
                        var r = parseFloat(e) * parseFloat(q);

                        $(this).closest("tr").find("input[id='No3']").val(Math.round(r * 100) / 100);
                    }

                    sum();
                });


                $("#maindiv").on("keyup", ".p_change", function () {

                    var x = $(this).val();
                    var y = $(this).closest("tr").find("input[id='No2']").val(x);
                    var y2 = $(this).closest("tr").find("input[id='No1']").val();
                    var z = parseFloat(y2) * parseFloat(x);

                    $(this).closest("tr").find("input[id='No3']").val(Math.round(z * 100) / 100);
                    var check = $(this).closest("tr").find("select[class='form-control colors']").val();

                    if(check == 20){
                        var q = $(this).val();
                        var e = $(this).closest("tr").find("input[id='q_change']").val();
                        var r = parseFloat(e) * parseFloat(q);

                        $(this).closest("tr").find("input[id='No3']").val(Math.round(r * 100) / 100);
                    }
                    sum();
                });


                ///////////////////////////////////////////////////////////////

                //Sum All No3
                // function sum() {
                //     var sum = 0;
                //     $("input[id *='No3']").each(function () {
                //         sum += +$(this).val();
                //     });
                //     $("#mo_textm").val(Math.round(sum * 100) / 100);
                //
                // };

                //Sum All No3
                function sum() {
                    var sum = 0;
                    $("input[id *='No3']").each(function () {
                        sum += +$(this).val();
                    });
                    var fire = $("#mo_textm").val(Math.round(sum * 100) / 100 );
                    discont();
                    console.log(fire);
                };
                $("#colcolet").on("keyup", "#discount,#shippingCosts", function () {
                    var sum = 0;
                    var disc = $("input[id *='discount']").val();
                    // var shipping = $("input[id *='shippingCosts']").val();
                    // var shi = parseFloat($("input[id *='shippingCosts']").val());
                    var shipping = document.getElementById("shippingCosts");
                    var shi = parseInt(shipping.options[shipping.selectedIndex].value);
                    $("input[id *='No3']").each(function () {
                        sum += +$(this).val();
                    });

                    $("#toltalinvoicesandDis").val((Math.round(sum * 100) / 100) + shi - disc );

                });
                function discont() {
                    var sum = 0;
                    var disc = $("input[id *='discount']").val();

                    $("input[id *='No3']").each(function () {
                        sum += +$(this).val();
                    });

                    $("#toltalinvoicesandDis").val(Math.round(sum * 100) / 100);
                };

                // sum();



                $(document).ready(function () {

                    sum();
                });

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
