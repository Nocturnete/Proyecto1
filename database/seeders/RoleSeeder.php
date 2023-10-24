<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // INSERTA REGISTROS DE ROLES EN LA TABLA ROLES DE LA BASE DE DATOS
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'author'],
            ['name' => 'editor'],
            ['name' => 'admin'],
        ]);
    }
}
