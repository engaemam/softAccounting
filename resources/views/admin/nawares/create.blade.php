@extends('admin.index')
@section('content')


    <form class="form-horizontal" id="form-register" action="{{route('api.submit')}}" dir="rtl" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @foreach($invoices as $key=>$inv)



            <input type="text" name="api_invoice_id[]" value="{{$inv}}" hidden>
        @endforeach
        @foreach($answers as $key=>$k)
            @if($k['invociesall'][$key]->alnawares_id == 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="page-title"> @lang('invoices1.create')</h5>
                    </div>
                    <div class="panel-body">
                        <div id="maindiv">
                            <div class="form-group">

                                {{-- <label for="package_id"  class="col-sm-1 control-label">{{trans('invoices1.package_id')}}</label> --}}
                                <div class="col-sm-3">
                                    {{-- {{dd($k['invociesall'])}} --}}
                                    <input type="text" name="package_id[]" value="{{$k['invociesall'][$key]->branch_id}}" hidden>
                                    <input type="text" name="area_id[]" value="{{$k['invociesall'][$key]->area_id}}" hidden>
                                    {{-- <select name="package_id[]" dir="rtl"  id="package_id{{$key}}" required class="form-control  mainAreas{{$key}}">
                                        <option value="">{{trans('invoices1.choosepackageSelect')}}</option>
                                       @foreach($data as $j)
                                    <option value="{{$j->id}}" @if($k['invociesall'][0]->branch_id == $j->id) selected @endif data-id{{$key}}="{{$j->branch_receiver->id}}">{{$j->branch_sender->title }} -> {{$j->branch_receiver->title}}</option>
                                        @endforeach
                                    </select> --}}



                                    {{-- <script>
                                         $(document).ready(function() {
                                             $(document).on("change",".mainAreas{{$key}}",function(){

                                                 var dataiddd{{$key}} = $(".mainAreas{{$key}} option:selected").attr('data-id{{$key}}');
                                                 // alert(dataiddd{{$key}});

                                                 $.get("{{url('api/ajaxAreas/').'/'}}"+ dataiddd{{$key}}, function(data){

                                                     $('#subAreas{{$key}}').html(data);
                                                 });
                                             });
                                         });
                                     </script>
                                 </div>
                                 <label for="subAreas" class="col-sm-1 control-label">{{trans('invoices1.area_id')}}</label>
                                 <div class="col-sm-2">
                                 <select name="area_id[]" dir="rtl"  id="subAreas{{$key}}"  required class="form-control select2 subAreas{{$key}}">
                                         <option value="">برجاء اختر  {{trans('invoices1.area_id')}}</option>

                                     </select> --}}
                                </div>


                            </div>


                            <div class="form-group has-feedback">
                                <label for="receiver_name[]" class="col-sm-1 control-label">{{trans('invoices1.receiver_name')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" required id="receiver_name"  value="{{ $k['clients']->name_client}}" name="receiver_name[]" class="form-control"  placeholder="{{trans('invoices1.receiver_name')}}">
                                </div>
                            </div>




                            <div class="form-group">

                                <label for="address2" class="col-sm-2 control-label">{{trans('invoices1.to')}}</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="address2"  name="receiver_address[]" required  value="{{ $k['invociesall'][$key]->address}}" placeholder="{{trans('invoices1.to')}}">{{$k['clients']->city}} </textarea>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="receiver_mobile1" class="col-sm-1 control-label">{{trans('invoices1.receiver_mobile1')}}</label>
                                <div class="col-sm-4">

                                    <input type="text" id="receiver_mobile1" required name="receiver_mobile1[]" class="form-control"  value="{{ $k['clients']->mobile}}"  placeholder="{{trans('invoices1.receiver_mobile1')}}">
                                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="shippingstatus_id" class="col-sm-1 control-label">{{trans('invoices1.shippingstatus_id')}}</label>
                                <div class="col-sm-2">
                                    <select name="shippingstatus_id[]"  id="shippingstatus_id" class="form-control" required="">
                                        <option value="">{{trans('invoices1.selectShippingstatus_id')}}</option>
                                        @foreach($data1 as $shippingstatu)
                                            <option value="{{$shippingstatu->id}}" @if($shippingstatu->id == 3) selected @endif> {{ $shippingstatu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="number_packages" class="col-sm-1 control-label">{{trans('invoices1.number_packages')}}</label>
                                <div class="col-sm-2">
                                    <input type="text" id="number_packages" min="1"  name="number_packages[]" value="{{ $k['quantity'][$key][0]}}" class="form-control"  placeholder="{{trans('invoices1.number_packages')}}" readonly>
                                </div>
                                <label for="weight_package" class="col-sm-1 control-label">{{trans('invoices1.weight_package')}}</label>
                                <div class="col-sm-2">
                                    <input type="text" id="weight_package" min="0" step="any" oninput="" value="{{old('weight_package')}}"  name="weight_package[]" class="form-control"  placeholder="{{trans('invoices1.weight_package')}}">
                                    <script>
                                        function check(input) {
                                            if (input.value <= 0) {
                                                input.setCustomValidity('الوزن لا يقبل الصفر او قيمة اقل من الصفر');
                                            } else {
                                                // input is fine -- reset the error message
                                                input.setCustomValidity('');
                                            }
                                        }
                                    </script>
                                </div>


                            </div>

                            <div class="form-group">

                                <div id="price_input">
                                    <label for="price" class="col-sm-1 control-label">{{trans('invoices1.price')}}</label>
                                    <div class="col-sm-2">

                                        <input type="text" id="price" value="{{ $k['invociesall'][0]->total_final_mgza}}" required name="price[]" class="form-control"  placeholder="{{trans('invoices1.price')}}" readonly>
                                    </div>
                                </div>



                            </div>

                        </div>




                        <div class="form-group">
                            <label for="notes" class="col-sm-1 control-label">{{trans('invoices1.notes')}}</label>
                            <div class="col-sm-10">
                                <textarea name="notes[]" class="form-control" placeholder="{{trans('invoices1.notes')}}">{{old('notes')}}</textarea>
                            </div>
                        </div>





                    </div>

                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="page-title"> @lang('invoices1.create')</h5>
                    </div>
                    <div class="panel-body">
                        <div id="maindiv">

                            <div class="form-group has-feedback">
                                <label for="receiver_name[]" class="col-sm-1 control-label">رقم الطلب</label>
                                <div class="col-sm-10">
                                    <input type="text" required id="receiver_name" readonly  value="{{ $k['invociesall'][0]->alnawares_id}}" name="alnawares_id[]" class="form-control"  placeholder="رقم الطلب">
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="receiver_name[]" class="col-sm-1 control-label">مصدر الطلب</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly id="receiver_name"  value="سوق النوارس"  class="form-control"  placeholder="مصدر الطلب">
                                </div>
                            </div>


                            <div class="form-group has-feedback">
                                <label for="receiver_name[]" class="col-sm-1 control-label">الشحن</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Shiping_status[]">
                                        <option value="1">شحن</option>
                                        <option value="2">رفض</option>
                                    </select>
                                </div>
                            </div>


                        </div>


                    </div>

                </div>

            @endif

        @endforeach
        <div class="box-footer">
            <div class="col-sm-1">
                <button type="submit" id="register" class="btn btn-primary pull-right">{{trans('invoices1.global.app_save')}}</button>


            </div>
            <div class="col-sm-1">
                {{-- <button class="btn btn-danger" type="reset" onclick="window.location='{{route('admin.invoices1')}}';return false;">{{trans('invoices1.global.cancel')}}</button> --}}
            </div>
            <div class="col-sm-2">
                <button class="btn default" type="reset">{{trans('invoices1.global.reset')}}</button>
            </div>

        </div>
    </form>



@endsection
{{-- <input type="hidden" name="loggedInUserId" id="loggedInUserId" value="{{ auth()->user()->id }}" /> --}}
@section('javascript')








@endsection