<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class UserDataTable extends DataTable
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
            $edit = "<a href='".route('admin.user.edit', $query->id)."' class='btn btn-warning'><i class='fas fa-edit'></i></a>";
            $delete = "<a href='".route('admin.user.destroy', $query->id)."' class='btn btn-danger delete-item ml-2'><i class='fas fa-trash'></i></a>";

            return $edit.$delete;
        })->addColumn('image', function ($query) {
            return '<img width="100px" height="100px" src="'.asset($query->avatar).'">';
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
        ->rawColumns(['action', 'created_at', 'updated_at', 'image'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
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
            Column::make('id')
                ->title('ไอดี'),
            Column::make('image')
                ->title('รูปภาพ'),
            Column::make('name')
                ->title('ชื่อ'),
            Column::make('role')
                ->title('ระดับผู้ใช้'),
            Column::make('created_at')
                ->title('วันที่สร้าง'),
            Column::make('updated_at')
                    ->title('แก้ไขล่าสุด'),
            Column::computed('action')
                ->title('จัดการ')
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
        return 'User_' . date('YmdHis');
    }
}
