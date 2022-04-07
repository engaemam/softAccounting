@extends('admin.index')
@section('page_title')
    {{trans('itemserials.itemserials')}}
@endsection
@section('content')





    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('itemserials.itemserials')}}</h3>
        </div>
        <div class="box-header">
            <a href="{{aurl('items')}}" class="btn btn-primary"> <i class="fa fa-backward"></i> {{trans('العودة للمواد')}} </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <br>
            <table  id="myTable"  class="table table-bordered table-striped deviceitems display">
                <thead>
                <tr>

                    <th>ID</th>
                    <th>{{trans('itemserials.item_id')}}</th>
                    <th>{{trans('itemserials.supplier_id')}}</th>
                    <th>{{trans('itemserials.serial_number')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>



                        <tr>

                            <td>{{$itemserials->id}}</td>
                            <td>{{@$itemserials->items->item_name}}</td>
                            <td>{{@$itemserials->suppliers->suppliers_name}}</td>
                            <td>{{$itemserials->serial_number}}</td>
                            @if(in_array(61, $temp))
                            <td><a href="{{aurl('itemserials/'.$itemserials->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            @if(in_array(62, $temp))
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_items{{ $itemserials->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_items{{ $itemserials->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{url('admin/itemserials/')}}/{{$itemserials->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$itemserials->devices_name]) }}</h4>
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



                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>{{trans('itemserials.item_id')}}</th>
                    <th>{{trans('itemserials.supplier_id')}}</th>
                    <th>{{trans('itemserials.serial_number')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>



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