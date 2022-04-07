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
            <h3 class="box-title">{{trans('clients.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{route('admin.clients.storeBills')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name_company" class="col-sm-1 control-label">{{trans('clients.name_company')}}</label>
                        <div class="col-sm-5">
                            <input type="text" name="name_company" class="form-control" id="name_company" required placeholder="{{trans('clients.name_company')}}">
                        </div>
                        <label for="name_client" class="col-sm-1 control-label">{{trans('clients.name_client')}}</label>
                        <div class="col-sm-4">
                            <input type="text" name="name_client" class="form-control" id="name_client" placeholder="{{trans('clients.name_client')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-sm-1 control-label">{{trans('clients.city')}}</label>
                        <div class="col-sm-5">
                            <select name="city" class="form-control select2" required>
                                <option value="">   -----   اختيار المدينة     ----- </option>
                                <option value="القاهرة">القاهرة</option>
                                <option value="الجيزة">الجيزة</option>
                                <option value="الإسكندرية">الإسكندرية</option>
                                <option value="الإسماعيلية">الإسماعيلية	</option>
                                <option value="أسوان">أسوان	</option>
                                <option value="أسيوط">أسيوط</option>
                                <option value="الأقصر">الأقصر</option>
                                <option value="البحر الأحمر">البحر الأحمر</option>
                                <option value="البحيرة">البحيرة</option>
                                <option value="بني سويف	">بني سويف	</option>
                                <option value="بورسعيد">بورسعيد</option>
                                <option value="جنوب سيناء">جنوب سيناء</option>
                                <option value="الدقهلية">الدقهلية</option>
                                <option value="دمياط">دمياط</option>
                                <option value="سوهاج">سوهاج</option>
                                <option value="السويس">السويس</option>
                                <option value="الشرقية">الشرقية</option>
                                <option value="شمال سيناء">شمال سيناء	</option>
                                <option value="الغربية">الغربية</option>
                                <option value="الفيوم">الفيوم</option>
                                <option value="القليوبية">القليوبية</option>
                                <option value="قنا">قنا</option>
                                <option value="كفر الشيخ">كفر الشيخ</option>
                                <option value="مطروح">مطروح</option>
                                <option value="المنوفية">المنوفية</option>
                                <option value="المنيا">المنيا</option>
                                <option value="الوادي الجديد">الوادي الجديد</option>
                                <option value="اخري">اخري</option>
                            </select>
                        </div>
                        <label for="client_position" class="col-sm-1 control-label">{{trans('clients.client_position')}}</label>
                        <div class="col-sm-4">
                            <input type="text" name="client_position" class="form-control" id="client_position" placeholder="{{trans('clients.client_position')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-1 control-label">{{trans('clients.phone')}}</label>
                        <div class="col-sm-5">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="{{trans('clients.phone')}}">
                        </div>
                        <label for="mobile" class="col-sm-1 control-label">{{trans('clients.mobile')}}</label>
                        <div class="col-sm-4">
                            <input type="text" name="mobile" class="form-control" id="mobile" placeholder="{{trans('clients.mobile')}}" required>
                        </div>
                    </div>

                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-1 control-label">{{trans('clients.notes')}}</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" name="notes" placeholder="{{trans('clients.notes')}}"></textarea>
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



