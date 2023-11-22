<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use App\Models\Role;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 
     * Los atributos que son asignables masivamente.
     *
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * 
     * Los atributos que deben estar ocultos para la serialización.
     *
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 
     * Los atributos que deben ser transformados a tipos nativos.
     *
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * 
     * Relación: Un usuario puede tener muchos posts.
     *
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    /**
     * 
     * Relación: Un usuario puede tener muchos lugares.
     *
     */
    public function places()
    {
        return $this->hasMany(Place::class, 'author_id');
    }

    /**
     * 
     * Relación: Un usuario puede dar "like" a muchos posts.
     *
     */
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    /**
     * 
     * Relación: Un usuario puede tener muchos lugares como favoritos.
     *
     */
    public function favorites()
    {
        return $this->belongsToMany(Place::class, 'favorites');
    }

    /**
     * 
     * Verifica si el usuario tiene acceso a Filament.
     *
     */
    public function canAccessFilament(): bool
    {
        // Devuelve verdadero si el rol del usuario es 2 o 3.
        return in_array($this->role_id, ['2', '3']);    
    }

    /**
     * 
     * Relación: Un usuario pertenece a un rol.
     *
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
