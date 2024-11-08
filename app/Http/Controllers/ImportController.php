<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ImportExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\Master_Product_PropDataTable;
use App\DataTables\Master_Product_Prop_TestDataTable;


class ImportController extends Controller
{
    /** index */
    public function index (Master_Product_Prop_TestDataTable $dataTable)
    {
        return $dataTable->render ('admin.import.index');
    }

    /** Edit */
    public function edit ($id) {
        dd($id);
    }

    /** Delete */
    public function destroy ($id) {
        dd($id);
    }

    /** Import File Excel */
    public function import(Request $request)
    {
        try {
            $file = $request->file('excel_file');
            $import = new ImportExcel();
            Excel::import($import, $file);

            session()->flash('import_result', [
                'success' => true,
                'message' => 'การนำเข้าข้อมูลสำเร็จ',
                'total_import_success' => $import->successCount,
                'total_import_fail' => $import->failureCount,
                'imported_at' => now()->format('Y-m-d H:i:s')
            ]);

            return redirect()->route('import.index');
        } catch (\Exception $e) {
            // ...
        }
    }
}
