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
@if(count($errors->all()) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        <h2>{{ session('success') }}</h2>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> خطأ</h4>
        <h4>{{ session('error') }}</h4>
    </div>
@endif
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('suppliers.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.suppliers.storeBills')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="suppliers_name" class="col-sm-1 control-label">{{trans('suppliers.suppliers_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="suppliers_name" class="form-control" id="suppliers_name" placeholder="{{trans('suppliers.suppliers_name')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="manager_name" class="col-sm-1 control-label">{{trans('suppliers.manager_name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="manager_name" class="form-control" id="manager_name" placeholder="{{trans('suppliers.manager_name')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="position_manger" class="col-sm-1 control-label">{{trans('suppliers.position_manger')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="position_manger" class="form-control" id="position_manger" placeholder="{{trans('suppliers.position_manger')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="suppliers_number" class="col-sm-1 control-label">{{trans('suppliers.suppliers_number')}}</label>
                        <div class="col-sm-5">
                            <input type="number" name="suppliers_number" class="form-control" id="suppliers_number" placeholder="{{trans('suppliers.suppliers_number')}}">
                        </div>
                        <label for="mobile" class="col-sm-1 control-label">{{trans('suppliers.mobile')}}</label>
                        <div class="col-sm-4">
                            <input type="number" name="mobile" required class="form-control" id="mobile" placeholder="{{trans('suppliers.mobile')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="col-sm-1 control-label">{{trans('suppliers.country')}}</label>
                        <div class="col-sm-5">
                            <input type="text" name="country" class="form-control" id="country" placeholder="{{trans('suppliers.country')}}" required>
                        </div>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>

                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



