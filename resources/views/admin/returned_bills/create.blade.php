@extends('admin.index')
@section('page_title')
    {{trans('returned_bills.create')}}
@endsection
@section('content')

    <link rel="stylesheet" href="{{url('/')}}/js/bootstrap-select.min.css">


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('returned_bills.create')}}</h3>
        </div>

        <div class="box-header">
            <div class="col-md-4">
                <form action="{{route('admin.returnedbills.createRetured')}}" method="post">
                    {!! csrf_field() !!}
                    <select class="form-control select2" required name="invoice_id" dir="rtl">
                        <option value=""> برجاء اختر فاتورة بيع</option>
                        @foreach($invoices as $invce)
                            <option name="{{$invce}}">{{$invce}}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <button class="btn btn-success"> تأكيد</button>
                </form>

            </div>
        </div>

    </div>
    <!-- /.box -->

    <!-- Modal -->

    <!-- Start Ahmed Gorashi-->

@endsection
