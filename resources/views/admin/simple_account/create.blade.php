<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> soft accounting
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    <!-- Latest compiled and minified CSS -->
</head>
<body class="sidebar-mini skin-purple">




<div id="myDIV" style="display: none">
</div>

<!-- Main content -->

<!-- /.content -->
<!-- Main content -->
<section class="content" id="newCustomer">

    <div class="wrapper">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">انشاء حساب soft accounting</h3>
            </div>
            <!-- /.box-header -->
            @include('admin.layouts.message')
            <div class="box-body">

                <form method="POST" action="{{route('admin.Create_Account_Private.store')}}" accept-charset="UTF-8">
                    {!! csrf_field() !!}

                    <div class="form-group">


                        <label for="level">اختار المستخدم</label>
                        <select class="form-control select2" id="level" name="users">
                            <option selected="selected" value="">.............</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="btn btn-primary" type="submit" value="{{trans('admin.add')}}">
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    </div>
</section>
<!-- /.content -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- /.content -->


<!-- /.content-wrapper -->
<footer class="main-footer no-print" style="text-align: center">

    <strong>Copyright &copy; 2020 </strong> All rights
    reserved.

</footer>









<!-- Select2 -->
<script src="{{url('asst/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<!-- FastClick -->
<script src="{{url('asst/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('asst/dist/js/adminlte.min.js')}}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();


    })



</script>


</body>
</html>






