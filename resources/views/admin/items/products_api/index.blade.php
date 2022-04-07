@extends('admin.index')
@section('page_title')
    @lang('admin.products.title')
@endsection
@section('content')

        <h3 class="page-title">@lang('admin.products.title')</h3>
    
    <p>
        <a href="{{ route('admin.products_api.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>@lang('admin.products.add')</a>
    </p>


    <div class="panel panel-default">
        <div class="panel-heading">

        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($products) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;">ID.</th>

                        <th>@lang('admin.products.ar_title')</th>
                        <th>@lang('admin.products.en_title')</th>
                        <th>@lang('admin.products.image')</th>
                        <th>@lang('admin.products.category')</th>
                         <th>@lang('admin.products.price')</th>
                        <th>@lang('admin.products.qty')</th>
                        <th>@lang('admin.products.ar_body')</th>
                        <th>تمت الاضافة من خلال</th>
                        <th>الحالة</th>
                        <th>تعديل</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr data-entry-id="{{ $product->id }}">
                                <td>{{ $product->id }}</td>
                                  <td>{{ @$product->ar_title }}</td>
                                   <td>{{ @$product->en_title }}</td>
                                   @php
                                  $images = explode('|', $product->images);
                                  $image = end($images)
                                   @endphp
                                   
                                   <td>

                                   <img src="{{$url}}/storage/upload/{{$image}}" width="100px" height="100px">
                                
                                   </td>
                                   <td>  
                                         
                                <b> 
                                  @if($product->category  != null)
                                  {{@$product->category->name}}
                                  @else 
         <span style="color:red">لقد تم حذف القسم الذي ينتمي اليه </span>
                                   @endif
                                  <b>
                                       </td>
                                   <td>{{ $product->price_after_discount }}</td>
                                   <td>{{ $product->qty }}</td>

                                   <td>{{ $product->ar_body }}</td>
                                   <td>
                                       @if($product->added_by == null)
                                       الادمن
                                       @else
                                        @if($product->user != null)
                                        {{$product->user->ar_name}}
                                        @else 
                                        تم اضافته من بائع تم حذف بياناته
                                        @endif
                                       @endif
                                   </td>
                                   <td>
                                    @if($product->active == 1)
                                    <span class="label label-success label-many">مفعل</span>
                                    @else
                                     <span class="label label-danger label-many">غير مفعل</span>
                                    </td>
                                    @endif
                                   </td>

                                {{--<td>--}}

                                    {{--<a href="{{ route('admin.products_api.edit',[$product->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>--}}

                     {{--</td>--}}




                        @endforeach



                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
@stop
