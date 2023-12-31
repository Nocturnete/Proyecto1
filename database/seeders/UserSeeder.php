<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    // INSERTAR UN USUARIO ADMINISTRADOR EN LA BASE DE DATOS
    public function run()
    {
        $admin = new User([
            'name'      => config('admin.name'),
            'email'     => config('admin.email'),
            'password'  => Hash::make(config('admin.password')),
            'role_id'   => 1,
        ]);
        $admin->save(); 
    }
}

