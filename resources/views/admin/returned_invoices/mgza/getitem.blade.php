
        @foreach($ItemsId as $item)
                @if($item->newprice == 0)
                <input type="text" name="price_b[]"  value="{{$item->price}}" class="form-control" id="No2" placeholder="سعر الماده" required>
                @else
                <input type="text" name="price_b[]"  value="{{$item->newprice}}" class="form-control" id="No2" placeholder="سعر الماده" required>
                @endif
        @endforeach


