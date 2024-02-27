<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Post extends Model
{
    use HasSEO;
    use HasFactory;

    /**
     * 
     * Los atributos que son asignables masivamente.
     *
     */
    protected $fillable = ['author_id', 'file_id', 'title', 'description', 'visibility_id'];

    /**
     * 
     * Relación: Un post pertenece a un archivo.
     *
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /**
     * 
     * Relación: Un post pertenece a un usuario (autor).
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * 
     * Relación: Un post pertenece a un usuario (autor).
     *
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 
     * Relación: Muchos usuarios pueden dar like a este post.
     *
     */
    public function liked()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function visibility()
    {
        return $this->belongsTo(Visibility::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
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
