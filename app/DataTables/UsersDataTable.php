<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function ($visit) {
                return Carbon::parse($visit->created_at)->format('Y-m-d');
              })
            ->editColumn('action', function ($visit) {
                return '<a href="javascript:void(0)" data-toggle="modal" data-target="userdataedit" class="edit btn btn-success btn-sm userEdit" id='.$visit->userId.'>Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm deleteRecord" id='.$visit->userId.'> Delete</a>';
              })
            ->editColumn('profilePicLink', function ($row) {
                $image = '<img src="'.$row->profilePicLink.'" width="50" height="50" class="img-rounded" />';
                return $image;
              })
            ->addColumn('status', function($row){
                    $status = '<div class="form-check form-switch form-switch-xl"><input data-id="' . $row->userId . '" class="toggle-class form-check-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive"' . ($row->status ? ' checked' : '') . '></div>';
                return $status;
                })
            ->setRowId('id')
            ->addIndexColumn()
            ->rawColumns(['action','profilePicLink','status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->language([
                        // "paginate" => [
                        //   "next" => '<i class="ti ti-chevron-right"></i>',
                        //   "previous" => '<i class="ti ti-chevron-left"></i>'
                        // ]
                      ])
                      ->parameters([
                        "dom" =>  "
                                                <'row'<'col-sm-12 '><'col-sm-9 'B><'col-sm-3'f>>
                                                <'row'<'col-sm-12'tr>>
                                                <'row mt-3 '<'col-sm-5'i><'col-sm-7'p>>
                                                ",

                        'buttons'   => [
                        //   ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner',],
                          ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner',],
                        ],

                        "scrollX" => false
                      ])
                      ->language([
                        'buttons' => [
                          'export' => __('Export'),
                          'excel' => __('Excel'),
                          'csv' => __('CSV'),
                          'pageLength' => __('Show %d rows'),
                        ]
                        ])
                    ->selectStyleSingle();
                    // ->buttons([
                    //     Button::make('excel'),
                    //     Button::make('csv'),
                    //     Button::make('pdf'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('No')->title(__('No'))->data('DT_RowIndex')->name('DT_RowIndex')->searchable(false)->orderable(false),
            Column::make('name'),
            Column::make('profilePicLink')->title(__('Profile')),
            Column::make('emailId'),
            Column::make('gender'),
            Column::make('followers'),
            Column::make('flowing'),
            Column::make('postbyuser')->title(__('Post')),
            Column::make('status')->title(__('status')),
            Column::make('language'),
            Column::make('created_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(100)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
