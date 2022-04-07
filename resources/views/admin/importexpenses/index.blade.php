@extends('admin.index')
@section('page_title')
    {{trans('importexpenses.show')}}
@endsection
@section('content')



    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('importexpenses.show')}}</h3>
        </div>

        <div class="box-header">
            <div class="col-md-3">
                @if(in_array(105, $temp))
                <a href="{{aurl('importexpenses/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('importexpenses.create')}} </a>
                @endif
            </div>
            {{--<div class="col-md-2">--}}
                {{--<a href="{{Route('admin.items.export')}}" class="btn btn-success"> <i class="fa fa-database"></i> Excel </a>--}}
            {{--</div>--}}
            <div class="col-md-5">
                <form method="get" action="{{aurl('importexpenses')}}" >
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

            <br>
            <table  id="myTable"  class="table table-bordered table-striped shipments display">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{trans('importexpenses.import_id')}}</th>
                    <th>{{trans('importexpenses.shipping')}}</th>
                    <th>{{trans('importexpenses.value')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($importexpenses->count()>0)
                    @foreach($importexpenses as $importexpens)
                        <tr>
                            <td>{{$importexpens->id}}</td>
                            <td>{{$importexpens->imports->number}}</td>


                            <?php
                            $shipping_id=explode(',',$importexpens->importname_id) ;

                            foreach($shipping_id as $id){
                                $name[]=\App\Model\Importnames::find($id)->name;
                            }
                            $type_expense = implode(',',$name);

                            ?>
                            <td>
                                @foreach($shipping_id as $id)
                                    {{  $name[]=\App\Model\Importnames::find($id)->name}}
                                @endforeach
                            </td>
                            <td>{{$importexpens->value}}</td>
                            @if(in_array(106, $temp))

                            <td><a href="{{aurl('importexpenses/edit/'.$importexpens->id)}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                                @if(in_array(107, $temp))
                            <td>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_itemserials{{$importexpens->id}}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_itemserials{{$importexpens->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{route('admin.importexpenses.destroy',['id'=>$importexpens->id])}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$importexpens->id]) }}</h4>
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
                        <td class="center" colspan="9">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>{{trans('importexpenses.import_id')}}</th>
                    <th>{{trans('importexpenses.shipping')}}</th>
                    <th>{{trans('importexpenses.value')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($importexpenses->count()>0)

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