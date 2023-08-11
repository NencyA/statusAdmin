<?php

namespace App\DataTables;

use App\Models\ReportedVideo;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class ReportedVideoDataTable extends DataTable
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
        ->editColumn('profilePicLink', function ($row) {
            $image = "<img src=".$row->profilePicLink." style='border-radius: 50%;cursor: pointer;
            ' class='videobtn' width='50' height='50' id=".$row->video_id." class='img-rounded' />";
            return $image;
          })
        ->addIndexColumn()
        ->setRowId('id')
        ->rawColumns(['profilePicLink']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ReportedVideo $model): QueryBuilder
    {
        return $model->newQuery()->with([
            'video',
            'video.user'
        ]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('reportedvideo-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('No')->title(__('No'))->data('DT_RowIndex')->name('DT_RowIndex')->searchable(false)->orderable(false),
            Column::make('video.user.name')->title(__('Name')),
            Column::make('reporter_email')->title(__('Reporter Email')),
            Column::make('report_reason'),
            Column::make('profilePicLink'),
            Column::make('gender'),
            Column::make('mobileNumber'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ReportedVideo_' . date('YmdHis');
    }
}
