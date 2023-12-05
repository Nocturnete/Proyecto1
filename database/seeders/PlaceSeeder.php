<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('places')->insert(
            [[
                'title' => "Barcelona",
                'latitude' => "41.38879",
                'longitude' => "2.15899",
                'descripcion' => "Barcelona, ciudad española en Cataluña, destaca por la arquitectura de Gaudí, playas mediterráneas y vida cultural vibrante.",
                'file_id' => 1,
                'author_id' => 1,
                'visibility_id' => 1,
                'created_at' => "2023-12-05 14:29:56",
                'updated_at' => "2023-12-05 14:29:56",
            ],
            [
                'title' => "Valencia",
                'latitude' => "39.4699",
                'longitude' => "-0.3763",
                'descripcion' => "Valencia, ciudad española en la costa este, destaca por la Ciudad de las Artes y las Ciencias, playas hermosas y su vibrante cultura mediterránea.",
                'file_id' => 2,
                'author_id' => 1,
                'visibility_id' => 1,
                'created_at' => "2023-12-05 14:29:56",
                'updated_at' => "2023-12-05 14:29:56",
            ]], 
        );
    }
}
