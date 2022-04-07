@extends('admin.index')
@section('page_title')
    {{trans('companyexpenses.edit')}}
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('companyexpenses.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{url('admin/companyexpenses/')}}/{{$expenses->id}}"  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-1 control-label">{{trans('companyexpenses.catttt')}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" required name="id_catcompanyexpenses">
                                <option value="">{{trans('companyexpenses.select')}}</option>
                                @foreach($catCompanys as $catCompany)
                                    <option value="{{$catCompany->id}}" @if($catCompany->id == $expenses->id_catcompanyexpenses ) selected @endif>{{$catCompany->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="date" class="col-sm-1 control-label">{{trans('companyexpenses.date')}}</label>
                        <div class="col-sm-4">
                            <input type="date" required name="date" class="form-control" value="{{$expenses->date}}"   placeholder="{{trans('companyexpenses.date')}}">
                        </div>


                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-1 control-label">{{trans('companyexpenses.title')}}</label>
                        <div class="col-sm-4">
                            <input type="text" required name="title" class="form-control" value="{{$expenses->title}}"  placeholder="{{trans('companyexpenses.title')}}">
                        </div>

                        <label for="price" class="col-sm-1 control-label">{{trans('companyexpenses.price')}}</label>
                        <div class="col-sm-4">
                            <input type="number" required name="price" class="form-control"value="{{$expenses->price}}"   placeholder="{{trans('companyexpenses.price')}}">
                        </div>
                    </div>






                </div>
                <div class="box-footer ">
                    <button class="btn default" type="reset">{{trans('bills.reset')}}</button>

                    <button type="submit" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
                </div><!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->




@endsection