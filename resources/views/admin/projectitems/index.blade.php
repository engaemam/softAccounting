@extends('admin.index')
@section('page_title')
    {{trans('projectitems.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('projectitems.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                <a href="{{aurl('projectitems/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('projectitems.create')}} </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{trans('projectitems.project_id')}}</th>
                    <th>{{trans('projectitems.devices_name')}}</th>
                    <th>{{trans('projectitems.quantity')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($projectdevices->count()>0)
                    @foreach($projectdevices as $key=>$item)

                        <tr>
                            <td>{{@$key}}</td>
                            <td>{{@$item->projects->project_number}}</td>
                            <td>{{@$item->devices->devices_name}}</td>
                            <td>{{@$item->quantity}}</td>
                            <td><a href="{{aurl('projectitems/'.$item->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
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
                                            <form method="POST" action="{{url('admin/projectitems/')}}/{{$item->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$item->id]) }}</h4>
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
                    @endforeach
                @else
                    <tr>
                        <td class="center" colspan="9" style="text-align: center">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>

                    <th>ID</th>
                    <th>{{trans('projectitems.project_id')}}</th>
                    <th>{{trans('projectitems.devices_name')}}</th>
                    <th>{{trans('projectitems.quantity')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            @if($projectdevices->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$projectdevices->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$projectdevices->links()}}</div>
                </div>
            @endif
            <h4>المواد</h4>
            {{--GET ITEMS--}}
            <table  id=""  class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{trans('projectitems.project_id')}}</th>
                    <th>{{trans('projectitems.item_id')}}</th>
                    <th>{{trans('projectitems.quantity')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($projectitems->count()>0)
                    @foreach($projectitems as $key=>$item)

                        <tr>
                            <td>{{$key}}</td>
                            <td>{{@$item->projects->project_number}}</td>
                            <td>{{@$item->items->item_name}}</td>
                            <td>{{@$item->quantity_b}}</td>


                            <td><a href="{{aurl('projectitems/'.$item->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
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
                                            <form method="POST" action="{{url('admin/projectitems/')}}/{{$item->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$item->id]) }}</h4>
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
                    @endforeach
                @else
                    <tr>
                        <td class="center" colspan="9" style="text-align: center">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>

                    <th>ID</th>
                    <th>{{trans('projectitems.project_id')}}</th>
                    <th>{{trans('projectitems.item_id')}}</th>
                    <th>{{trans('projectitems.quantity')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>

            <br>
            @if($projectitems->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$projectitems->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$projectitems->links()}}</div>
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