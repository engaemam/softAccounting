
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> offer
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('asst/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('asst/bower_components/font-awesome/css/font-awesome.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('asst_ar/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{url('asst_ar/dist/css/bootstrap-rtl.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Cairo:300,400&amp;subset=arabic,latin-ext" rel="stylesheet">
    <style type="text/css">
        html,body,alart,h1,h2,h3,h4,h5,h6{
            font-family: 'Cairo', sans-serif;
        }
    </style>

    <link rel="stylesheet" href="{{url('js/select2.min.css')}}">




    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        #myDIV {
            width: 100%;
            padding: 50px 0;
            text-align: center;
            background-color: lightblue;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="box-header">
            <!--<a href="{{ url()->previous() }}" class="btn btn-default">Back</a>-->
            <h3 class="box-title">طلبات العروض</h3>
        </div>


        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>تاريخ الطلب</th>
                    <th>رقم الطلب</th>
                    <th>{{trans('invoices.client_id')}}</th>
                    
                    <th>المدينة</th>
                   

                    <th>حالة الطلب</th>
                   
                    <th>{{trans('عرض')}}</th>
                    <th>رفض الطلب</th>
                </tr>
                </thead>
                <tbody>
                @if($invoices->count()>0)
                    <?php
                            $i=-1;
                            $j=-1;
                            $k=-1;
                    ?>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{date("Y/m/d",strtotime($invoice->created_at))}}</td>
                            
                            <td>{{$invoice->id}}</td>
                        
                            <td>{{str_limit(@$invoice->clients->name_client,15)}}</td>
                            
                            
                           
                            
                            <td>{{str_limit(@$invoice->clients->city,15)}}</td>
                            {{--                                <td> <img  src="{{url('upload/barcode/'.$invoice->barcode)}}" style="max-width: 100px; max-height: 100px;" alt="" /></td>--}}
                                

                                
                                @if($reqs[$i]['status'] == 1)
                                <td style="font-weight: bold">قيد المراجعة</td>
                                @else
                                 <td style="font-weight: bold ; color:red">تم لإالغاء الطلب</td>
                                @endif

                            <td><a href="{{route('usershowReq',$invoice->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a></td>
                         
                            <!-- Start Commented -->
                                <td>
                            @if($invoice->shipping_status == null OR $invoice->status_id != 3)
                                        <a href="{{route('requests.changestatus',$invoice->id)}}" class="btn btn-primary"> <i class="fa fa-trash"></i> </a>
                            @else
                            @endif
                                    <!-- Modal -->
                                    <div id="del_invoices{{ $invoice->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                                                </div>
                                                
                                                    <div class="modal-body">
                                                        <h4>{{ trans('admin.delete_this',['name'=>$i]) }}</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                   
                                                    </div>
                                               
                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <!-- End Commented -->
                           
                        </tr>
                        
                    @endforeach

                @else
                    <tr>
                        <td class="center" colspan="11" style="text-align: center">
                            {{trans('الجدول خالي')}}
                        </td>
                    </tr>
                @endif


                </tbody>
            </table>
        </div>

        {{--        </form>--}}
        <br>
        @if($invoices->count()>0)
            <div class="row">
               
                    <div class="col-md-5 col-sm-3 ">{{trans('devices.no')}}{{$invoices->total()}} </div>
               
                <div class="col-md-7 col-sm-7">{{$invoices->appends(\Request::except('_token'))->render()}}</div>
            </div>
        @endif
    <!-- /.box-body -->

    </div>
</body>



<script>
    function atleast_onecheckbox(e) {
        if ($("input[type=checkbox]:checked").length === 0) {
            e.preventDefault();
            alert('الرجاء إختيار فاتورة واحده على الأقل لطباعتها');
            return false;
        }
    }
    $('#statusform').submit(function (event) {
        event.preventDefault();
        alert('test');
        var postData ={
            'email':$('#loginEmail').val() ,
            'password':$('#loginPassword').val() ,
        } ;

        $.ajax({
            type:'POST',
            url:'/login',
            data: postData,
            success: function(response){
                console.log();
                console.log();
                $('input[name="name_client"]').val(response['name_client']);
                $('input[name="country"]').val(response['country']);
                $('input[name="city"]').val(response['city']);
                $('#address').val(response['client_position']);
                $('#notes').val(response['notes']);
                $('input[name="phone"]').val(response['phone']);
                $('input[name="postal"]').val(response['postalCode']);
                $('input[name="id"]').val(response['id']);
                $('#loginForm').hide();
                $('input[name="email"]').hide();
                $('input[name="password"]').hide();
                $('#client').text('Welcome '+response['name_client']);
            },
            error: function (response) {
                $('.alert-danger').text(response.responseJSON.error);
                $('.alert-danger').show();
                $('.alert').fadeOut(4000);
            }
        })
    })</script>

</html>
  
    <!-- /.box -->


