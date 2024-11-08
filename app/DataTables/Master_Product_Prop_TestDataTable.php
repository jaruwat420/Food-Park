<?php

namespace App\DataTables;

use App\Models\Master_Product_Prop_Test;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class Master_Product_Prop_TestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query){
                $delete = "<a href='' class='btn btn-danger delete-item ml-2'><i class='fas fa-trash'></i></a>";
                return $delete;
            })
            ->editColumn('Create_Date', function ($query) {
                return Carbon::parse($query->Create_Date)
                    ->setTimezone('Asia/Bangkok')
                    ->format('d/m/Y H:i:s');
            })
            ->rawColumns(['action', 'Create_Date'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Master_Product_Prop_Test $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('master_product_prop_test-table')
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

            Column::make('CustID'),
            Column::make('StatusID'),
            Column::make('StatusDes'),
            Column::make('Remark'),
            Column::make('ProductID'),
            Column::make('ProductName'),
            Column::make('Target'),
            Column::make('CurrentMonth'),
            Column::make('Add'),
            Column::make('Create_Date'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Master_Product_Prop_Test_' . date('YmdHis');
    }
}
