<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;

class FilePolicy
{
    /**
     * 
     * Determina si el usuario puede ver la lista de archivos.
     *
     */
    public function viewAny(User $user): bool
    {
        // Permite ver la lista de archivos solo si el rol es 3.
        return $user->role_id === 3;
    }

    /**
     * 
     * Determina si el usuario puede ver un archivo específico.
     *
     */
    public function view(User $user, File $file): bool
    {
        // Permite ver un archivo específico solo si el rol es 3.
        return $user->role_id === 3;
    }

    /**
     * 
     * Determina si el usuario puede crear archivos.
     *
     */
    public function create(User $user): bool
    {
        // Permite crear archivos solo si el rol es 3.
        return $user->role_id === 3;
    }

    /**
     * 
     * Determina si el usuario puede actualizar un archivo específico.
     *
     */
    public function update(User $user, File $file): bool
    {
        // Permite actualizar un archivo específico solo si el rol es 3.
        return $user->role_id === 3;
    }

    /**
     * 
     * Determina si el usuario puede eliminar un archivo específico.
     *
     */
    public function delete(User $user, File $file): bool
    {
        // Permite eliminar un archivo específico solo si el rol es 3.
        return $user->role_id === 3;
    }

    /**
     * 
     * Determina si el usuario puede restaurar un archivo.
     *
     */
    public function restore(User $user, File $file): bool
    {
        // Permite restaurar un archivo solo si el rol es 3.
        return $user->role_id === 3;
    }

    /**
     * 
     * Determina si el usuario puede forzar la eliminación de un archivo.
     *
     */
    public function forceDelete(User $user, File $file): bool
    {
        // Permite forzar la eliminación de un archivo solo si el rol es 3.
        return $user->role_id === 3;
    }
}