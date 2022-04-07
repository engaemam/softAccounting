@extends('admin.index')
@section('page_title')
    {{trans('projects.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('projects.show')}}</h3>
        </div>
        <div class="box-header">
            @if(in_array(44, $temp))
                <div class="col-md-2">
                    <a href="{{aurl('projects/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('projects.create')}} </a>
                </div>
            @endif
            <div class="col-md-2">
                <a href="{{Route('admin.projects.export4')}}" class="btn btn-success"> <i class="fa fa-database"></i> Excel </a>
            </div>
            <div class="col-md-5">
                <form method="get" action="{{aurl('projects')}}" >
                    <div class="input-group">
                        <input type="search" name="search" value="{{ request()->search != '' ? request()->search : ''}}" class="form-control">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-info btn-flat">بحث!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    <div class="box-body">
        <table  id=""  class="table table-bordered table-striped ">

            <thead>
            <tr>

                <th>ID</th>
                <th>{{trans('projects.project_number')}}</th>
                <th>{{ trans('projects.name')}}</th>
                <th>{{trans('projects.type')}}</th>
                <th>{{trans('projects.id_client')}}</th>
                <th> مصاريف المشروع</th>
                {{--<th> مواد المشروع</th>--}}
                <th>عرض سعر</th>
                <th>عرض المشروع</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
            </tr>
            </thead>
            <tbody>

            @if($project->count()>0)
                @foreach($project as $projects)

                    <tr >

                        <td>{{$projects->id}}</td>
                        <td>{{$projects->project_number}}</td>
                        <td>{{$projects->name}}</td>
                        <td>{{$projects->type}}</td>
                        <td>{{@$projects->clients->name_client}}</td>
                        @if(in_array(45, $temp))
                            @if(\App\Model\Projectcosts::where('project_id',$projects->id)->count() > 0)
                                @if(in_array(85, $temp))
                                    <td><a href="{{aurl('projectcosts/'.$projects->id)}}" class="btn btn-primary "> <i class="fa fa-eye"></i> </a></td>
                                @else
                                    <td>{{trans('admin.role')}}</td>
                                @endif
                            @else
                                @if(in_array(86, $temp))
                                    <th>
                                        <a href="{{aurl('projectcosts/addNew/'.$projects->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> </a>
                                    </th>
                                @else
                                    <td>{{trans('admin.role')}}</td>
                                @endif
                            @endif
                        @else
                            <td>{{trans('admin.role')}}</td>
                        @endif
                        {{--@if(\App\Model\Projectitems::where('project_id',$projects->id)->count() > 0&& \App\Model\Projectdevices::where('project_id',$projects->id)->count() > 0)--}}
                        {{--<td><a href="{{aurl('projectitems/'.$projects->id)}}" class="btn btn-primary "> <i class="fa fa-eye"></i> </a></td>--}}
                        {{--@else--}}
                            {{--<th>--}}
                                {{--<a href="{{aurl('projectitems/addNew/'.$projects->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> </a>--}}

                            {{--</th>--}}
                        {{--@endif--}}
                        @if($projects->type == 'عرض سعر' || $projects->type == '')
                        <td style="text-align: center">
                            <a href="{{aurl('projects/show/'.$projects->id)}}" class="btn bg-purple btn-flat "> <i class="fa fa-eye"></i> </a>
                        </td>
                            @else
                            <td style="text-align: center"> <span class="label label-success"> محول</span></td>
                        @endif
                        @if($projects->type == 'قيد التنفيذ')
                        <td style="text-align: center">
                            <a href="{{aurl('projects/show/'.$projects->id)}}" class="btn btn-success"> <i class="fa fa-eye"></i> </a>
                        </td>
                        @else
                            <td style="text-align: center">
                                <form action="{{route('admin.projects.Underway')}}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="id" value="{{$projects->id}}">
                                    <input type="submit" class="btn btn-primary" value="تحويل">
                                </form>
                            </td>
                        @endif
                        @if($projects->type == 'عرض سعر' || $projects->type == '')
                        <td style="text-align: center"><a href="{{aurl('projects/'.$projects->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                        @else
                            <td style="text-align: center">عرض سعر فقط</td>
                        @endif
                            @if(in_array(48, $temp))
                        <td>

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_clients{{ $projects->id }}"><i class="fa fa-trash"></i></button>

                            <!-- Modal -->
                            <div id="del_clients{{ $projects->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                        </div>
                                        <form method="POST" action="{{url('admin/projects/')}}/{{$projects->id}}" accept-charset="UTF-8">
                                            {!! csrf_field() !!}
                                            <input name="_method" type="hidden" value="DELETE">

                                            <div class="modal-body">
                                                <h4>{{ trans('admin.delete_this',['name'=>$projects->id]) }}</h4>
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
                    <td class="center" colspan="20">
                        {{trans('الجدول خالي')}}
                    </td>
                </tr>
            @endif

            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>{{trans('projects.project_number')}}</th>
                <th>{{ trans('projects.name')}}</th>
                <th>{{trans('projects.type')}}</th>
                <th>{{trans('projects.id_client')}}</th>
                <th> مصاريف المشروع</th>
                {{--<th> مواد المشروع</th>--}}
                <th>عرض سعر</th>
                <th>عرض المشروع</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
            </tr>
            </tfoot>

        </table>
        <br>
        @if($project->count()>0)
            <div class="row">
                <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$project->total()}} </div>
                <div class="col-md-7 col-sm-7">{{$project->appends(\Request::except('_token'))->render()}}</div>
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