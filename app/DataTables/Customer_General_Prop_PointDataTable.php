<?php

namespace App\DataTables;

use App\Models\Customer_General_Prop_Point;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class Customer_General_Prop_PointDataTable extends DataTable
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
            $edit = "<a href='".route('import.edit', $query->ID)."' class='btn btn-warning'><i class='fas fa-edit'></i></a>";
            $delete = "<a href='".route('import.destroy', $query->ID)."' class='btn btn-danger delete-item ml-2'><i class='fas fa-trash'></i></a>";
            return $edit.$delete;
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
    public function query(Customer_General_Prop_Point $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('customer_general_prop_point-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('ID'),
            Column::make('Cart_Number'),
            Column::make('Product_Name'),
            Column::make('Previous_Amount'),
            Column::make('Current_Amount'),
            Column::make('Purchased_Amount'),
            Column::make('Rights_Amount'),
            Column::make('Date'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(150)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Customer_General_Prop_Point_' . date('YmdHis');
    }
}
