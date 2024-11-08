<?php
namespace App\Traits;

use App\Models\Master_Product_Prop_Test;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class ImportExcel implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public $successCount = 0;
    public $failureCount = 0;
    public $importDate;
    private $batchSize = 1000;
    private $batch = [];

    // แปลงเวลาและวันที่
    public function __construct()
    {
        $this->importDate = Carbon::now();
    }

    public function getImportDate()
    {
        return $this->importDate;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            \Log::info("Processing row " . ($index + 1) . ": " . json_encode($row));
            try {
                $this->batch[] = [
                    'CustID' => $row['custid'] ?? null,
                    'StatusID' => $row['statusid'] ?? '',
                    'StatusDes' => $row['statusdes'] ?? null,
                    'Remark' => $row['remark'] ?? null,
                    'ProductID' => $row['productid'] ?? null,
                    'ProductName' => $row['productname'] ?? null,
                    'Target' => $row['target'] ?? null,
                    'Add' => $row['add'] ?? null,
                    'CurrentMonth' => $row['currentmonth'] ?? null,
                    'Recommend' => $row['recommend'] ?? null,
                    'Create_Date' => $this->importDate
                ];
                $this->successCount++;
                if (count($this->batch) >= $this->batchSize) {
                    $this->insertBatch();
                }
            } catch (\Exception $e) {
                $this->failureCount++;
                \Log::error("Import error at row " . ($index + 1) . ": " . $e->getMessage());
            }
        }
        if (!empty($this->batch)) {
            $this->insertBatch();
        }
    }

    private function insertBatch() {
        Master_Product_Prop_Test::insert($this->batch);
        $this->batch = [];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
