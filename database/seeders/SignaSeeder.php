<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SignaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $signa = [
            [ 'signa_kode' => '000.5 T', 'signa_nama' => '1X SEHARI 0.5 TABLET (MALAM)', 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
            [ 'signa_kode' => '000.5 T AC', 'signa_nama' => '1X SEHARI 0.5 TABLET, SEBELUM MAKAN (MALAM)', 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
            [ 'signa_kode' => '5DD2C', 'signa_nama' => '5X SEHARI 2 KAPSUL', 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
            [ 'signa_kode' => 'BSK', 'signa_nama' => 'BILA SAKIT KEPALA', 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
            [ 'signa_kode' => '1DD1S', 'signa_nama' => 'SEMPROT HIDUNG', 'additional_data' => '', 'created_date'=>'2022-06-20 04:10:58', 'created_by'=>'', 'modified_count'=>0, 'last_modified_by'=>'', 'is_deleted'=>0, 'is_active'=>1, 'deleted_by'=>''],
        ];
            DB::table('signa_m')->insert($signa);
    }
}
