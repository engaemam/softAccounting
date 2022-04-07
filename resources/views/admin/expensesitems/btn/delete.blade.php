
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_expensesitems{{ $id }}"><i class="fa fa-trash"></i></button>

<!-- Modal -->
<div id="del_expensesitems{{ $id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
            </div>
            <form method="POST" action="{{url('admin/expensesitems/')}}/{{$id}}" accept-charset="UTF-8">
                {!! csrf_field() !!}
                <input name="_method" type="hidden" value="DELETE">

                <div class="modal-body">
                    <h4>{{ trans('admin.delete_this',['name'=>$id]) }}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
                    <input class="btn btn-danger" type="submit" value="{{trans('admin.yes')}}">
                </div>
            </form>
        </div>

    </div>
</div>
</td>