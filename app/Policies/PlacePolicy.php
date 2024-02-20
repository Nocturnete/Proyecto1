<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlacePolicy
{
    /**
     * Determina si el usuario puede ver la lista de lugares.
     */
    public function viewAny(User $user): bool
    {
        if (in_array($user->role_id, [1, 2, 3])) {
            return $user->role_id;
        }
        return false;    
    }
    
    /**
     * Determina si el usuario puede ver un lugar específico.
     */
    public function view(User $user, Place $place): bool
    {
        if (in_array($user->role_id, [1, 2, 3])) {
            return $user->role_id;
        }
        return false;
    }
    
    /**
     * Determina si el usuario puede crear lugares.
     */
    public function create(User $user): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determina si el usuario puede actualizar un lugar específico.
     */
    public function update(User $user, Place $place): bool
    {
        return $user->role_id === 1 && $user->id === $place->author_id;
    }

    /**
     * Determina si el usuario puede eliminar un lugar específico.
     */
    public function delete(User $user, Place $place): bool
    {
        if ($user->role_id === 1 && $user->id === $place->author_id) {
            return $user->role_id;
        } elseif ($user->role_id === 2) {
            return true;
        }
        return false;
    }

    /**
     * Determina si el usuario puede restaurar un lugar.
     */
    public function restore(User $user, Place $place): bool
    {
        // return $user->role_id === 3;
    }

    /**
     * Determina si el usuario puede forzar la eliminación de un lugar.
     */
    public function forceDelete(User $user, Place $place): bool
    {
        // return $user->role_id === 3;
    }
}