@extends('front.index_ar')
@section('page_title'){{$page[4]->mate_title_ar}}@endsection
@section('page_des'){{$page[4]->mate_description_ar}}?>@endsection

@section('content')

<!-- Start Choclate Bg -->
<div class="choclate-bg mb-lg-5" style="background-image: url({{url('upload/pages/'.$page[4]->image)}})!important;"></div>

<!-- /End Choclate Bg -->

<!-- Start Breadcrumb -->
<div class="bg-red">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent border-0 rounded-0 px-0 mb-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}" class="text-white">الرئيسية</a></li>
                <li class="breadcrumb-item color-white">المنتجات</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /End Breadcrumb -->

<!-- Start Welcome Message -->
<div class="container my-3 my-lg-5">
    <div class="content_page">
        <h3 class="text-blue pl-3 font-18 mt-4 mb-2 content_title font-weight-600">المنتجات</h3><hr>
        <div class="row mt-lg-5">
            @foreach($products as $product)
            <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-5">
                <div class="product-item box-shadow">
                    <a href="{{url('/products/product/').'/'.$product->id.'/'.$product->title_ar}}">
                        <img src="{{url('upload/products/'.$product->image)}}" alt="{{$product->title_ar}}" class="w-100 transition product-item-img">
                    </a>
                    <div class="caption text-center p-3 transition">
                        <h3 class="my-3">
                            <a href="{{url('/products/product/').'/'.$product->id.'/'.$product->title_ar}}" class="text-red text-blue-hover font-17 font-weight-600 underline-hover-0">{{$product->title_ar}}</a>
                        </h3>
                        <p class="text-blue font-weight-600 line-height-25">
                            {!! mb_substr(strip_tags( $product->description_ar),0, 150) !!}..
                        </p>
                    </div>
                </div>
            </div>
            @endforeach



        </div>


            {{ $products->links() }}

    </div>
</div>
<!-- /End Welcome Message -->
@endsection
