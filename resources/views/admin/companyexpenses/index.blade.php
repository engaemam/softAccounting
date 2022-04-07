@extends('admin.index')
@section('page_title')
    {{trans('companyexpenses.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('companyexpenses.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-3">

                <a href="{{aurl('companyexpenses/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('companyexpenses.create')}} </a>

            </div>
            <div class="col-md-2">
                <a href="{{Route('admin.companyexpenses.export')}}" class="btn btn-success"> <i class="fa fa-database"></i> Excel </a>
            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>

                    <th>ID</th>
                    <th>{{trans('companyexpenses.catttt')}}</th>
                    <th>{{trans('companyexpenses.title')}}</th>
                    <th>{{trans('companyexpenses.price')}}</th>
                    <th>{{trans('companyexpenses.date')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>

                </tr>
                </thead>
                <tbody>

                @if($expenses->count()>0)
                    @foreach($expenses as $bill)

                        <tr>
                            <td>{{$bill->id}}</td>
                            <td>{{$bill->Catcompanyexpenses->title}}</td>
                            <td>{{$bill->title}}</td>
                            <td>{{$bill->price}}</td>
                            <td>{{$bill->date}}</td>


                            <td><a href="{{aurl('companyexpenses/edit/'.$bill->id)}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>




                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_items{{ $bill->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_items{{ $bill->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{url('admin/companyexpenses/')}}/{{$bill->id}}" accept-charset="UTF-8">
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


                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="center" colspan="12" style="text-align: center">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>

                    <th>ID</th>
                    <th>{{trans('companyexpenses.catttt')}}</th>
                    <th>{{trans('companyexpenses.title')}}</th>
                    <th>{{trans('companyexpenses.price')}}</th>
                    <th>{{trans('companyexpenses.date')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($expenses->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$expenses->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$expenses->appends(\Request::except('_token'))->render()}}</div>
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