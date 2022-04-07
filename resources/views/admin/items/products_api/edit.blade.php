@extends('admin.index')
@section('page_title')
@endsection
@section('content')
    <h3 class="page-title">@lang('admin.products.edit') -  <span style="color: green"> {{$product->ar_title}}</span></h3>

       <form method="POST" action="{{route('admin.products_api.update' , $product->id)}}" class="" enctype='multipart/form-data' >
     {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
           منتج <span style="color: green">{{$product->ar_title}}</span>
        </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('ar_title') ? ' has-error' : '' }}">
                        <label for="ar_title" class="control-label"> اسم المنتج باللغة العربية  *</label>
                        <input class="form-control" value="{{$product->ar_title}}" name="ar_title" type="text" id="name">
                        <span id="error_name"></span>
                        <p class="help-block"></p>
                        @if($errors->has('ar_title'))
                            <p class="help-block">
                                {{ $errors->first('ar_title') }}
                            </p>
                        @endif
                    </div>
                </div>
    
                  <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('en_title') ? ' has-error' : '' }}">
                        <label for="en_title" class="control-label"> اسم المنتج باللغة الانجليزية *</label>
                        <input class="form-control" value="{{$product->en_title}}" name="en_title" type="text" id="name">
                        <span id="error_name"></span>
                        <p class="help-block"></p>
                        @if($errors->has('en_title'))
                            <p class="help-block">
                                {{ $errors->first('en_title') }}
                            </p>
                        @endif
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                        <label for="code" class="control-label"> كود المنتج     *</label>
                        <input class="form-control" value="{{$product->code}}" name="code" type="text" >
                        <span id="error_name"></span>
                        <p class="help-block"></p>
                        @if($errors->has('code'))
                            <p class="help-block">
                                {{ $errors->first('code') }}
                            </p>
                        @endif
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('brand') ? ' has-error' : '' }}">
                        <label for="brand" class="control-label"> ماركة المنتج *</label>
                        <input class="form-control" value="{{$product->brand}}" name="brand" type="text" id="name" >
                        <span id="error_name"></span>
                        <p class="help-block"></p>
                        @if($errors->has('brand'))
                            <p class="help-block">
                                {{ $errors->first('brand') }}
                            </p>
                        @endif
                    </div>
                </div>



                
                   <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="category_id" class="control-label">  قسم المنتج *</label>
                        <select class="form-control"  name="category_id" id="select_cat" >       
                            @if($portCat != null)
                            <option value="{{$portCat->id}}"> {{@$portCat->name}} </option>
                            @else
                              <option value=" "> لا يوجد قسم له </option>
                            @endif
                        @foreach($allcategories as $allcategorie)
                            <option value="{{$allcategorie->id}}"> {{@$allcategorie->name}}  </option>
                      @endforeach             
                        </select>
    
                        <span id="error_name"></span>
                        <p class="help-block"></p>
                        @if($errors->has('category_id'))
                            <p class="help-block">
                                {{ $errors->first('category_id') }}
                            </p>
                        @endif
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('file', ' صورة المنتج *', ['class' => 'control-label']) !!}
                         <input type="file" name="images[]" multiple class="form-control">
                        <span id="error_email"></span>
                        <p class="help-block"></p>
                        @if($errors->has('file'))
                            <p class="help-block">
                                {{ $errors->first('file') }}
                            </p>
                        @endif
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                       <label for="price" class="control-label"> سعر المنتج  *</label>
                        <input class="form-control" value="{{$product->price}}" name="price" type="text" id="price">
                        <p class="help-block"></p>
                        @if($errors->has('price'))
                            <p class="help-block">
                                {{ $errors->first('price') }}
                            </p>
                        @endif
                    </div>
                </div>
                  <br>

                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="color" class="control-label"> الوان المنتج </label>
                        <select class="form-control select2 color"  name="color_id[]" multiple="" id="color_id" >
                            <option value=""> </option>
                            @foreach($color as $colors)
                                <option value="{{$colors->id}}" @if(in_array($colors->id,array_column($product->specifics1,'specific_id')))selected @endif> {{$colors->name_ar}}</option>
                            @endforeach
                        </select>
                        <span id="error_name"></span>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="size" class="control-label">  البائع  </label>
                        <select class="form-control select2" required  name="user_id"  >
                            <option value=""> </option>
                            @foreach($user as $users)
                                <option value="{{$users->id}}" @if($product->user_id == $users->id) selected @endif> {{$users->ar_name}}</option>
                            @endforeach
                        </select>                    <span id="error_name"></span>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="size" class="control-label">  مقاس المنتج </label>
                        <select class="form-control select2 size"  name="size_id[]" multiple="" id="size_id" >
                            <option value=""> </option>
                            @foreach($size as $sizes)
                                <option value="{{$sizes->id}}"@if(in_array($sizes->id,array_column($product->specifics2,'specific_id'))) selected @endif  > {{$sizes->name_ar}}</option>
                            @endforeach
                        </select>                    <span id="error_name"></span>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('discount') ? ' has-error' : '' }}">
                       <label for="discount" class="control-label"> هل هناك خصم علي المنتج ؟ اذا لم يكن هناك خصم فضع صفر    *</label>
                        <input class="form-control" value="{{$product->discount}}" type="number" name="discount" type="text" id="discount">
                        <p class="help-block"></p>
                        @if($errors->has('discount'))
                            <p class="help-block">
                                {{ $errors->first('discount') }}
                            </p>
                        @endif
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('price_after_discount') ? ' has-error' : '' }}">
                       <label for="price_after_discount" class="control-label">  سعر المنتج بعد الخصم  *</label>
                        <input class="form-control" value="{{$product->price_after_discount}}" name="price_after_discount" type="text" id="price_after_discount">
                        <p class="help-block"></p>
                        @if($errors->has('price_after_discount'))
                            <p class="help-block">
                                {{ $errors->first('price_after_discount') }}
                            </p>
                        @endif
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('point') ? ' has-error' : '' }}">
                       <label for="point" class="control-label"> نقاط المنتج  *</label>
                        <input class="form-control" value="{{$product->point}}" name="point" type="number" >
                        <p class="help-block"></p>
                        @if($errors->has('point'))
                            <p class="help-block">
                                {{ $errors->first('point') }}
                            </p>
                        @endif
                    </div>
                </div>
    
           
                <div class="row">
                    <div class="col-xs-12 form-group  {{ $errors->has('active') ? ' has-error' : '' }} "> الحالة : 
                @if($product->active === 1)
                              <input type="radio" name="active" value="1"  checked="true" /> <i class="fa fa-thumbs-o-up"></i>  مفتوح 
                              <input type="radio" name="active"  value="0"  /> <i class="fa fa-thumbs-o-down"></i> مغلق
                              @else
                              <input type="radio" name="active"  value="1" /> <i class="fa fa-thumbs-o-up"></i> مفتوح
                              <input type="radio" name="active"  value="0" checked="true" /> <i class="fa fa-thumbs-o-down"></i> مغلق
                              @endif
    
                              <span id="error_email"></span>
                              <p class="help-block"></p>
                              @if($errors->has('active'))
                                  <p class="help-block">
                                      {{ $errors->first('active') }}
                                  </p>
                              @endif
    
                              </div>
                </div>

    
             
            <div class="row">
                <div class="col-xs-12 form-group  {{ $errors->has('fet') ? ' has-error' : '' }} "> منتج مميز : 
            @if($product->fet === 1)
                          <input type="radio" name="fet" value="1"  checked="true" /> <i class="fa fa-thumbs-o-up"></i>  مفتوح 
                          <input type="radio" name="fet"  value="0"  /> <i class="fa fa-thumbs-o-down"></i> مغلق
                          @else
                          <input type="radio" name="fet"  value="1" /> <i class="fa fa-thumbs-o-up"></i> مفتوح
                          <input type="radio" name="fet"  value="0" checked="true" /> <i class="fa fa-thumbs-o-down"></i> مغلق
                          @endif

                          <span id="error_email"></span>
                          <p class="help-block"></p>
                          @if($errors->has('fet'))
                              <p class="help-block">
                                  {{ $errors->first('fet') }}
                              </p>
                          @endif

                          </div>
            </div>


    
            <div class="row">
                <div class="col-xs-12 form-group  {{ $errors->has('stock') ? ' has-error' : '' }} "> هل المنتج متاح بالمخازن   : 
            @if($product->stock === 1)
                          <input type="radio" name="stock" value="1"  checked="true" /> <i class="fa fa-thumbs-o-up"></i>  مفتوح 
                          <input type="radio" name="stock"  value="0"  /> <i class="fa fa-thumbs-o-down"></i> مغلق
                          @else
                          <input type="radio" name="stock"  value="1" /> <i class="fa fa-thumbs-o-up"></i> مفتوح
                          <input type="radio" name="stock"  value="0" checked="true" /> <i class="fa fa-thumbs-o-down"></i> مغلق
                          @endif

                          <span id="error_email"></span>
                          <p class="help-block"></p>
                          @if($errors->has('stock'))
                              <p class="help-block">
                                  {{ $errors->first('stock') }}
                              </p>
                          @endif

                          </div>
            </div>

    
                <div class="row" >   
                    <div class="col-xs-12 form-group {{ $errors->has('qty') ? ' has-error' : '' }}">
                    <label for="mobile" class="control-label">@lang('admin.products.qty')*</label>
                        <input type="text" name="qty" required class="form-control" value="{{$product->qty}}">
                              <p class="help-block"></p>
                        @if($errors->has('qty'))
                            <p class="help-block">
                                {{ $errors->first('qty') }}
                            </p>
                        @endif
                    </div>
                    </div>
                </div>
    
                 <div class="panel-body">
                 <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('ar_body') ? ' has-error' : '' }}">
                    <label for="ar_body" class="control-label"  rows="30" cols="50">{{trans('admin.products.ar_body')}} *</label>
                        <textarea class="form-control " name="ar_body">{{$product->ar_body}}</textarea>
                               <p class="help-block"></p>
                        @if($errors->has('ar_body'))
                            <p class="help-block">
                                {{ $errors->first('ar_body') }}
                            </p>
                        @endif
                    </div>
                </div>
    
                 <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('en_body') ? ' has-error' : '' }}">
                    <label for="en_body" class="control-label"  rows="30" cols="50">{{trans('admin.products.en_body')}} *</label>
                        <textarea class="form-control " name="en_body">{{$product->en_body}}</textarea>
                               <p class="help-block"></p>
                        @if($errors->has('en_body'))
                            <p class="help-block">
                                {{ $errors->first('en_body') }}
                            </p>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
        <input type="submit" name="submit" value="{{trans('admin.products.edit')}}" class="btn btn-primary" > 
    </form>
<script>
    $('#size_id').trigger('change');
    $('#color_id').trigger('change');
</script>
@stop

