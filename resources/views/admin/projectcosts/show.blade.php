@extends('admin.index')
@section('page_title')
    {{trans('projectcosts.show')}}
@endsection
@section('page_title')
    {{trans('projectcosts.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('projectcosts.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                <a href="{{aurl('projects')}}" class="btn btn-primary"> <i class="fa fa-backward"></i> {{trans('العودة للمشاريع ')}} </a>
            </div>
            @if(in_array(86, $temp))
            <div class="col-md-2">
                <a href="{{aurl('projectcosts/addNew/'.$project_id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> اضافة مصاريف  مشروع </a>
            </div>
                @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>

                    <th>ID</th>
                    <th>{{trans('projects.project_number')}}</th>
                    <th>{{trans('expensesitems.items')}}</th>
                    <th>{{trans('projectcosts.value')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>


                </tr>
                </thead>
                <tbody>

                @if($projectcosts->count()>0)
                    @foreach($projectcosts as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->projects->project_number}}</td>
                            <td>{{@$item->expensesitems->items}}</td>
                            <td>{{$item->value}}</td>
                            @if(in_array(87, $temp))
                            <td><a href="{{aurl('projectcosts/'.$item->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            @if(in_array(88, $temp))
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
                                            <form method="POST" action="{{url('admin/projectcosts/')}}/{{$item->id}}" accept-charset="UTF-8">
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
                    <th>{{trans('projects.project_number')}}</th>
                    <th>{{trans('expensesitems.items')}}</th>
                    <th>{{trans('projectcosts.value')}}</th>
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