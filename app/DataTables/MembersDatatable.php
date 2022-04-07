<?php
namespace App\DataTables;
use App\Model\Member;
use App\User;
use Yajra\DataTables\Services\DataTable;
class MembersDatatable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query) {
        return datatables($query)
            ->addColumn('checkbox', 'admin.members.btn.checkbox')
            ->addColumn('edit', 'admin.members.btn.edit')
            ->addColumn('delete', 'admin.members.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',

            ]);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\ $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query() {
        return Member::query();
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html() {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'        => 'Blfrtip',
                'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, trans('admin.all_record')]],
                'buttons'    => [
                    [
                        'text' => '<i class="fa fa-plus"></i> '.trans('member.add'), 'className' => 'btn btn-info', "action" => "function(){
							window.location.href = '".\URL::current()."/create';
						}"],
                    ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"></i> '.trans('admin.ex_csv')],
                    ['extend' => 'excel', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-file"></i> '.trans('admin.ex_excel')],
                    ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-refresh"></i>'],
                    [
                        'text' => '<i class="fa fa-trash"></i>', 'className' => 'btn btn-danger delBtn'],
                ],
                'initComplete' => " function () {
		            this.api().columns([2,3]).every(function () {
		                var column = this;
		                var input = document.createElement(\"input\");
		                $(input).appendTo($(column.footer()).empty())
		                .on('keyup', function () {
		                    column.search($(this).val(), false, false, true).draw();
		                });
		            });
		        }",
                'language' => datatable_lang(),
            ]);
    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns() {
        return [
            [
                'name'       => 'checkbox',
                'data'       => 'checkbox',
                'title'      => '<input type="checkbox" class="check_all" onclick="check_all()" />',
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ], [
                'name'  => 'id',
                'data'  => 'id',
                'title' => '#',
            ],  [
                'name'  => 'name_ar',
                'data'  => 'name_ar',
                'title' => trans('member.name_ar'),
            ],[
                'name'  => 'name_en',
                'data'  => 'name_en',
                'title' => trans('member.name_en'),
            ], [
                'name'  => 'image',
                'data'  => 'image',
                'render' => '"<img src=\""+data+"\" height=\"50\"/>"',
                'title' => trans('member.image'),
            ],[
                'name'       => 'edit',
                'data'       => 'edit',
                'title'      => trans('admin.edit'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ], [
                'name'       => 'delete',
                'data'       => 'delete',
                'title'      => trans('admin.delete'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() {
        return 'Members_'.date('YmdHis');
    }
}