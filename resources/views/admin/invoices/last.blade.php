<div class="box-body">
    <form class="form-horizontal" method="POST" style="display: none" id="show" action="{{route('invoices.store')}}"  enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="form-group">

                {{--                        <label class="col-sm-1 control-label">{{trans('invoices.invoices_number')}}</label>--}}
                {{--                        <div class="col-sm-3">--}}
                {{--                            <input type="text" required name="invoice_number" class="form-control"  placeholder="{{trans('invoices.invoices_number')}}">--}}
                {{--                        </div>--}}<br><br>
                {{--                        --}}
                {{--                        <label  class="col-sm-2 control-label">{{trans('admin.username')}}</label>--}}
                {{--                        <div class="col-sm-3">--}}
                {{--                           <h4>{{ Auth::guard('admin')->user()->name }}</h4>--}}
                {{--                        </div>--}}
            </div>

            <div class="form-group">
                <input type="hidden" name="client_id" value="{{ $modelid }}">
                <label for="name_client" class="col-sm-1 control-label">{{trans('invoices.client_id')}}</label>
                <div class="col-sm-3">
                    <input type="text" name="name_client" class="form-control" id="name_client" placeholder="{{trans('invoices.client_id')}}" required>
                </div>
                <label for="city" class="col-sm-1 control-label">{{trans('clients.city')}}</label>
                <div class="col-sm-3">
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
            </div>
            <div class="form-group">
                <label for="notes" class="col-sm-1 control-label">{{trans('clients.notes')}}</label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="notes" placeholder="{{trans('clients.notes')}}"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-1 control-label">{{trans('clients.phone')}}</label>
                <div class="col-sm-7">
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="{{trans('clients.phone')}}">
                </div>
            </div>


            <div class="form-group">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>تحميل PDF</th>

                        <th>
                            <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="AddPdf" type="button"><i class="glyphicon glyphicon-plus"></i> </button>

                        </th>
                    </tr>
                    </thead>
                    <tbody id="InsertPdf">

                    </tbody>
                </table>
            </div>
            <div class="form-group">

                <label class="col-sm-1 control-label" for="name">{{trans('invoices.invoice_source')}}</label>
                <div class="col-sm-3">
                    <select class="form-control select2" name="invoice_source_id" required>
                        <option class="form-control" value="">-----مصدر فاتورة البيع ----</option>
                        @foreach ($invoicesources as $invoicesource )
                            <option value="{{$invoicesource->id}}">{{ $invoicesource->name }} </option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="notes" class="col-sm-1 control-label">{{trans('invoices.notes')}}</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="notes" placeholder="{{trans('invoices.notes')}}"></textarea>
                </div>
            </div>



            <!-- Strat -->
            <!-- /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab"> </a></li>
                        {{--<li><a href="#settings2" data-toggle="tab">مجمع</a></li>--}}
                    </ul>
                    <div class="form-group">
                        <div class="col-sm-5"></div>

                        <div class="col-sm-4">
                            <button class="btn btn-default" style="background-color: #32c5d2;color: #fff;" id="Badd" type="button"><i class="glyphicon glyphicon-plus"></i> اضافة مواد</button>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">

                            <div class="box-body">
                                <div class="form-group">

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>اختيار اسم الماده</th>
                                            <th>المواصفة</th>
                                            <th>مواصفة 2</th>
                                            <th>العدد</th>
                                            <th>سعر الماده</th>
                                            <th>الاجمالي</th>
                                            <th>
                                                #

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="maindiv">

                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="total_price" class="col-sm-2 control-label">إجمالي سعر الأصناف</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="total_final_mgza" readonly class="form-control" id="mo_textm" placeholder="سعر الاجمالي">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="total_price" class="col-sm-2 control-label">مصاريف الشحن</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="shipping_costs" id="shipping_costs" class="form-control" placeholder="مصاريف الشحن">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="total_price" class="col-sm-2 control-label"> الخصم</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="discount" class="form-control" id="discount" placeholder=" الخصم">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="total_price" class="col-sm-2 control-label">صافي الفاتورة</label>
                                            <div class="col-sm-3">
                                                <input type="number" name="afterdiscount" readonly class="form-control" id="mo_textm2" placeholder="صافي الفاتورة">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <!-- /.tab-pane -->

                        <div class="tab-pane " id="settings2">

                            <div class="box-body hereallzsasd">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>اختيار اسم الجهاز</th>
                                        <th>كمية</th>
                                        <th>سعر الافرادي</th>


                                        <th>الاجمالي</th>

                                        <th>
                                            #
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="devices">

                                    </tbody>
                                </table>
                                <br>
                                <div class="form-group ">
                                    <button class="btn btn-default" style="background-color: yellowgreen;color: #fff;" id="add_devices" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة جهاز </button>
                                </div>
                                <br>

                                <div class="form-group ">
                                    <label for="value" class="col-sm-1 control-label">سعر الاجهزة</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="total_final_mogma3"  readonly class="form-control total_final2" id="total_final" placeholder="سعر الجهاز كامل">
                                    </div>
                                </div>


                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        {{--<div class="form-group">--}}
        {{--<label for="value" class="col-sm-2 control-label">اجمالي الفاتورة </label>--}}
        {{--<div class="col-sm-8">--}}
        {{--<input type="text" name="total_final_bill"  readonly class="form-control" id="total_priceforpc" placeholder="اجمالي الفاتورة">--}}
        {{--</div>--}}
        {{--</div>--}}



        <!--End -->



        </div><!-- /.box-body -->
        <div class="box-footer ">
            <div class="col-sm-1">
                <button type="submit" name="savedraft" value="1" class="btn btn-primary pull-right">{{trans('admin.save')}}</button>
            </div>

            <div class="col-sm-2">
                <button class="btn default" type="reset">{{trans('clients.reset')}}</button>
            </div>
            <div class="col-sm-2">
                <button type="submit" name="savedraft" value="0" class="btn btn-warning pull-right">{{trans('admin.savedraft')}}</button>
            </div>

            <div class="col-sm-1">
                <a href="{{aurl('invoices')}}"><span class="btn btn-danger" >{{trans('إلغاء')}}</span></a>
            </div>


        </div><!-- /.box-footer -->
    </form>
</div>