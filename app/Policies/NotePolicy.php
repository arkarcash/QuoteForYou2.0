<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $user)
    {
                return $user;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $user, note $note)
    {
                return $user;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $user)
    {
                return $user;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $user, note $note)
    {
                return $user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $user, note $note)
    {
                return $user;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user, note $note)
    {
                return $user;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user, note $note)
    {
                return $user;
    }
}
