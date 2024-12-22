<?php

namespace App\DataTables;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TicketsDataTable extends DataTable
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
                $view = "<button type='button' class='btn btn-primary view-ticket' data-id='{$query->id}'><i class='fas fa-eye'></i></button>";
                $edit = "<button type='button' class='btn btn-warning edit-btn ml-2' data-id='{$query->id}' data-toggle='modal' data-target='#editTicketModal'><i class='fas fa-edit'></i></button>";
                //$delete = "<a href='".route('admin.tickets.destroy', $query->id)."' class='btn btn-danger delete-item ml-2'><i class='fas fa-trash'></i></a>";

                return $view.$edit;
            })->addColumn('priority', function ($query) {
                if ($query->priority == 'low') {
                    return '<span class="badge badge-warning">ต่ำ</span>';
                } else if($query->priority == 'medium') {
                    return '<span class="badge badge-success">ปานกลาง</span>';
                } else {
                    return '<span class="badge badge-danger">สูง</span>';
                }
            })
            ->editColumn('description', function ($query){
                $fullText = strip_tags($query->description);
                $shortText = Str::limit($fullText, 50);

                return '<div class="description-cell" data-toggle="tooltip" data-placement="top" title="' . e($fullText) . '">
                <span class="truncate-text">' . e($shortText) . '</span>
                </div>';
            })
            ->editColumn('status_id', function ($query){
                if ($query->status_id == '1') {
                    return '<span class="badge badge-primary status_new">ใหม่</span>';
                } else if ($query->status_id == '2'){
                    return '<span class="badge badge-warning">กำลังดำเนินการ</span>';
                } else if ($query->status_id == '3'){
                    return '<span class="badge badge-success">เสร็จสิ้น</span>';
                } else {
                    return '<span class="badge badge-danger">ยกเลิก</span>';
                }
            })
            ->editColumn('updated_at', function ($query) {
                return Carbon::parse($query->created_at)
                    ->setTimezone('Asia/Bangkok')
                    ->format('d/m/Y H:i:s');
            })
            ->rawColumns(['action', 'priority', 'status_id', 'description', 'updated_at'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Ticket $model): QueryBuilder
    {
        return $model->newQuery()
            ->select([
                'tickets.*',
                'tickets.user_name',  // ใช้ user_name จากตาราง tickets โดยตรง
                'assigned_users.name as assigned_name',
                'locations.name as location_name',
                'departments.name as department_name',
                'categories.name as category_name',
                'subjects.name as subject_name'
            ])
            ->leftJoin('users as assigned_users', 'tickets.assigned_to', '=', 'assigned_users.id')
            ->leftJoin('locations', 'tickets.location_id', '=', 'locations.id')
            ->leftJoin('categories', 'tickets.category_id', '=', 'categories.id')
            ->leftJoin('departments', 'tickets.department_id', '=', 'departments.id')
            ->leftJoin('subjects', 'tickets.subject_id', '=', 'subjects.id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('tickets-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->scrollY('500px')
            ->autoWidth(false)
            ->responsive(true)
            ->orderBy([1, 'dsc'])
            ->selectStyleSingle()
            ->parameters([
                'dom'          => 'Bfrtip',
                'buttons' => ['excel', 'csv', 'pdf', 'print', 'reset', 'reload'],
                'pageLength'   => 10,
                'lengthMenu'   => [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                'scrollCollapse' => true,
                'fixedHeader' => true,
                'responsive' => true,
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(50),
            Column::make('ticket_id')
                ->title('หมายเลข Ticket')
                ->width(200),
            Column::make('category_name', 'categories.name')
                ->title('ประเภทปัญหา')
                ->width(200),
            Column::make('title')
                ->title('เรื่อง')
                ->width(200),
            Column::make('description')
                ->title('รายละเอียด')
                ->width(150)
                ->className('description-cell'),
            Column::make('user_name')
                ->title('ชื่อผู้แจ้ง')
                ->width(200)
                ->className('name_problem'),
            Column::make('status_id')
                ->title('สถานะ')
                ->width(100),
            Column::make('priority')
                ->title('ลำดับความสำคัญ')
                ->width(250),
            Column::make('location_name', 'locations.name')
                ->title('สถานที่')
                ->width(120),
            Column::make('department_name', 'departments.name')
                ->title('ฝ่าย')
                ->width(120),
            Column::make('assigned_name', 'assigned_users.name')
                ->title('มอบหมายให้')
                ->width(150),
            Column::make('updated_at')
                ->title('วันที่/เวลา ที่แจ้ง')
                ->width(200),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->title('การจัดการ')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Tickets_' . date('YmdHis');
    }
}
