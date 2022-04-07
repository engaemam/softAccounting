@extends('admin.index')
@section('page_title')
    {{trans('projects.show')}}
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{url('/')}}/js/addclasss.js"></script>
    <style>
        @media print {
            .no-print {
                visibility: hidden;
            }
            .checkbox{
                display: none;
            }
            .main-footer{
                display: none;
            }
            .zzz{
                display: none;
            }
            .no-print{
                display: none;
            }
        }
    </style>
    <a href="{{ URL::previous() }}" class="btn btn-primary no-print">Back</a>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header pull-left">
                    <i class="fa fa-globe pull-left "></i><span class="">LinahSol</span>
                </h2>
                <h2 class="page-header ">
                    <b>{{trans('projects.project_number')}} : </b> {{$projects->project_number}}<br>
                </h2>
            </div>
            <!-- /.col -->
        </div>

        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <b>{{trans('projects.name')}} : </b> {{$projects->name}}<br>
                <br>
                <b>{{trans('projects.type')}} : </b> {{$projects->type}} <br>
                <br>
                <b>{{trans('projects.name')}} : </b> {{$projects->name}}<br>
                <br>

                @if($projects->image_deal)
                    <button type="button" class="btn btn-info zzz" data-toggle="modal" data-target="#myModal">{{trans('projects.image_deal')}}</button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{trans('projects.image_deal')}}</h4>
                                </div>
                                <div class="modal-body">
                                    <img src="{{url('upload/projects/'.$projects->image_deal)}}" style="max-width: 850px">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($projects->image_bill)
                    <button type="button" class="btn btn-primary zzz" data-toggle="modal" data-target="#myModal2">{{trans('projects.image_bill')}}</button>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal2" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{trans('projects.image_bill')}}</h4>
                                </div>
                                <div class="modal-body">
                                    <img src="{{url('upload/projects/'.$projects->image_bill)}}" style="max-width: 850px">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                @if($projects->type == 'عرض تنفيذ')
                <div class="print1"><input class="no-print" type="checkbox" id="select12" > <b>{{trans('projects.project_start_date')}} : </b> {{$projects->project_start_date}} <br> </div>
                <br>
                <div class="print2"><input class="no-print" type="checkbox" id="select13" > <b>{{trans('projects.project_creation_date')}} : </b> {{$projects->project_creation_date}}<br> </div>
                <br>
                <div class="print4"> <b>{{trans('projects.date_delivery')}} : </b> {{$projects->date_delivery}} <br> </div>
                <br>
                <div class="print4"><b>{{trans('projects.date_expirat')}} : </b> {{$projects->date_expirat}}<br> </div>
                @endif
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>{{trans('projects.id_client')}} : </b> {{$projects->clients->name_client}}<br>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <br><br>
        <!-- Table row ITEMS -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <!-- <h4 style="color: red">ال </h4> -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>عدد</th>
                        <th>اسم </th>
                        <th>كمية</th>
                        <th>سعر الافرادي</th>
                        <th>اجمالي</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($projectdevices as $key=>$projectdevice)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{@$projectdevice->devices->devices_name}}</td>
                            <td>{{$projectdevice->quantity}}</td>
                            <td>{{round($projectdevice->onedevice,2)}}</td>
                            <td>{{round($projectdevice->total_price,2)}}</td>
                        </tr>

                    @endforeach
                    </tbody>

                    <tbody>

                    @foreach ($projectitems as $key => $projectitem)
                        <tr>

                            <td>{{$key+1}}</td>
                            <td>{{@$projectitem->items->item_name}}</td>
                            <td>{{$projectitem->quantity_b}}</td>
                            <td>{{round($projectitem->price_b,2)}}</td>
                            <td>{{round($projectitem->total_price_b,2)}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
    {{--row--}}

    <!-- Table Devices row -->


        {{--row--}}

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">

            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">المشروع </p>

                <div class="table-responsive">
                    <table class="table">
                        <tr class="no-print">
                            {{--<th class="no-print">العملة</th>--}}
                            {{--<td >--}}
                                {{--<select class="" name="item_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">--}}
                                    {{--<option value="{{url("/admin/projects/show/$projects->id")}}">-----اختيار العملة  ----</option>--}}
                                    {{--@foreach ($currencies as $currency )--}}
                                        {{--<option value="{{url("/admin/projects/show/$projects->id/$projects->currency_id/$currency->id")}}"--}}
                                                {{--@if(isset($rate) && $currency->id == $rate->to_currency_id) selected @endif--}}
                                        {{-->--}}
                                            {{--{{$currency->currency_name}}--}}
                                        {{--</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</td>--}}
                        </tr>
                        <tr>
                            <th style="width:50%">{{trans('projects.project_value')}}</th>



                            @if(!$rate)
                                <td>{{@round($projects->total_project,2)}} {{@$projects->currency->currency_name}} </td>
                            @else
                                <td>{{$rate->rate*$projects->total_project}} {{$rate->currencytorate->currency_name}} </td>
                            @endif
                        </tr>
                        <tr>
                            <th>{{trans('مصاريف المشروع')}}</th>

                            @if(!$rate)
                                <td>{{@round($projects->project_after_tax,2)}} {{@$projects->currency->currency_name}} </td>
                            @else
                                <td>{{$rate->rate*$projects->project_after_tax}} {{$rate->currencytorate->currency_name}} </td>
                            @endif
                        </tr>
                        <tr>
                            <th>{{trans('إجمالي المشروع')}}</th>

                            @if(!$rate)
                                <td>{{round($projects->total_project + $projects->project_after_tax,2)}} {{@$projects->currency->currency_name}} </td>
                            @else
                                <td>{{$rate->rate*($projects->total_project + $projects->project_after_tax)}} {{$rate->currencytorate->currency_name}} </td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <button onclick="window.print()">Print</button>
            </div>
        </div>
    </section>


    <!-- /.content -->
    <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->

@endsection
