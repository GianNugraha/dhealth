<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obat = [
            [ 'obatalkes_kode' => 'ALK00000614', 'obatalkes_nama' => 'KASSA NON-XRAY 10 CM X 10 CM', 'stok' => 50, 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
            [ 'obatalkes_kode' => 'ALK00000776', 'obatalkes_nama' => 'POLYSORB 1 CL905', 'stok' => 50, 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
            [ 'obatalkes_kode' => 'ALK00000741', 'obatalkes_nama' => 'VICRYL PLUS 2-0 VCP317 TAPER', 'stok' => 50, 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
            [ 'obatalkes_kode' => 'ALK00000095', 'obatalkes_nama' => 'CADD EXTENSION SET 76 CM/ 30 IN (21-7045-24)', 'stok' => 50, 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
            [ 'obatalkes_kode' => 'OBT00000392', 'obatalkes_nama' => 'MINIRIN DROP/SPRAY', 'stok' => 50, 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
        ];
            DB::table('obatalkes_m')->insert($obat);
    }
}
