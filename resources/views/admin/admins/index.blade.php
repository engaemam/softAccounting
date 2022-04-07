@extends('admin.index')
@section('page_title')
    {{trans('admin.show_user')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.show_user')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-3">
                <a href="{{aurl('admin/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> إضافة عضو جديد </a>
            </div>

            <div class="col-md-3">
                <a href="{{aurl('roles')}}" class="btn btn-info"> <i class="fa fa-eye"></i>  {{trans('roles.show')}}</a>
            </div>
            <div class="col-md-1">
                <a href="{{aurl('roles/create')}}" class="btn btn-warning"> <i class="fa fa-plus"></i>  {{trans('roles.create')}}</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('admin.admin_name')}}</th>
                    <th>{{trans('admin.admin_email')}}</th>
                    <th>{{trans('admin.role_id')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($admins->count()>0)
                    @foreach($admins as $admin)

                        <tr>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>
                            <td>{{@$admin->roles->name}}</td>
                            <td><a href="{{aurl('admin/'. $admin->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a>
                            </td>
                            <td>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_admin{{ $admin->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_admin{{ $admin->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{aurl('admin/'.$admin->id)}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$admin->name]) }}</h4>
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
                        <td class="center" colspan="9">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('admin.admin_name')}}</th>
                    <th>{{trans('admin.admin_email')}}</th>
                    <th>{{trans('admin.role_id')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($admins->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$admins->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$admins->appends(\Request::except('_token'))->render()}}</div>
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