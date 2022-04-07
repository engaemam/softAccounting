<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('asst/assets/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance:textfield;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="container-fluid">
<h2 class="page-header pull-left" style="margin-top: 1px;padding-top: 1px;">
    <span class=""><img  src="{{url('asst_ar/img/logo.png')}}" style="width: 200px; max-height: 120px;" alt="" /></span>
</h2>
<div class="col-12 table-responsive" style="direction: rtl; text-align: right">
    <h1>{{$offer->name}}</h1>
    <br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>الكمية</th>
            <th>المنتج</th>
            <th>المواصفة</th>
            <th>مواصفة 2</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offer->items as $item)
        <tr>
            <td>1</td>
            <td>{{$item->item_name}}</td>
            <?php

                if(!$color =\App\Model\Colors::find(request('color_'.$item->id))){
                    $color= \App\Model\Colors::find(1);
                }
            ?>
            <td>{{$color->name}}</td>
            <?php

            if(!$size =\App\Model\Sizes::find(request('size_'.$item->id))){
                $size= \App\Model\Sizes::find(1);
            }
            ?>
            <td>{{$size->name}}</td>
            <td>{{$item->price}}</td>
        </tr>
        @endforeach
        </tbody>

            <div class="row">
                <div class="col-md-4">
                <span style="font-size: larger; margin-left: 10px;">
                  <strong>
                    السعر
                    </strong>
                </span>
                <span style="color: darkgreen; font-size: larger;margin-left: 10px">{{$offer->price}} EGP</span>
                </div>
                <div class="col-md-4">
                    <span style="font-size: larger; margin-left: 10px;">
                  <strong>
                    الكمية
                    </strong>
                </span>
                <span style="color: darkgreen; font-size: larger; margin-left: 10px">{{request('quant')}}</span>
                </div>
                <div class="col-md-4">
                    <span style="font-size: larger; margin-left: 10px;">
                  <strong>
                    الاجمالي
                    </strong>
                </span>
                    <span style="color: darkgreen; font-size: larger; margin-left: 10px">{{request('total')}} EGP</span>
                </div>
            </div>
        <br>

    </table>
</div>
    <hr>
    <div class="row" style="direction: rtl; text-align: right">
        <div class="col-md-6">
            <h2 style="text-decoration: underline; color: darkblue">سجل بياناتك</h2>
            <small style="color:red;"> مطلوب *</small>
            <br>
            <small style="color:red;">  اذا قمت بتجاهل حقل الايميل والباسورد ستقوم بكتابة بياناتك في كل مرة عند الطلب ..</small>
            <br><br>
            <form class="form-horizontal" method="POST" action="/offers">
                {!! csrf_field() !!}
                <input hidden >
                <div class="box-body">
                    <div class="form-group">
                        <label for="email" class="col-sm-1 control-label"> الايميل</label>
                        <div class="col-sm-4">
                            <input  type="email" name="email" class="form-control" id="name_client" placeholder="الايميل">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_client" class="col-sm-1 control-label">الباسوورد</label>
                        <div class="col-sm-4">
                            <input type="password" name="password" class="form-control" id="name_client" placeholder="الباسوورد">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_client" class="col-sm-1 control-label">* {{trans('clients.name_client')}}</label>
                        <div class="col-sm-4">
                            <input type="text" required name="name_client" class="form-control" id="name_client" placeholder="{{trans('clients.name_client')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-sm-1 control-label">* {{trans('clients.city')}}</label>
                        <div class="col-sm-4">
                            <select name="city" class="form-control select2">
                                <option value="">   -----   اختيار المدينة     ----- </option>
{{--                                @foreach($cities as $city)--}}
{{--                                    <option value="{{$city->name}}">{{$city->name}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-1 control-label">* {{trans('clients.phone')}}</label>
                        <div class="col-sm-10">
                            <input required type="number" name="phone" class="form-control" id="phone" placeholder="{{trans('clients.phone')}}">
                        </div>
                    </div>

                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">* {{trans('clients.notes')}}</label>
                        <div class="col-sm-10">
                            <textarea required class="form-control" name="notes" placeholder="{{trans('clients.notes')}}"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_client" class="col-sm-1 control-label">* الرقم البريدي</label>
                        <div class="col-sm-4">
                            <input type="number" required name="postalCode" class="form-control" id="name_client" placeholder="الرقم البريدي">
                        </div>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary pull-right">اطلب الان</button>
                    </div>
{{--                    <div class="col-sm-2">--}}
{{--                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>--}}
{{--                    </div>--}}
                </div>
                <!-- /.box-footer -->
            </form>
            <br>
        </div>


        <div class="col-md-6" style="border-right: 1px solid #ccc;">
        <div class="login-box  container-fluid">
            <h2 class="page-header pull-left" style="margin-top: 1px;padding-top: 1px; text-align: center">
                <span class=""><img  src="{{url('asst_ar/img/logo.png')}}" style="width: 200px; max-height: 120px;" alt="" /></span>
            </h2>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">مسجل بياناتك بالفعل</p>

                    <form action="/validate" method="post">
                        {{csrf_field()}}
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

{{--                    <div class="social-auth-links text-center mb-3">--}}
{{--                        <p>- OR -</p>--}}
{{--                        <a href="#" class="btn btn-block btn-primary">--}}
{{--                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook--}}
{{--                        </a>--}}
{{--                        <a href="#" class="btn btn-block btn-danger">--}}
{{--                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <!-- /.social-auth-links -->--}}

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        </div>
    </div>
</div>
</body>
<!-- jQuery -->
<script src="{{asset('asst/assets/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('asst/assets/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('asst/assets/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
</html>