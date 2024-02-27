<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Place extends Model
{
    use HasSEO;
    use HasFactory;
    
    /**
     * 
     * Los atributos que son asignables masivamente.
     *
     */
    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'descripcion',
        'file_id',
        'author_id',
        'visibility_id',
    ];

    /**
     * 
     * Relación: Un lugar pertenece a un archivo.
     *
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /**
     * 
     * Relación: Un lugar pertenece a un usuario (autor).
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * 
     * Relación: Muchos usuarios pueden tener este lugar como favorito.
     *
     */
    public function favorited()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    
    public function visibility()
    {
        return $this->belongsTo(Visibility::class);
    }

    protected function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: $this->excerpt,
            author: $this->author->fullName,
        );
    }
}
