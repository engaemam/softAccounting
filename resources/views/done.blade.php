<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- <meta http-equiv="refresh" content="3;url={{$links}}/" /> -->
 
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
<body>
<div class="jumbotron text-center">
    <h1 class="display-3" style="text-align: center; color: green">
        نشكركم على اختيارنا .... سوف يتم مراجعة الطلب..
        
        
        </h1>
   
    @foreach($links as $link)
        <div class="col-md-3">
        <a href="{{$link->link}}" class="btn btn-warning btn-lg btn-block" style="margin-top: 10%;margin-bottom: 10%" target="_blank">{{$link->name}}</a>
            
        </div>
    @endforeach

</div>

</body>
</html>