<?php

namespace App\DataTables;

use App\Models\UploadVideo;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserVideoDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('video_file_name', function ($video) {
                return '<video width="90" height="90" controls>
                    <source src="' . asset('storage/app/' . $video->video_file_name) . '" type="video/mp4">
                    Your browser does not support the video tag.
                </video>';
            })

            ->addColumn('edit', function ($video) {
                return '<a href="javascript:void(0)" data-toggle="modal" data-target="videodataedit" class="edit btn btn-success btn-sm videoEdit" id=' . $video->id . '>Edit</a>';
            })
            ->addColumn('delete', function ($video) {
                return '<form action="' . route('delete_video', $video->id) . '" method="post" onsubmit="return confirm(\'Are you sure you want to delete this video?\')">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>';
            })
            ->setRowId('id')
            ->rawColumns(['video_file_name', 'edit', 'delete']);
    }

    public function query(UploadVideo $model): QueryBuilder
    {
        return $model->newQuery()->where('name', 'admin')->orderBy('id', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('uservideo-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('user_mailid')->title(__('userEmail')),
            Column::make('hashtag')->title(__('hashtag')),
            Column::make('description')->title(__('description')),
            Column::make('video_file_name')->title(__('fileName')),
            Column::computed('edit')
                ->title(__('Edit'))
                ->orderable(false)
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('delete')
                ->title(__('Delete'))
                ->orderable(false)
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'UserVideo_' . date('YmdHis');
    }
}
