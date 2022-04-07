@extends('admin.index')
@section('content')


    <form class="form-horizontal" id="form-register" action="{{route('api.submit')}}" dir="rtl" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
      
        
         

        
            <div class="panel panel-default">
           
            <div class="panel-body">
            
                <div class="box-body table-responsive table-bordered">
                    <table class="table table-hover table-bordered" style="border: 1px solid #f0f0f0;">
                        <thead>
                            <tr>
    
                                <th>رقم البوليصة</th>
                                <th>رقم الفاتوره</th>
                                <th>تاريخ الأنشاء</th>
                                <th>سعر البوليصة</th>
                                <th>مبلغ الشحن</th>
                                <th>صافي البوليصة</th>
                                <th>مرسل إلية</th>
                                <th>موبايل</th>
                          
                                <th>العنوان المرسل إلية </th>
                                <th>حالة البوليصة</th>
                                
    
                                <th style="text-align: center">العمليات</th>
                            </tr>
                        </thead>
    
    
                            <tbody>
                        
                                @foreach ($invoices as $key=>$item)
                                    <tr>

                                    {{-- <td>{{$item->invoices->data[]->invoicestatus}}</td> --}}
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->api_invoice_id}}</td>
                                    <td> {{$item->created}}</td>
                                    <td> {{$item->price}}</td>
                                    <td> {{$item->shipping_price}}</td>
                                    <td> {{$item->total_price}}</td>
                                    <td>  {{$item->receiver_name}}</td>
                                    <td>  {{$item->receiver_mobile1}}</td>
                                    <td>  {{$item->receiver_address}}</td>   
                                    <td>  {{$item->invoicestatus->name}}</td>

                                    <td><a target="_blank" href="http://al-nawares.com/api/get-print?invoice_id={{$item->id}}"><button type="button" class="btn btn-bitbucket btn-lg btn-flat btn-block">طباعه البوليصة <i class="fa fa-print"></i></button></a></td>
                                      
                                    </tr>


                                @endforeach
                            </tbody>
                            
                </table>




 
              

            </div>

            </div>
         
  
        <div class="box-footer">
           
            <div class="col-sm-1">
                {{-- <button class="btn btn-danger" type="reset" onclick="window.location='{{route('admin.invoices1')}}';return false;">{{trans('invoices1.global.cancel')}}</button> --}}
            </div>
           

        </div>
    </form>
 
 

    @endsection
   {{-- <input type="hidden" name="loggedInUserId" id="loggedInUserId" value="{{ auth()->user()->id }}" /> --}}
@section('javascript')








@endsection