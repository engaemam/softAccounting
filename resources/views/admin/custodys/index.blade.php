@extends('admin.index')
@section('page_title')
    {{trans('custodys.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('custodys.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                <a href="{{aurl('custodys/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('custodys.create')}} </a>
            </div>

            <div class="col-md-5">
                <form method="get" action="{{aurl('custodys')}}" >
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
                    <th>{{trans('custodys.number')}}</th>
                    <th>{{trans('custodys.title')}}</th>
                    <th>{{trans('custodys.project_id')}}</th>
                    <th>{{trans('custodys.value')}}</th>
                    <th>{{trans('custodys.dates')}}</th>
                    <th>{{trans('custodys.notes')}}</th>
                    <th>{{trans('custodys.delivery')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($custodys->count()>0)
                    @foreach($custodys as $bill)

                        <tr>
                            <td>{{$bill->id}}</td>
                            <td>{{$bill->number}}</td>
                            <td>{{$bill->title}}</td>
                            <td>{{@$bill->Projects->project_number}}</td>
                            <td>{{$bill->value}}</td>
                            <td>{{$bill->dates}}</td>
                            <td>{{$bill->notes}}</td>
                            <td>
                                @if($bill->delivery != 1)
                                    <form action="{{aurl('custodys/delivery/'.$bill->id)}}" method="POST">
                                        {!! csrf_field() !!}
                                        <input class="btn btn-warning" type="submit" value="تصفية">
                                    </form>

                                    @else
                                <span class="label label-success">تم التصفية</span>
                                    @endif
                            </td>
                            @if(in_array(50, $temp))
                            <td><a href="{{aurl('custodys/'.$bill->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            @if(in_array(40, $temp))
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_custodys{{ $bill->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_custodys{{ $bill->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{url('admin/custodys/')}}/{{$bill->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$bill->id]) }}</h4>
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
                    <th>{{trans('custodys.number')}}</th>
                    <th>{{trans('custodys.title')}}</th>
                    <th>{{trans('custodys.project_id')}}</th>
                    <th>{{trans('custodys.value')}}</th>
                    <th>{{trans('custodys.dates')}}</th>
                    <th>{{trans('custodys.notes')}}</th>
                    <th>{{trans('custodys.delivery')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($custodys->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$custodys->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$custodys->appends(\Request::except('_token'))->render()}}</div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->

    </div>



@endsection
