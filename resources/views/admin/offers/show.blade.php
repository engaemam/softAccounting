@extends('admin.index')
@section('page_title')
    {{trans('Offer')}}
@endsection
@section('content')
    <style>
        @media print {
            .cprint
            {
                display: none;
            }
            .no-print{
                display: none;
            }
        }
    </style>
    <a href="{{ aurl('offers') }}" class="btn btn-primary no-print">رجوع</a>
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header pull-left">
                    <span class=""><img  src="{{url('asst_ar/img/logo.png')}}" style="max-width: 200px; max-height: 100px;" alt="" /></span>
                </h2>
                <h2 class="page-header ">
                    <small class="pull-right"><b>Offer ID</b> :  {{$offer->id}}<br></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>


        <!-- info row -->

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <b>Offer Name</b> : {{$offer->name}}<br>
                <br><td class="pull-left"><div style="margin-top: 10px">
                        <br>
                    </div>


                    <!-- /.col -->
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('items.image')}}</label>
                <div class="col-md-3">
                    <div class="fileinput @if($offer->image) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                        <div class="input-group input-large">
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                <img class="fileinput-filename" src="{{url('upload/offers/'.$offer->image)}}" style="max-width: 200px; max-height: 100px;" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <br><br>
            <div class="row">
                <div class="col-xs-12 table-responsive">


                    <!-- Table row ITEMS -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <!-- <h4 style="color: red">ال </h4> -->
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>منتجات العرض</th>
                                    <th>سعر البيع</th>
                                    <th>الإجمالي</th>

                                </tr>
                                </thead>
                                @php
                                    $i =0;
                                @endphp

                                {{--ITems--}}
                                <tbody>

                                @foreach ($items as $item)
                                    <tr>

                                        <td>{{$i+1}}</td>
                                        <td>{{$item->item_name}}</td>
                                        <td style="color: red; "><strike>{{$offer->selling_price}}</strike></td>
                                        <td>{{$offer->total_price_b}}</td>

                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach


                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <!-- accepted payments column -->

                        <!-- /.col -->
                        <div class="col-xs-12">
                            {{--                <p class="lead">{{trans('invoices.date')}}  {{$invoices->date}}</p>--}}

                            <div class="table-responsive">
                                <table class="table d-lg-table-row">
                                    <tr>
                                        <td class="col-md-2">
                                            <div style="font-weight: bolder">سعر العرض :
                                            </div>
                                        </td>

                                        <td class="col-md-4">
                                                <span style="color: green; font-size: larger">
                                                {{$offer->price}}
                                            </span>
                                        </td>
                                        <td></td>

                                    </tr>

                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>



@endsection
