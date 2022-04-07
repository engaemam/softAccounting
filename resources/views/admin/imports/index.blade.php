@extends('admin.index')
@section('page_title')
    {{trans('imports.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('imports.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                @if(in_array(97, $temp))
                <a href="{{aurl('imports/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('imports.create')}} </a>
                    @endif
            </div>
            <div class="col-md-2">
                <a href="{{Route('admin.imports.export')}}" class="btn btn-success"> <i class="fa fa-database"></i> Excel </a>
            </div>
            <div class="col-md-5">
                <form method="get" action="{{aurl('imports')}}" >
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
                    <th>{{trans('imports.number')}}</th>
                    <th>{{trans('imports.date')}}</th>
                    <th>{{trans('imports.supplier_id')}}</th>
                    <th>{{trans('imports.price_before_doller')}}</th>
                    <th>{{trans('imports.notes')}}</th>
                    <th>{{trans('imports.exp')}}</th>
                    <th>{{trans('imports.pdf')}}</th>
                    <th colspan="2" class="text-center">{{trans('عرض')}}</th>
                    <th class="text-center">{{trans('تحويل إلي فاتورة شراء')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($imports->count()>0)
                    @foreach($imports as $bill)

                        <tr>
                            <td>{{$bill->id}}</td>
                            <td>{{$bill->number}}</td>
                            <td>{{$bill->date}}</td>
                            <td>{{$bill->suppliers->suppliers_name}}</td>
                            <td>{{$bill->price_doller}}</td>
                            <td>{{$bill->notes}}</td>

                            @if(in_array(100, $temp))
                                @if(\App\Model\Importexpenses::where('import_id',$bill->id)->count() > 0)
                                    @if(in_array(100, $temp))
                                        <th><a href="{{aurl('importexpenses/show/'.$bill->id)}}" class="btn bg-purple"> <i class="fa fa-eye"></i> </a></th>
                                    @else
                                        <td>{{trans('admin.role')}}</td>
                                    @endif
                                @else
                                    @if(in_array(101, $temp))
                                    <th> <a href="{{aurl('importexpenses/addNew/'.$bill->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> </a></th>
                                    @else
                                        <td>{{trans('admin.role')}}</td>
                                    @endif
                                @endif
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            <td class="center">
                                @if($bill->pdf)
                                    <a href="{{url("upload/bills/$bill->pdf")}}">إستعرض PDF </a>
                                @else
                                    لا يوجد
                                @endif
                            </td>
                            <td><a href="{{aurl('imports/show/'.$bill->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>
                            <td>
                                <a href="{{aurl('imports/egyptshow/'.$bill->id)}}" class="btn btn-danger"> ج . م </a>
                            </td>

                            <td class="text-center">
                                @if($bill->transfer == 0)
                                    {{--=========================Change Bill No.============--}}
                                    <!-- Modal -->
                                        <div class="modal fade myModal" id="myModal{{$bill->id}}" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">برجاء ادخال رقم فاتورة جديد</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('importtobill')}}">
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" name="id" value="{{$bill->id}}">
                                                            <input type="text" class="form-control" name="noBills" placeholder="رفم الفاتورة">
                                                            <br>

                                                            <button  class="btn btn-microsoft" > <i class="fa fa-plus"></i> تحويل </button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        {{--=========================Change Bill No.============--}}
                                    <button type="button" class="btn btn-microsoft " data-toggle="modal" data-target="#myModal{{$bill->id}}"><i class="fa fa-plus"></i> تحويل </button>
                                    @else
                                <p>تم التحويل</p>
                                @endif
                            </td>
                            @if($bill->transfer == 0)
                                @if(in_array(98, $temp))
                                    <td><a href="{{aurl('imports/edit/'.$bill->id)}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                                    @else
                                        <td>{{trans('admin.role')}}</td>
                                    @endif
                            @else
                                <td>تم التحويل</td>
                            @endif


                            @if(in_array(99, $temp))
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_bills{{ $bill->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_bills{{ $bill->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="get" action="{{route('admin.imports.destroy',['id'=>$bill->id])}}" accept-charset="UTF-8">
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
                        <td class="center" colspan="12" style="text-align: center">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>

                    <th>ID</th>
                    <th>{{trans('imports.number')}}</th>
                    <th>{{trans('imports.date')}}</th>
                    <th>{{trans('imports.supplier_id')}}</th>
                    <th>{{trans('imports.price_before_doller')}}</th>
                    <th>{{trans('imports.notes')}}</th>
                    <th>{{trans('imports.exp')}}</th>
                    <th>{{trans('imports.pdf')}}</th>
                    <th colspan="2" class="text-center">{{trans('عرض')}}</th>
                    <th class="text-center">{{trans('تحويل إلي فاتورة شراء')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($imports->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$imports->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$imports->appends(\Request::except('_token'))->render()}}</div>
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