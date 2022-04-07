<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> لوحة التحكم  |@yield('page_title') </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('/')}}/asst/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/')}}/asst/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url('/')}}/asst/bower_components/Ionicons/css/ionicons.min.css">

    <!-- Theme style -->
    @if(direction()=='ltr')
    <link rel="stylesheet" href="{{url('/')}}/asst/dist/css/AdminLTE.min.css">
    @else
        <link rel="stylesheet" href="{{url('/')}}/asst_ar/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asst_ar/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asst_ar/dist/css/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asst_ar/dist/css/rtl.css">

        <link href="https://fonts.googleapis.com/css?family=Cairo:300,400&amp;subset=arabic,latin-ext" rel="stylesheet">
        <style type="text/css">
            html,body,alart,h1,h2,h3,h4,h5,h6{
                font-family: 'Cairo', sans-serif;
            }
        </style>
@endif
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{url('/')}}/asst/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{url('/')}}/asst/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{url('/')}}/asst/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{url('/')}}/asst/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('/')}}/asst/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('/')}}/js/select2.min.css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{url('/')}}/asst/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">

    <!-- jQuery 3 -->
    <script src="{{url('/')}}/asst/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{url('/')}}/asst/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="{{url('/')}}/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="dist/clipboard.min.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Latest compiled and minified CSS -->
</head>
<body class="sidebar-mini skin-purple">
<div class="wrapper">

