@extends('admin.index')
    @section('page_title')
        {{trans('taxes.TaxClearance')}}
    @endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('taxes.TaxClearance')}}</h3>
        </div>
        <div class="box-header">

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table  id=""  class="table table-bordered table-striped ">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{trans('taxes.datefrom')}}</th>
                    <th>{{trans('taxes.dateto')}}</th>
                    <th>{{trans('taxes.invoice')}}</th>
                    <th>{{trans('taxes.bills')}}</th>
                    <th>{{trans('taxes.sum')}}</th>

                </tr>
                </thead>
                <tbody>

                @if($taxes->count()>0)
                    @foreach($taxes as $tax)

                        <tr>
                            <td>{{$tax->id}}</td>
                            <td>{{$tax->datefrom}}</td>
                            <td>{{$tax->dateto}}</td>
                            <td>{{$tax->invoices}}</td>
                            <td>{{$tax->bills}}</td>
                            <td>{{$tax->total}}</td>

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
                    <th>{{trans('taxes.datefrom')}}</th>
                    <th>{{trans('taxes.dateto')}}</th>
                    <th>{{trans('taxes.invoice')}}</th>
                    <th>{{trans('taxes.bills')}}</th>
                    <th>{{trans('taxes.sum')}}</th>

                </tr>
                </tfoot>

            </table>
            <br>
            @if($taxes->count()>0)
                <div class="row">
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$taxes->total()}} </div>
                    <div class="col-md-7 col-sm-7">{{$taxes->appends(\Request::except('_token'))->render()}}</div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->






@endsection