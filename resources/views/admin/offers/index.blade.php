@extends('admin.index')
@section('page_title')
    {{trans('items.offers')}}
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">"قائمة العروض"</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                @if(in_array(22, $temp))
                    <a href="{{aurl('offers/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> اضافة عرض </a>
                @endif
            </div>
            {{--end of my code --}}










        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>

                    <th>Link</th>
                    <th>ID</th>
                    <th>اسم العرض</th>
                    <th>المواصفات</th>
                    @if(Auth::guard('admin')->user()->id == 1)
                        <th>السعر</th>
                    @endif
                    <th>صورة العرض</th>
                    {{--<th>{{trans('items.price_final')}}</th>--}}
                    <th>تفاصيل</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($items->count()>0)
                    @foreach($items as $key=>$item)

                        <tr>
                            <td><input id="url{{$item->id}}" value="{{url("offers/".$item->id)}}" readonly style="width: 250px; margin-left: 5px;" ><button onclick="myFunction({{$item->id}})" class="copyButton" id="copyButtonId" data-id="@item.Type"
                                                                                                                                                            data-clipboard-action="copy" data-clipboard-target="div#copy">Copy</button></td>

                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->specifications}}</td>
                            @if(Auth::guard('admin')->user()->id == 1)
                                <td>{{round($item->price,2)}}</td>
                            @endif

                            <td> <img  src="{{url('upload/offers/'.$item->image)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>

                            <td><a href="{{aurl('offers/'.$item->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>

                            @if(in_array(25, $temp))
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_items{{ $item->id }}"><i class="fa fa-trash"></i></button>

                                    <!-- Modal -->
                                    <div id="del_items{{ $item->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                                </div>
                                                <form method="POST" action="{{url('admin/offers/')}}/{{$item->id}}" accept-charset="UTF-8">
                                                    {!! csrf_field() !!}
                                                    <input name="_method" type="hidden" value="DELETE">

                                                    <div class="modal-body">
                                                        <h4>{{ trans('admin.delete_this',['name'=>$item->name]) }}</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
                                                        <input class="btn btn-danger" type="submit" value="{{trans('admin.yes')}}">
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                        </tr>
                        @else
                            <td>{{trans('admin.role')}}</td>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td class="center" colspan="9">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>
                    <th>Link</th>
                    <th>ID</th>
                    <th>اسم العرض</th>
                    <th>المواصفات</th>
                    @if(Auth::guard('admin')->user()->id == 1)
                        <th>السعر</th>
                    @endif
                    <th>صورة العرض</th>
                    {{--<th>{{trans('items.price_final')}}</th>--}}
                    <th>تفاصيل</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($items->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$items->total()}} </div>

                    <div class="col-md-7 col-sm-7"> {{ $items->appends(\Request::except('_token'))->render() }}</div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->


    <!-- Trigger the modal with a button -->

    <!-- Modal -->
    <div id="mutlipleDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <div class="empty_record hidden">
                            <h4>{{ trans('admin.please_check_some_records') }} </h4>
                        </div>
                        <div class="not_empty_record hidden">
                            <h4>{{ trans('admin.ask_delete_itme') }} <span class="record_count"></span> ? </h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="empty_record hidden">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
                    </div>
                    <div class="not_empty_record hidden">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no') }}</button>
                        <input type="submit"  value="{{ trans('admin.yes') }}"  class="btn btn-danger del_all" />
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>

    </script>
@endsection