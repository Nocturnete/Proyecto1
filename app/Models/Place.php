<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'descripcion',
        'file_id',
        'author_id',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function favorited()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

}
    