@extends('admin.index')
@section('page_title')
    {{trans('taxes.show')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <div class="col-md-2">
            <h3 class="box-title">{{trans('taxes.show')}}</h3>
            </div>
            <div class="col-md-3">
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-warning"></i>
                   عملة الضرائب بالدينار العراقي
                </div>
            </div>
        </div>
        <div class="box-header">
            <form method="get" action="{{aurl('taxes/search')}}" >
                <div class="col-md-3">
                        <div class="input-group">

                            <div class="input-group-addon">
                                <label>من :</label>
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="from" value="{{ request()->from != '' ? request()->from : ''}}" class="form-control">
                        </div>
                </div>
                <div class="col-md-3">

                        <div class="input-group">

                            <div class="input-group-addon">
                                <label>إلي :</label>
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="to" value="{{ request()->to != '' ? request()->to : ''}}" class="form-control">
                        </div>
                </div>
                <div class="col-md-1">
                    <input type="submit" class="btn btn-primary" name="action" value="search" >

                </div>
                <div class="col-md-1">
                    <input type="submit" class="btn btn-warning" name="action" value="تصفية" >
                </div>

            </form>
            <div class="col-md-2" >
                <a href="{{aurl('taxes')}}" class="btn btn-primary"> رجوع</a>
            </div>





        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>

                    <th>{{trans('taxes.invoice')}}</th>
                    <th>{{trans('taxes.bills')}}</th>
                    <th>{{trans('taxes.sum')}}</th>
                </tr>
                </thead>
                <tbody>

                <tr>

                    <td>{{$tempTotalInvoices}}</td>
                    <td>{{@$tempTotalBills}}</td>
                    <td>{{$total}}</td>


                </tr>

                </tbody>
                <tfoot>
                <tr>

                    <th>{{trans('taxes.invoice')}}</th>
                    <th>{{trans('taxes.bills')}}</th>
                    <th>{{trans('taxes.sum')}}</th>
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