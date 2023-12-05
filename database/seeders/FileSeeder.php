<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('files')->insert(
            [[
                'filepath' => "uploads/Barcelona.jpeg", 
                'filesize' => 834146,
                'created_at' => "2023-12-05 14:29:56",
                'updated_at' => "2023-12-05 14:29:56",
            ],
            [
                'filepath' => "uploads/Valencia.jpeg", 
                'filesize' => 179883,
                'created_at' => "2023-12-05 14:59:25",
                'updated_at' => "2023-12-05 14:59:25",
            ]]
        );
    }
}
