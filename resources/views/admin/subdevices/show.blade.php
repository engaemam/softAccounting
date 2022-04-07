@extends('admin.index')
@section('page_title')
    {{trans('subdevices.show')}}
@endsection
@section('content')



    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('subdevices.show2')}} <span style="color: royalblue">{{$subdevicess[0]->devices->devices_name}}</span> </h3>
        </div>
        <div class="box-header">

            <div class="col-md-2">
                <a href="{{aurl('devices')}}" class="btn btn-primary"> <i class="fa fa-backward"></i> {{trans('العودة للاجهزة ')}} </a>
            </div>
            @if(in_array(70, $temp))
            <div class="col-md-2">
                <a href="{{aurl('subdevices/addNew/'.$devices_id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> اضافة جهاز فرعي </a>
            </div>
                @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <br>
            <table  id="myTable"  class="table table-bordered table-striped deviceitems display">
                <thead>
                <tr>

                    <th>ID</th>

                    <th>{{trans('subdevices.devices_name')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

@foreach($subdevicess as $subdevices)

                        <tr>

                            <td>{{$subdevices->id}}</td>

                            <td>{{$subdevices->devices2->devices_name}}</td>
                            @if(in_array(71, $temp))
                            <td><a href="{{aurl('subdevices/'.$subdevices->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            @if(in_array(72, $temp))
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_items{{ $subdevices->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_items{{ $subdevices->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{url('admin/subdevices/')}}/{{$subdevices->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$subdevices->devices_name]) }}</h4>
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



                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>

                    <th>{{trans('subdevices.devices_name')}}</th>
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