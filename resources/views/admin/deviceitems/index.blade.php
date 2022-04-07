@extends('admin.index')
@section('page_title')
    {{trans('deviceitems.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('deviceitems.show')}}</h3>
        </div>
        <div class="box-header">
            @if(in_array(65, $temp))
            <div class="col-md-2">
                <a href="{{aurl('deviceitems/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('deviceitems.create')}} </a>
            </div>
            @endif
            <div class="col-md-2">
                <a href="{{Route('admin.deviceitems.export3')}}" class="btn btn-success"> <i class="fa fa-database"></i> Excel </a>
            </div>
            <div class="col-md-5">
                <form method="get" action="{{aurl('deviceitems')}}" >
                    <div class="input-group">
                        <input type="search" name="search" class="form-control">
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
                    <th>{{trans('deviceitems.devices_id')}}</th>

                    <th>{{trans('deviceitems.item_id')}}</th>
                    <th>{{trans('deviceitems.number_items')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($deviceitems->count()>0)
                    @foreach($deviceitems as $deviceitem)
                        <tr>
                            <td>{{$deviceitem->id}}</td>
                            <td>{{$deviceitem->devices->devices_name}}</td>

                            <?php
                            $item_id=explode(',',$deviceitem->item_id) ;
                            $number_items=explode(',',$deviceitem->number_items) ;
                            foreach($item_id as $id){
                                $name[]=\App\Model\Items::find($id)->item_name;
                            }
                            $item_name=implode(',',$name);
                            //                           dd($name);
                            ?>
                            <td>
                                @foreach($item_id as $id)
                                    {{$name[]=\App\Model\Items::find($id)->item_name}}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($number_items as $numbers)
                                    {{$numbers}}<br>
                                @endforeach
                            </td>
                            @if(in_array(66, $temp))
                                <td><a href="{{aurl('deviceitems/'.$deviceitem->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            @if(in_array(67, $temp))
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_items{{ $deviceitem->id }}"><i class="fa fa-trash"></i></button>

                                    <!-- Modal -->
                                    <div id="del_items{{ $deviceitem->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                                </div>
                                                <form method="POST" action="{{url('admin/deviceitems/')}}/{{$deviceitem->id}}" accept-charset="UTF-8">
                                                    {!! csrf_field() !!}
                                                    <input name="_method" type="hidden" value="DELETE">

                                                    <div class="modal-body">
                                                        <h4>{{ trans('admin.delete_this',['name'=>$deviceitem->devices_name]) }}</h4>
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
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
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
                    <th>{{trans('deviceitems.devices_id')}}</th>

                    <th>{{trans('deviceitems.item_id')}}</th>
                    <th>{{trans('deviceitems.number_items')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($deviceitems->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$deviceitems->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$deviceitems->links()}}</div>
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