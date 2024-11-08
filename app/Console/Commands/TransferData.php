<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TransferData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer data from one database to another';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sourceSchema = 'public';
        $destinationSchema = 'public';

        // ดึงข้อมูลจากฐานข้อมูลต้นทาง
        $sourceData = DB::connection('pgpos_chaixi')
        ->select("SELECT * FROM $sourceSchema.pga_job");
        // บันทึกข้อมูลลงในฐานข้อมูลปลายทาง
        DB::connection('destination_db')->transaction(function () use ($sourceData, $destinationSchema) {
            foreach ($sourceData as $data) {
                DB::connection('destination_db')
                    ->table("$destinationSchema.destination_table")
                    ->insert((array)$data);
            }
        });

        $this->info('Data transfer completed successfully.');
    }
}
