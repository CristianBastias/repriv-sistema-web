<?php

namespace App\Policies;

use App\Models\Documento;
use App\Models\User;

class DocumentoPolicy
{
    /**
     * Todos los usuarios autenticados (Admin o Empresa) pueden ver la lista
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Ver un documento específico: Solo dueño o Admin
     */
    public function view(User $user, Documento $documento): bool
    {
        return ($user->empresa_id === $documento->empresa_id) || $user->is_admin;
    }

    /**
     * Crear documentos: Solo las empresas pueden crear los suyos
     */
    public function create(User $user): bool
    {
        return $user->empresa_id !== null;
    }

    /**
     * Actualizar documento: Solo dueño o Admin
     */
    public function update(User $user, Documento $documento): bool
    {
        return ($user->empresa_id === $documento->empresa_id) || $user->is_admin;
    }

    /**
     * Eliminar documento: Solo dueño o Admin
     */
    public function delete(User $user, Documento $documento): bool
    {
        return ($user->empresa_id === $documento->empresa_id) || $user->is_admin;
    }

    /**
     * Restaurar/Forzar borrado: Solo reservado para Admin
     */
    public function restore(User $user, Documento $documento): bool
    {
        return $user->is_admin;
    }

    public function forceDelete(User $user, Documento $documento): bool
    {
        return $user->is_admin;
    }
}
