<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\SystemUser as User;
use App\Models\Widget;
use Illuminate\Auth\Access\Response;
use Filament\Facades\Filament;
class WidgetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {


        return $user->role->id === Role::ADMIN && Filament::getId() === 'admin' ;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Widget $widget): bool
    {
        return $user->role->id === Role::ADMIN ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->id === Role::ADMIN ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Widget $widget): bool
    {
        return $user->role->id === Role::ADMIN ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Widget $widget): bool
    {
        return $user->role->id === Role::ADMIN ;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Widget $widget): bool
    {
        return $user->role->id === Role::ADMIN ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Widget $widget): bool
    {
        //
    }
}
