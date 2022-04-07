@extends('admin.index')
@section('content')


    <link rel="stylesheet" type="text/css" href="{{url('/')}}/js/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="{{url('/')}}/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

    </script>



    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('deviceitems.show')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <br>
            <table  id="myTable"  class="table table-bordered table-striped deviceitems display">
                <a href="{{aurl('deviceitems/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('deviceitems.create')}} </a>
                <thead>
                <tr>

                    <th>ID</th>
                    <th>{{trans('deviceitems.devices_id')}}</th>
                    <th>{{trans('deviceitems.numbers')}}</th>
                    <th>{{trans('deviceitems.item_id')}}</th>
                    <th>{{trans('deviceitems.number_items')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>



                        <tr>
                            <td>{{$deviceitems->id}}</td>
                            <td>{{$deviceitems->devices->devices_name}}</td>
                            <td>{{$deviceitems->numbers}}</td>
                            <td>{{$deviceitems->item_id}}</td>
                            <td>{{$deviceitems->number_items}}</td>
                            <td><a href="{{aurl('deviceitems/'.$deviceitems->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_items{{ $deviceitems->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_items{{ $deviceitems->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{url('admin/deviceitems/')}}/{{$deviceitems->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$deviceitems->devices_name]) }}</h4>
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



                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>{{trans('deviceitems.devices_id')}}</th>
                    <th>{{trans('deviceitems.numbers')}}</th>
                    <th>{{trans('deviceitems.item_id')}}</th>
                    <th>{{trans('deviceitems.number_items')}}</th>
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