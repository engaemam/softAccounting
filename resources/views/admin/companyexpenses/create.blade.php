@extends('admin.index')
@section('page_title')
    {{trans('companyexpenses.create')}}
@endsection
@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('companyexpenses.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal"  method="POST" action="{{route('admin.companyexpenses.store')}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-1 control-label">{{trans('companyexpenses.catttt')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" required name="id_catcompanyexpenses">
                                    <option value="">{{trans('companyexpenses.select')}}</option>

                                @foreach($catCompanys as $catCompany)
                                    <option value="{{$catCompany->id}}" @if(@$deviceId == @$catCompany->id) selected @endif>{{$catCompany->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="date" class="col-sm-1 control-label">{{trans('companyexpenses.date')}}</label>
                        <div class="col-sm-4">
                            <input type="date" required name="date" class="form-control"   placeholder="{{trans('companyexpenses.date')}}">
                        </div>




                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-1 control-label">{{trans('companyexpenses.title')}}</label>
                        <div class="col-sm-4">
                            <input type="text" required name="title" class="form-control"  placeholder="{{trans('companyexpenses.title')}}">
                        </div>

                        <label for="price" class="col-sm-1 control-label">{{trans('companyexpenses.price')}}</label>
                        <div class="col-sm-4">
                            <input type="number" required name="price" class="form-control"  placeholder="{{trans('companyexpenses.price')}}">
                        </div>

                    </div>







                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
                    </div>

                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->



@endsection