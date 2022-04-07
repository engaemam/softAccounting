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
            <h3 class="box-title">عرض تفاصيل مادة</h3>
            <a href="{{url('admin/items')}}" class="btn btn-primary pull-left btn-lg">رجوع</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/items/')}}/{{$items->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="specifications" class="col-sm-1 control-label">{{trans('items.item_cates')}}</label>
                        <div class="col-sm-3">
                            <span>{{$items->Items->name}}</span>
                        </div>
                        <label for="inputEmail3" class="col-sm-1 control-label">{{trans('items.item_name')}}</label>
                        <div class="col-sm-3">
                            <span>{{$items->item_name}}</span>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="specifications" class="col-sm-1 control-label">{{trans('items.specifications')}}</label>
                        <div class="col-sm-10">

                            <textarea name="specifications" class="form-control" readonly placeholder="{{trans('items.specifications')}}"> {{$items->specifications}}</textarea>
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
                                </div>
                            </div>
                        </div>
                    </div>


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
                                                    <th>المواصفة</th>
                                                    <th>مواصفة 2</th>
                                                    <th>العدد</th>
                                                    <th>سعر البيع</th>
                                                </tr>
                                                </thead>
                                                <tbody id="maindiv">
                                                @foreach($specifications as $k => $specific)
                                                    <tr>

                                                        <td>
                                                                    {!! @$specific->specificolor->name !!}
                                                        </td>

                                                        <td>
                                                            @foreach($itemsizes as $itemsize)
                                                                @if($itemsize->id == $specific->size)
                                                                    {!! $itemsize->name !!}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{$specific->quantity}}
                                                        </td>
                                                        <td>
                                                            {{$specific->selling_price}}
                                                        </td>

                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>
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
                    <!-- /.col -->

                </div><!-- /.box-body -->
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection