<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * 
     * Los atributos que son asignables masivamente.
     *
     */
    protected $fillable = [
        'filepath', 
        'filesize'
    ];

    /**
     * 
     * Relación: Un archivo pertenece a un post.
     *
     */
    public function post()
    {
        return $this->hasOne(Post::class);
    }

    /**
     * 
     * Relación: Un archivo pertenece a un lugar.
     *
     */
    public function place()
    {
        return $this->hasOne(Place::class);
    }
}
