@extends('admin.index')
    @section('page_title')
        {{trans('suppliers.suppliers')}}
    @endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('suppliers.suppliers')}}</h3>
        </div>
        <div class="box-header">
            @if(in_array(16, $temp))
            <div class="col-md-2">
                <a href="{{aurl('suppliers/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('suppliers.create')}} </a>
            </div>
            @endif
            <div class="col-md-2">
                <a href="{{Route('admin.suppliers.export6')}}" class="btn btn-success"> <i class="fa fa-database"></i> Excel </a>
            </div>
            <div class="col-md-5">
                <form method="get" action="{{aurl('suppliers')}}" >
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
                    <th>{{trans('suppliers.suppliers_name')}}</th>
                    <th>{{trans('suppliers.manager_name')}}</th>
                    <th>{{trans('suppliers.position_manger')}}</th>
                    <th>{{trans('suppliers.suppliers_number')}}</th>
                    <th>{{trans('suppliers.mobile')}}</th>
                    <th>{{trans('suppliers.country')}}</th>
                    <th>{{trans('منتجات الموردين')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($suppliers->count()>0)
                    @foreach($suppliers as $supplier)

                        <tr>
                            <td>{{$supplier->id}}</td>
                            <td>{{$supplier->suppliers_name}}</td>
                            <td>{{$supplier->manager_name}}</td>
                            <td>{{$supplier->position_manger}}</td>
                            <td>{{$supplier->suppliers_number}}</td>
                            <td>{{$supplier->mobile}}</td>
                            <td>{{$supplier->country}}</td>
                            @if(in_array(17, $temp))
                                @if(\App\Model\Supplierproducts::where('supplier_id',$supplier->id)->count() > 0)

                                    <th><a href="{{aurl('supplierproducts/'.$supplier->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></th>
                                @else
                                    <th> <a href="{{aurl('supplierproducts/addNew/'.$supplier->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> </a></th>
                                @endif
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            @if(in_array(18, $temp))
                            <td><a href="{{aurl('suppliers/'.$supplier->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif

                            @if(in_array(19, $temp))
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_suppliers{{ $supplier->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_suppliers{{ $supplier->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{url('admin/suppliers/')}}/{{$supplier->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$supplier->suppliers_name]) }}</h4>
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
                    <th>{{trans('suppliers.suppliers_name')}}</th>
                    <th>{{trans('suppliers.manager_name')}}</th>
                    <th>{{trans('suppliers.position_manger')}}</th>
                    <th>{{trans('suppliers.suppliers_number')}}</th>
                    <th>{{trans('suppliers.mobile')}}</th>
                    <th>{{ trans('suppliers.country')}}</th>
                    <th>{{trans('منتجات الموردين')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if($suppliers->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$suppliers->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$suppliers->appends(\Request::except('_token'))->render()}}</div>
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