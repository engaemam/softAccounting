@extends('admin.index')
@section('content')




    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('addtaxs.show')}}</h3>
        </div>
        <div class="box-header">
            <div class="col-md-2">
                <a href="{{aurl('bills')}}" class="btn btn-primary"> <i class="fa fa-backward"></i> {{trans('العودة للفاتورة ')}} </a>
            </div>
            <div class="col-md-2">
                @if(in_array(80, $temp))

                <a href="{{aurl('addtaxs/addNew/'.$bill->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i>{{trans('addtaxs.create')}}</a>
                    @endif
            </div>

            <div class="col-md-2">
                <a href="#" class="btn btn-danger"><i class="fa fa-warning"> </i> عملة الفاتورة : {{$bill->currency->currency_name}}</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!--<a href="{{aurl('addtaxs/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('addtaxs.create')}} </a>-->

            <br>
            <table  id="myTable"  class="table table-bordered table-striped deviceitems display">
                <thead>
                <tr>

                    <th>ID</th>
                    <th>{{trans('addtaxs.bill_id')}}</th>
                    <th>{{trans('addtaxs.shipping')}}</th>
                    <th>{{trans('addtaxs.value')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>


@foreach($addtaxs as $k => $shipment)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$shipment->bills->bill_number}}</td>

                            <?php
                            $shipping_id=explode(',',$shipment->addtaxnames_id) ;

                            foreach($shipping_id as $id){
                                $name[]=\App\Model\Addtaxnames::find($id)->name;
                            }
                            $type_expense = implode(',',$name);

                            ?>
                            <td>
                                @foreach($shipping_id as $id)
                                    {{$name[]=\App\Model\Addtaxnames::find($id)->name}}
                                @endforeach
                            </td>
                            <td>{{$shipment->price}}</td>
                            @if(in_array(81, $temp))
                            <td><a href="{{aurl('addtaxs/'.$shipment->id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a></td>
                            @else
                                <td>{{trans('admin.role')}}</td>
                            @endif
                            @if(in_array(82, $temp))
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_items{{ $shipment->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_items{{ $shipment->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{url('admin/addtaxs/')}}/{{$shipment->id}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input name="bill_id" type="hidden" value="{{$bill->id}}">

                                                <div class="modal-body">
                                                    <h4>{{ trans('admin.delete_this',['name'=>$shipment->bills->bill_number]) }}</h4>
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
                    <th>{{trans('addtaxs.bill_id')}}</th>
                    <th>{{trans('addtaxs.shipping')}}</th>
                    <th>{{trans('addtaxs.value')}}</th>
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





@endsection