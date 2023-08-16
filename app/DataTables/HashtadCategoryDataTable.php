<?php

namespace App\DataTables;

use App\Models\HastagCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HashtadCategoryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('edit', function ($category) {
                return '<a href="javascript:void(0)" data-toggle="modal" data-target="categoryedit" class="edit btn btn-success btn-sm categoryEdit" id=' . $category->id . '>Edit</a>';
            })
            ->addColumn('delete', function ($category) {
                return '<form action="' . route('delete_category', $category->id) . '" method="post" onsubmit="return confirm(\'Are you sure you want to delete this category?\')">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>';
            })
            ->setRowId('id')
            ->rawColumns(['edit', 'delete']);
    }

    public function query(HastagCategory $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'desc');
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
            Column::make('name')->title(__('name')),
            Column::make('hashtag')->title(__('hashtag')),
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
