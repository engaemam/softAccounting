<?php
namespace App\DataTables;


use App\Model\Projects;
use App\Model\Clients;
use App\User;
use Yajra\DataTables\Services\DataTable;
class ProjectsDatatable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query) {
        return datatables($query)
            ->addColumn('checkbox', 'admin.projects.btn.checkbox')
            ->addColumn('edit', 'admin.projects.btn.edit')
            ->addColumn('delete', 'admin.projects.btn.delete')

            ->addColumn('show', 'admin.projects.btn.show')

            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
                'show',

            ]);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\ $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query() {
        return Projects::with('clients')->get();
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
                'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, trans('projects.all_record')]],
                'buttons'    => [
                    [
                        'text' => '<i class="fa fa-plus"></i> '.trans('projects.create'), 'className' => 'btn btn-info', "action" => "function(){
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
            ],[
                'name'  => 'name',
                'data'  => 'name',
                'title' => trans('projects.name'),
            ],[
                'name'  => 'type',
                'data'  => 'type',
                'title' => trans('projects.type'),
            ],[
                'name'  => 'clients.name_client',
                'data'  => 'clients.name_client',
                'title' => trans('projects.id_client'),
            ],[
                'name'  => 'project_number',
                'data'  => 'project_number',
                'title' => trans('projects.project_number'),
            ],[
                'name'  => 'project_start_date',
                'data'  => 'project_start_date',
                'title' => trans('projects.project_start_date'),
            ],[
                'name'  => 'project_creation_date',
                'data'  => 'project_creation_date',
                'title' => trans('projects.project_creation_date'),
            ],[
                'name'  => 'project_value',
                'data'  => 'project_value',
                'title' => trans('projects.project_value'),
            ],[
                'name'  => 'project_after_tax',
                'data'  => 'project_after_tax',
                'title' => trans('projects.project_after_tax'),
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
            ], [
                'name'       => 'show',
                'data'       => 'show',
                'title'      => 'عرض المشروع',
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
        return 'Projects_'.date('YmdHis');
    }
}