<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->point_id != null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Service $service): Response
    {
        return $user->point_id === $service->point_id
            ? Response::allow()
            : Response::deny('You do not allowed to show this resource.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->point_id != null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): Response
    {
        return $user->point_id === $service->point_id
            ? Response::allow()
            : Response::deny('You do not allowed to show this resource.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function updateStatus(User $user, Service $service): Response
    {
        return $user->point_id === $service->point_id
            ? Response::allow()
            : Response::deny('You do not allowed to show this resource.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): Response
    {
        return $user->point_id === $service->point_id
            ? Response::allow()
            : Response::deny('You do not allowed to show this resource.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Service $service): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Service $service): bool
    {
        return false;
    }
}
