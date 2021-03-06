@extends('admin.index')
@section('page_title')
    {{trans('items.edit')}}
@endsection
@section('content')
    <style>

        .btn.red:not(.btn-outline) {
            color: #fff;
            background-color: #e7505a;
            border-color: #e7505a;
        }
        .btn.default:not(.btn-outline) {
            color: #666;
            background-color: #e1e5ec;
            border-color: #e1e5ec;
        }
    </style>
    <script type="text/javascript">

        $("a[data-dismiss='fileinput']").on("click",function(){
            $("input[name='rmv_image']").attr("value","true");
            $("input[name='image']").attr("value","");
        });

    </script>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/items/')}}/{{$items->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="specifications" class="col-sm-1 control-label">{{trans('items.item_cates')}}</label>
                        <div class="col-sm-10">
                            <select name="category_id" class="form-control">
                                @foreach(@$items_cates as $items_cate)
                                    <option value="{!! $items_cate->id !!}" @if($items_cate->id  == $items->category_id) selected @endif>{!! $items_cate->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">{{trans('items.item_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="item_name" class="form-control" value="{{$items->item_name}}"  id="" placeholder="{{trans('items.item_name')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="specifications" class="col-sm-1 control-label">{{trans('items.specifications')}}</label>
                        <div class="col-sm-10">

                            <textarea name="specifications" class="form-control" placeholder="{{trans('items.specifications')}}"> {{$items->specifications}}</textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('items.image')}}</label>
                        <div class="col-md-3">
                            <div class="fileinput @if($items->image) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                                <div class="input-group input-large">

                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                        <img class="fileinput-filename" src="{{url('upload/items/'.$items->image)}}" style="max-width: 200px; max-height: 100px;" alt="" />
                                    </div>
                                    <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new">  </span>
                                                <span class="fileinput-exists">  ?????????? </span>
                                                <input type="file"   name="image" value="{{$items->image}}">

                                            </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                              <hr/>
                    <div class="form-group">

                    </div>

                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">

                                    <div class="box-body">
                                        <div class="form-group">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>????????????????</th>
                                                    <th>???????????? 2</th>
                                                    <th>?????? ??????????</th>
                                                    <th>
                                                        #
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">
                                                @foreach($specifications as $k => $specific)
                                                    <tr>

                                                        <td>
                                                            <select required id="list" name="color_id[{{$k+1}}]" class="form-control select2 color" data-live-search="true">
                                                                <option value=""> ----???????? ???????????????? ---- </option>
                                                                @foreach($itemscolors as $itemcolor)
                                                                    <option value="{!! $itemcolor->id !!}" @if($itemcolor->id == $specific[0]->color_id )  selected @endif >{!! $itemcolor->name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <select required id="list" name="size_id[{{$k+1}}][]" class="form-control select2 size"@if($specific[0]->color_id == 20 )  disabled @endif multiple="multiple" data-live-search="true">

                                                                @if($specific[0]->color_id != 20 )
                                                            @foreach($itemsizes as $itemsize)
                                                        <option style="color:red" value="{!! $itemsize->id !!}" @if(in_array($itemsize->id,$specific->pluck('size')->toArray())) selected @endif>{!! $itemsize->name !!}</option>
                                                            @endforeach
                                                            @else
                                                                    <option style="color:red" value="{!! $itemsize->id !!}" @if($itemsize->id == 27) selected @endif>{!! $itemsize->name !!}</option>

                                                            @endif
                                                        </td>
                                                        <td>
                                                                <input type="hidden" name="quantity[]" class="form-control" value="" id="inputEmail3" >
                                                                <input type="number" required name="selling_price[{{$k+1}}]" class="form-control" value="{{$specific[0]->selling_price}}" id="inputEmail3" placeholder="{{trans('items.selling_price')}}">
                                                        </td>
                                                        <td>
                                                            @if($k == 0)
                                                                <span></span>
                                                                @else
                                                            <input type="button" id="remove" class="btn btn-danger " value="X" />
                                                                @endif
                                                        </td>
                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> ?????????? ??????????????</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- /.tab-pane -->

                                <div class="tab-pane " id="settings2">

                                    <div  class="box-body hereallzsasd">
                                        <div id="" class="devices">
                                            <div id="getItems"></div>
                                        </div>

                                        <div class="form-group" id="devices" ></div>
                                        <div class="form-group ">
                                            <label for="value" class="col-sm-2 control-label">?????? ??????????????</label>
                                            <div class="col-sm-3">
                                                <input type="text"  name="total_final_mogma3"  readonly class="form-control total_final" id="total_final" placeholder="?????? ???????????? ????????">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <button class="btn btn-success add_field_button_mo" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> ?????????? ???????? ????????</button>
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



    <script>
        var zxc = 99999;
        $(function () {

            $("#Badd").click(function () {


                if ($(".color").val() != 20){
                    $("#maindiv").append(
                        // Add new row

                        ' <tr id="remove'+zxc+' ">' +
                        '            <td>' +
                        '                <select id="list1" required class="form-control select2 color items" data-live-search="true" name="color_id['+zxc+']" data-count="'+zxc+'" required>' +
                        '                    <option  class="form-control" value="" >-----???????????? ???????????? ???????????? ----</option>' +
                        '                    @foreach ($itemscolors as $itemcolor )' +
                        '                       <option style="color:red" value="{!! $itemcolor->id !!}">{!! $itemcolor->name !!}</option>'+
                        '                    @endforeach' +
                        '                </select>' +
                        '            </td>' +
                        '            <td>' +
                        '  <select id="list" name="size_id['+zxc+'][]" required class="form-control select2 size" multiple="multiple" data-live-search="true">'+
                        '                      @foreach($itemsizes as $itemsize)'+
                        '  <option style="color:red" value="{!! $itemsize->id !!}">{!! $itemsize->name !!}</option>'+
                        '                    @endforeach' +
                        '            </td>' +
                        '            <td>' +
                        '                    <input type="number" required name="selling_price['+zxc+']" class="form-control" id="inputEmail3" placeholder="{{trans('specific.selling_price')}}">' +
                        '            </td>' +
                        '            <td>' +
                        '                <input type="button" id="remove" class="btn btn-danger " value="X" />' +
                        '            </td>' +
                        ' </tr>'+

                        ''
                    );
                    $('.select2').select2();
                    zxc++;
                }
            });

            //remove selected Row
            $("#maindiv").on("click", "#remove", function () {
                $(this).closest("tr").remove().attr('name', 'quantity_b['+$(this).val()+']');

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


    @include('admin.bills.script')

@endsection