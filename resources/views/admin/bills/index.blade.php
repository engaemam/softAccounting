@extends('admin.index')
@section('page_title')
    {{trans('bills.show')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('bills.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                <a href="{{aurl('bills/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('bills.create')}} </a>
            </div>
            <div class="col-md-2">
                <a href="{{Route('admin.bills.exportbills')}}" class="btn btn-success"> <i class="fa fa-database"></i> Excel </a>
            </div>
            <div class="col-md-6">
                <form method="get" action="{{aurl('bills')}}" >
                    <div class="input-group">
{{--                        <div class="form-group col-sm-5">--}}
{{--                            <label class="label-info"> رقم الفاتورة</label>--}}
{{--                            <input type="text" id="bill_number" value="{{ request()->bill_number != '' ? request()->bill_number : ''}}"  name="bill_number" class="form-control" autocomplete="off" placeholder="رقم الفاتورة .." >--}}
{{--                        </div>--}}

                        <div class="form-group col-sm-12">
                            <label class="label-info">  اسم المورد</label>
                            <select  class="form-control select2" name="suppliers_name">
                                <option value="">اختيار   اسم المورد</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->suppliers_name}}" @if($supplier->suppliers_name == request()->suppliers_name) selected @endif >{{$supplier->suppliers_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('from', 'من') !!}
                            {!! Form::date('from', null, ['class' => 'form-control',"id" => "datepicker1",'autocomplete="off"']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('to', 'الي') !!}
                            {!! Form::date('to', null, ['class' => 'form-control',"id" => "datepicker",'autocomplete="off"']) !!}
                        </div>




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

                    <th>{{trans('bills.bill_number')}}</th>
                    <th>{{trans('bills.date')}}</th>
                    <th>{{trans('bills.update')}}</th>
                    <th>{{trans('bills.supplier_id')}}</th>
                    {{--<th>{{trans('bills.price_before_doller')}}</th>--}}
                    <th>{{trans('bills.pdf')}}</th>
                    <th>{{trans('bills.notes')}}</th>
                    <th>{{trans('bills.barcode')}}</th>
                    {{--<th>{{trans('bills.tax')}}</th>--}}
                    {{--<th>{{trans('مصاريف الشحن')}}</th>--}}
                    <th  class="text-center">{{trans('bills.bill')}}</th>
                    <th>{{trans('admin.savedraft')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($bills->count()>0)
                    @foreach($bills as $bill)
                        @if(Auth::guard('admin')->user()->id == $bill->user_id OR Auth::guard('admin')->user()->role_id == 1)

                            <tr>
                                <td>{{$bill->id}}</td>
                                <td>{{ date("Y/m/d",strtotime($bill->created_at)) }}</td>
                                <td>{{ date("Y/m/d",strtotime($bill->updated_at)) }}</td>
                                <td>{{str_limit(@$bill->suppliers->suppliers_name,20)}}</td>
                                {{--<td>{{$bill->price_before_doller}}</td>--}}
                                <td>
                                    @if(\App\Model\Billspdf::where('id_bills',$bill->id)->count() > 0)
                                        <a href="{{aurl('bills/getpdf/'.$bill->id)}}" class="btn btn-primary" style="background-color: indianred"> <i class="fa fa-eye"></i> </a>

                                    @else
                                        <a href="{{aurl('bills/createGetPdf/'.$bill->id)}}" class="btn btn-warning" > <i class="fa fa-plus"></i> </a>

                                    @endif
                                </td>
                                @if($bill->notes == null)
                                    <td>لاتوجد</td>
                                @else
                                    <td>{{ str_limit($bill->notes,20)}}</td>
                                @endif
                                <td> <img  src="{{url('upload/barcodebills/'.$bill->barcode)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>
                            <!--
                                @if($bill->savedraft == 1)
                                    {{--//Start Add Texs--}}
                                        <td>
@if(in_array(38, $temp))
                                        @if(\App\Model\Addtaxs::where('id',$bill->id)->count() > 0)
                                            @if(in_array(74, $temp))
                                            <a href="{{aurl('addtaxs/'.$bill->id)}}" class="btn bg-purple" style="background-color: yellowgreen!important;"> <i class="fa fa-eye"></i> </a>
                                            @else
                                                {{trans('admin.role')}}
                                            @endif
                                        @else
                                            @if(in_array(75, $temp))
                                            <a href="{{aurl('addtaxs/addNew/'.$bill->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> </a>
                                            @else
                                                {{trans('admin.role')}}
                                            @endif
                                        @endif
                                    @else
                                        {{trans('admin.role')}}
                                    @endif

                                        </td>
{{--//End Add Texs--}}
                                    {{--//Start Add shipments--}}
                                    @if(in_array(38, $temp))
                                        @if(\App\Model\Shipments::where('id',$bill->id)->count() > 0)
                                            @if(in_array(74, $temp))
                                            <th><a href="{{aurl('shipments/'.$bill->id)}}" class="btn bg-purple"> <i class="fa fa-eye"></i> </a></th>
                                            @else
                                            <td>{{trans('admin.role')}}</td>
                                            @endif
                                        @else
                                            @if(in_array(75, $temp))
                                            <th> <a href="{{aurl('shipments/addNew/'.$bill->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i> </a></th>
                                            @else
                                            <td>{{trans('admin.role')}}</td>
                                            @endif
                                        @endif
                                    @else
                                    <td>{{trans('admin.role')}}</td>
                                    @endif
                                    {{--//End Add shipments--}}
                                @else
                                <td><span class="label label-danger">يجب التحويل</span></td>
                                <td><span class="label label-danger">يجب التحويل</span></td>
@endif
                                    -->

                                <td>
                                    <a href="{{aurl('bills/show/'.$bill->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a>

                                </td>
                                {{--<td>--}}
                                {{--<a href="{{aurl('bills/egyptshow/'.$bill->id)}}" class="btn btn-danger"> ج . م </a>--}}
                                {{--</td>--}}

                                <td>
                                    @if($bill->savedraft == 0)
                                        <form action="{{route('admin.bills.savedraftTosave')}}" method="post">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="id"  value="{{$bill->id}}">
                                            <button type="submit"  class="btn btn-microsoft">تحويل</button>
                                        </form>
                                    @else
                                        <p> <span class="label label-success">حفظ</span></p>
                                    @endif
                                </td>

                                @if($bill->savedraft == 0)
                                    @if(in_array(39, $temp))
                                        <td><a href="{{aurl('bills/'.$bill->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                                    @else
                                        <td>  <span class="label label-danger">{{trans('admin.role')}}</span></td>
                                    @endif
                                @else
                                    <td> <span class="label label-danger">لا يمكنك التعديل</span></td>
                                @endif

                                @if(in_array(40, $temp))
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
                                                    <form method="POST" action="{{url('admin/bills/')}}/{{$bill->id}}" accept-charset="UTF-8">
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
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td class="center" colspan="11" style="text-align: center">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>
                    <th>{{trans('bills.bill_number')}}</th>
                    <th class="col-md-2">{{trans('bills.date')}}</th>
                    <th class="col-md-2">{{trans('bills.update')}}</th>
                    <th>{{trans('bills.supplier_id')}}</th>
                    {{--<th>{{trans('bills.price_before_doller')}}</th>--}}
                    <th>{{trans('bills.pdf')}}</th>
                    <th>{{trans('bills.notes')}}</th>
                    <th>{{trans('bills.barcode')}}</th>
                    {{--<th>{{trans('bills.tax')}}</th>--}}
                    {{--<th>{{trans('مصاريف الشحن')}}</th>--}}
                    <th  class="text-center">{{trans('bills.bill')}}</th>
                    <th>{{trans('admin.savedraft')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </tfoot>

            </table>
            <br>
            @if(Auth::guard('admin')->user()->role_id == 1)
            @if($bills->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$bills->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$bills->appends(\Request::except('_token'))->render()}}</div>
                </div>
            @endif
            @else @endif
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
