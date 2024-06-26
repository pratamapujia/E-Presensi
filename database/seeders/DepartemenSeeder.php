<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kd_departemen' => 'IT', 'nama_departemen' => 'Information Technology'],
            ['kd_departemen' => 'HRD', 'nama_departemen' => 'Human Resource Development'],
            ['kd_departemen' => 'MKT', 'nama_departemen' => 'Marketing'],
            ['kd_departemen' => 'ADM', 'nama_departemen' => 'Administrator'],
            ['kd_departemen' => 'STF', 'nama_departemen' => 'Staff'],
        ];
        DB::table('departemen')->insert($data);
    }
}
