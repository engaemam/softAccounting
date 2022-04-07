@extends('admin.index')
@section('page_title')
    {{trans('invoices.show')}}

@endsection
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<script src="http://code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('invoices.show')}}</h3>
        </div>

        <div class="box-header">
            @if(in_array(51, $temp))
            <div class="col-md-2">
                <a href="{{aurl('invoices/create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{trans('invoices.create')}} </a>
            </div>
            @endif
{{--                <form class="form-horizontal" method="POST" action="{{route('admin.invoices.printInvoices')}}"  enctype="multipart/form-data">--}}
{{--                    {!! csrf_field() !!}--}}
{{--                <button class="btn btn-success pull-left">طباعة المزيد</button>--}}
{{--                </form>--}}
            <div class="col-md-6">
                <form method="get" action="{{aurl('invoices')}}" >
                    <div class="input-group">
                        <div class="form-group col-sm-12">
                            <label for="city" class="control-label">{{trans('clients.city')}}</label>
                            <div>
                                <select name="city" class="form-control select2">
                                    <option value="">   -----   اختيار المدينة     ----- </option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->name}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <label class="label-info"> اسم الزبون</label>
                            <select  class="form-control select2" name="name_client">
                                <option value="" >اختيار اسم الزبون</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->name_client}}" @if($client->name_client == request()->name_client) selected @endif >{{$client->name_client}}</option>
                                @endforeach
                            </select>
                            @if(Auth::guard('admin')->user()->role_id == 1 OR Auth::guard('admin')->user()->role_id == 4)
                             <br><br>
                            <label class="label-info"> اسم المستخدم</label>
                            <select name="user_id" class="form-control py-2 w-100 select2">
                                <option value=""> اختيار اسم المستخدم</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('from', 'من') !!}
                            {!! Form::date('from', null, ['class' => 'form-control',"id" => "datepicker1",'autocomplete="off"']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('to', 'الي') !!}
                            {!! Form::date('to', null, ['class' => 'form-control',"id" => "datepicker",'autocomplete="off"']) !!}
                        </div>
                        <span class="col-sm-12">
                          <button type="submit" class="btn btn-info btn-lg btn-flat">بحث!</button>
                          <button type="submit" name="exports" value="excel" class="btn btn-success btn-lg btn-flat pull-left"><i class="fa fa-database"></i> Excel!</button>
                        </span>

                    </div>
                </form>
            </div>
                <div class="col-md-3">
                    <form method="POST" action="{{route('admin.invoices.printInvoices')}}" >
                        {!! csrf_field() !!}
                        <div class="input-group">
                            <div class="form-group col-sm-12">
                                <label for="city" class="control-label">{{trans('clients.city')}}</label>
                                <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">
                                <div>
                                    <select name="city[]" class="form-control select2" multiple>
                                        <option value="">   -----   اختيار المدينة     ----- </option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->name}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <span class="col-sm-12">
                          <button type="submit" class="btn btn-bitbucket btn-lg btn-flat btn-block">طباعة <i class="fa fa-print"></i></button>
                        </span>

                        </div>
                    </form>
                </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table class="table table-bordered" id="product-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>إسم الزبون</th>
                    <th>العنوان</th>
                    <th>الحدث</th>
                    <th><button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button></th>
                </tr>
                </thead>
            </table>


        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->




@endsection

<script>



    $(function() {
        $('#product-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.invoices.getdata') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'client_id', name: 'client_id' },
                { data: 'city', name: 'city' },
                {data: 'action', name: 'action', orderable: false, searchable: false},
                { data:'checkbox', name: 'checkbox',orderable:false, searchable:false}
            ]
        });
    });

    $(document).on('click', '#bulk_delete', function(){
        var id = [];
        if(confirm("Are you sure you want to Delete this data?"))
        {
            $('.student_checkbox:checked').each(function(){
                id.push($(this).val());
            });
            if(id.length > 0)
            {
                $.ajax({
                    url:"{{ route('ajaxdata.massremove')}}",
                    method:"get",
                    data:{id:id},
                    success:function(data)
                    {
                        //window.location.href = data.redirect;
                        alert(data);
                        $('#student_table').DataTable().ajax.reload();
                    }
                });
            }
            else
            {
                alert("Please select atleast one checkbox");
            }
        }
    });
</script>