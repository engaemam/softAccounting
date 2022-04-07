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
            <div class="col-md-2">
                <a href="{{aurl('imports')}}" class="btn btn-primary"> <i class="fa fa-backward"></i> {{trans('العودة الاستيراد ')}} </a>
            </div>
            <div class="col-md-3">
                @if(in_array(101, $temp))
                <a href="{{aurl('importnames/create')}}" class="btn btn-info"> <i class="fa fa-plus"></i> {{trans('importnames.create')}} </a>
                @endif
            </div>
            <div class="col-md-2">
                @if(in_array(105, $temp))

                <a href="{{aurl('importexpenses/addNew/'.$imports->id)}}" class="btn btn-warning"> <i class="fa fa-plus"></i>اضافة مصاريف الاستيراد </a>
                    @endif
            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!--<a href="{{aurl('importexpenses/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('importexpenses.create')}} </a>-->

            <br>
            <table  id="myTable"  class="table table-bordered table-striped deviceitems display">
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


@foreach($importexpenses as $k => $importexpens)
                        <tr>
                            <td>{{$k + 1}}</td>
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
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_items{{ $importexpens->id }}"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div id="del_items{{ $importexpens->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                            </div>
                                            <form method="POST" action="{{route('admin.importexpenses.destroy',['id'=>$importexpens->id])}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}

                                                <input name="import_id" type="hidden" value="{{$imports->id}}">

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



        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->


    <!-- Trigger the modal with a button -->





@endsection