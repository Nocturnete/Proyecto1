<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * 
     * Constantes que representan roles.
     * 
     */
    const AUTHOR = 1;
    const EDITOR = 2;
    const ADMIN  = 3;

    /**
     * 
     * Los atributos que son asignables masivamente.
     *
     */
    protected $fillable = [
        'id',
        'name',
    ];
}
