@extends('admin.index')
@section('page_title')
    استعراض منتجات  (سوق النوارس)@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('items.show_itmes')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                @if(in_array(22, $temp))
                    <a href="{{aurl('items/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('items.create')}} </a>
                @endif



            </div>
            <div class="col-md-2">
                <a href="{{aurl('products_api')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> استعراض منتجات  (سوق النوارس) </a>
            </div>

                {{-- add button that generate itemes to products  @ islam--}}
            <!-- <div class="col-md-2">
                <a href="{{Route('links')}}" class="btn btn-success"> <i class="fa fa-database"></i> Generate links </a>
            </div> -->
                {{--end of my code --}}






          
            <div class="col-md-5">
                <form method="get" action="{{aurl('items')}}" >
                    <div class="input-group">
                        <input type="search" name="search" value="{{ request()->search != '' ? request()->search : ''}}" class="form-control">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">بحث!</button>
                        </span>
                    </div>
                </form>
            </div>


        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>

                    <th>ID</th>
                    <th>{{ trans('items.item_name')}}</th>
                    <th>{{ trans('items.item_cates')}}</th>
                    <th>{{trans('items.specifications')}}</th>
                    <th>{{trans('items.image')}}</th>
                    <th>{{trans('items.quantity')}}</th>

                @if(Auth::guard('admin')->user()->id == 1)
                        <th>{{trans('items.price')}}</th>
                    @endif
                    {{--<th>{{trans('items.price_final')}}</th>--}}
                    <th>{{ trans('items.transfer')}}</th>
                    <th>{{ trans('items.show')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($items->count()>0)
                    @foreach($items as $key=>$item)

                        <tr>
                            <td>{{$item->id}}
                            {!! DNS1D::getBarcodeHTML($item->id, "C39") !!}
                            </td>
                            <td>{{@$item->item_name}}</td>
                            <td>{{@$item->Items->name}}</td>
                            <td>{{@$item->specifications}}</td>
                            <td> <img  src="{{url('upload/items/'.$item->image)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>
                            <td>{{$item->quantity}}</td>
                            @if(Auth::guard('admin')->user()->id == 1)
                                <td>{{round($item->price,2)}}</td>
                            @endif

                            {{--<td>{{round($item->newprice,2) }}</td>--}}
                            @if(in_array(23, $temp))
                                @if(\App\Model\Itemserials::where('item_id',$item->id)->count() > 0)
                                    @if(in_array(59, $temp))
                                        <td>
                                            <a href="{{aurl('itemserials/'.$item->id)}}" class="btn btn-success"> <i class="fa fa-eye"></i> </a>
                                        </td>
                                    @else
                                        <td>{{trans('admin.role')}}</td>
                                    @endif
                                @else
                                    @if(in_array(60, $temp))
                                        <td>
                                            <a href="{{aurl('itemserials/addNew/'.$item->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> </a>
                                        </td>
                                    @else
                                        <td>{{trans('admin.role')}}</td>
                                    @endif
                                @endif
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            <td><a href="{{aurl('items/'.$item->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>

                            @if(in_array(24, $temp))
                                <td><a href="{{aurl('items/'.$item->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
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
                                                <form method="POST" action="{{url('admin/items/')}}/{{$item->id}}" accept-charset="UTF-8">
                                                    {!! csrf_field() !!}
                                                    <input name="_method" type="hidden" value="DELETE">

                                                    <div class="modal-body">
                                                        <h4>{{ trans('admin.delete_this',['name'=>$item->item_name]) }}</h4>
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
                    <th>ID</th>
                    <th>{{ trans('items.item_name')}}</th>
                    <th>{{ trans('items.item_cates')}}</th>
                    <th>{{trans('items.specifications')}}</th>
                    <th>{{trans('items.image')}}</th>
                    <th>{{trans('items.quantity')}}</th>
                    @if(Auth::guard('admin')->user()->id == 1)
                        <th>{{trans('items.price')}}</th>
                    @endif
                    {{--<th>{{trans('items.price_final')}}</th>--}}
                    <th>{{ trans('items.transfer')}}</th>
                    <th>{{ trans('items.show')}}</th>
                    <th>{{trans('admin.edit')}}</th>
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




@endsection