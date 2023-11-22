<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlacePolicy
{
    /**
     * 
     * Determina si el usuario puede ver la lista de lugares.
     *
     */
    public function viewAny(User $user): bool
    {
        // El usuario con el rol [1, 2, 3] puede ver la lista.
        return in_array($user->role_id, [1, 2, 3]);
    }

    /**
     * 
     * Determina si el usuario puede ver un lugar específico.
     *
     */
    public function view(User $user, Place $place): bool
    {
        // El usuario con el rol [1, 2, 3] puede ver un lugar.
        return in_array($user->role_id, [1, 2, 3]);
    }
    
    /**
     * 
     * Determina si el usuario puede crear lugares.
     * 
     */
    public function create(User $user): bool
    {
        // El usuario puede crear lugares si su rol es 1.
        return $user->role_id === 1;
    }

    /**
     * 
     * Determina si el usuario puede actualizar un lugar específico.
     *
     */
    public function update(User $user, Place $place): bool
    {
        // El usuario puede actualizar un lugar si su rol es 1
        // y si el usuario es el autor del lugar.
        if ($user->role_id === 1 && $user->id === $place->author_id) {
            return $user->role_id;
        } elseif ($user->role_id === 2) {
            return true;
        }
        return false;
    }

    /**
     * 
     * Determina si el usuario puede eliminar un lugar específico.
     *
     */
    public function delete(User $user, Place $place): bool
    {
        // El usuario puede eliminar un lugar si su rol es 1
        // y si el usuario es el autor del lugar.
        return $user->role_id === 1 && $user->id === $place->author_id;
    }

    /**
     * 
     * Determina si el usuario puede restaurar un lugar.
     *
     */
    public function restore(User $user, Place $place): bool
    {
        return $user->role_id === 3;
    }

    /**
     * 
     * Determina si el usuario puede forzar la eliminación de un lugar.
     *
     */
    public function forceDelete(User $user, Place $place): bool
    {
        return $user->role_id === 3;
    }
}