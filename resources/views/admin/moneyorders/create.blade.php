@extends('admin.index')
@section('page_title')
    {{trans('moneyorders.create')}}
@endsection
@section('content')

    <div class="alert alert-danger alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <i class="fa fa-warning"></i> <strong>ملاحظة!    </strong>يرجي الانتظار حتي اكتمال تحميل الصفحة
    </div>
    <div class="box">

        <div class="box-header">

            <h3 class="box-title">{{trans('moneyorders.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('moneyorders.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <script>
                        $(function(){
                            $('#type').change(function(){
                                var status =  parseInt($("#type").val());

                                if(status === 1 ) {
                                    $("#Invoices").fadeIn(1);
                                    $("#Bills").fadeOut(1);
                                }
                                else if(status === 3 ) {
                                    $("#Invoices").fadeIn(1);
                                    $("#Bills").fadeOut(1);
                                }
                                else
                                {
                                    $("#Invoices").fadeOut(1);
                                    $("#Bills").fadeIn(1);

                                }

                            });
                        });

                    </script>

                    <script>
                        $(document).ready(function() {
                            $(document).on("change","#client_id",function(){
                                $.get("{{url('admin/moneyorders/moneyordersClientAjax/').'/'}}"+ $(this).val(), function(data){

                                    $('#Invoice_id').html(data);
                                });
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $(document).on("change","#supplier_id",function(){
                                $.get("{{url('admin/moneyorders/moneyordersSuppliersAjax/').'/'}}"+ $(this).val(), function(data){

                                    $('#bill_id').html(data);
                                });
                            });
                        });
                    </script>
                    <div class="form-group">
                        <label for="type" class="col-sm-1 control-label">{{trans('moneyorders.type')}}</label>
                        <div class="col-sm-3">
                            <select name="type" id="type" class="form-control" required>
                                <option value="">برجاء اختيار</option>
                                <option value="1">امر قبض</option>
                                <option value="2">امر دفع</option>
                                {{--<option value="3">امر خصم</option>--}}
                            </select>
                        </div>
                        <label for="number" class="col-sm-1 control-label">{{trans('moneyorders.number')}}</label>
                        <div class="col-sm-3">
                            <input type="text"  name="number" class="form-control" id="number" placeholder="{{trans('moneyorders.number')}}">
                        </div>
                        <label for="dates" class="col-sm-1 control-label">{{trans('moneyorders.dates')}}</label>
                        <div class="col-sm-2">
                            <input type="date" required name="dates" class="form-control" id="dates" placeholder="{{trans('moneyorders.dates')}}">
                        </div>
                    </div>

                    <div class="form-group">

                        <div id="Bills" style="display: none">
                            <label for="supplier_id" class="col-sm-1 control-label">{{trans('الموردين')}}</label>
                            <div class="col-sm-3">
                                <select name="supplier_id" id="supplier_id" class="form-control select2" >
                                    <option value="" >برجاء اختيار اسم المورد</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->suppliers_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="bill_id" class="col-sm-1 control-label">{{trans('فواتير شراء')}}</label>
                            <div class="col-sm-3">
                                <select name="bill_id" id="bill_id" class="form-control select2" >
                                    <option value="">برجاء اختيار رقم الفاتورة</option>
                                    @foreach($bills as $bill)
                                        <option value="{{$bill->id}}">{{$bill->id}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div id="Invoices" style="display: none">
                            <label for="client_id" class="col-sm-1 control-label">{{trans('moneyorders.client_id')}}</label>
                            <div class="col-sm-3">
                                <select name="client_id" id="client_id" class="form-control select2" >
                                    <option value="" > اختيار اسم الزبون</option>
                                    @foreach($clients as $list)
                                        <option value="{{ $list->id }}" > {{ $list->name_client }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="invoice_id" class="col-sm-1 control-label">{{trans('فواتير بيع')}}</label>
                            <div class="col-sm-3">
                                <select name="invoice_id" id="Invoice_id" class="form-control select2" >
                                    <option value="">برجاء اختيار رقم الفاتورة</option>
                                    @foreach($invoices as $invoice)
                                        <option value="{{$invoice->id}}">{{$invoice->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <label for="value" class="col-sm-1 control-label">{{trans('moneyorders.value')}}</label>
                        <div class="col-sm-2">
                            <input type="number" required name="value" class="form-control" id="value" placeholder="{{trans('moneyorders.value')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="currency_id" class="col-sm-1 control-label">{{trans('moneyorders.currency_id')}}</label>
                        <div class="col-sm-3">
                            <select name="currency_id" id="currency_id" class="form-control select2"  required>
                                <option value="">برجاء اختيار العملة </option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}">{{$currency->currency_name}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('moneyorders.notes')}}</label>
                        <div class="col-sm-10">
                            <textarea name="notes" class="form-control" id="notes"></textarea>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection