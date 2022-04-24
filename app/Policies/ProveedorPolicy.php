<?php

namespace App\Policies;

use App\User;
use App\Proveedor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProveedorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function view(User $user, Proveedor $proveedor)
    {
        // Update $user authorization to view $proveedor here.
        return true;
    }

    /**
     * Determine whether the user can create proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function create(User $user, Proveedor $proveedor)
    {
        // Update $user authorization to create $proveedor here.
        return true;
    }

    /**
     * Determine whether the user can update the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function update(User $user, Proveedor $proveedor)
    {
        // Update $user authorization to update $proveedor here.
        return true;
    }

    /**
     * Determine whether the user can delete the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function delete(User $user, Proveedor $proveedor)
    {
        // Update $user authorization to delete $proveedor here.
        return true;
    }
}
