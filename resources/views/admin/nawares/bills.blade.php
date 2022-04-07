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
    
                                <th>رقم الفاتورة</th>
                                <th>تاريخ الأنشاء</th>
                                <th>تاريخ التحديث</th>
                                <th>السعر الصافي</th>
                                <th>سعر الشحن</th>
                                <th>حاله الفاتورة</th>
                               
                                <th style="text-align: center">تأكيد الاستلام</th>
                            </tr>
                        </thead>
    
    
                            <tbody>
                                @foreach ($bills as $key=>$item)
                                    <tr>

                                    <td>{{$item->id}}</td>
                                    <td> {{$item->created_at}}</td>
                                    <td> {{$item->updated_at}}</td>
                                    <td> {{$item->pirceatt}}</td>
                                    <td> {{$item->pricesumShipping}}</td>
                                    <td> {{$item->statue_customer_invoices->name}}</td>
                                  @if($item->status_id)
                                   <td style="color:red"> تم التاكيد</td>
                                  @else
                                  <td><a href="{{url('api/confirm/'.$item->id)}}" class="btn btn-primary"> تأكيد </a></td>
                                  @endif
                                    
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