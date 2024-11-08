<?php

namespace App\DataTables;

use App\Models\Visits;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class VisitsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                if ($query->Action === 'View') {
                    return '<span class="badge badge-warning">ดู</span>';
                } else if ($query->Action === 'Search') {
                    return '<span class="badge badge-primary">ค้นหา</span>';
                } else if ($query->Action === 'History') {
                    return '<span class="badge badge-danger">ดูประวัติ</span>';
                }
            })
            ->editColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)
                    ->setTimezone('Asia/Bangkok')
                    ->format('d/m/Y H:i:s');
            })
            ->editColumn('updated_at', function ($query) {
                return Carbon::parse($query->updated_at)
                    ->setTimezone('Asia/Bangkok')
                    ->format('d/m/Y H:i:s');
            })
            ->rawColumns(['action', 'created_at', 'updated_at'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Visits $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('Visits-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('ID'),
            Column::make('Ip'),
            Column::make('User_Agent')
                ->addClass('text-truncate'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Visits_' . date('YmdHis');
    }
}
