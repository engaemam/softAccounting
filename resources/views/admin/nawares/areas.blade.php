
@if (count($areas) > 0)
    <option value="">برجاء اختر المنطقة</option>
@foreach($areas as $ids =>$area)
    <option value="{{$area->id}}" > {{ $area->title}}</option>
@endforeach
    @else
    <option value="">لا يوجد</option>
@endif