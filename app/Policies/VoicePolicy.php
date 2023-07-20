<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Voice;
use Illuminate\Auth\Access\HandlesAuthorization;

class VoicePolicy
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
        return  $user;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $user, Voice $voice)
    {
        return  $user;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $user)
    {
        return  $user;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $user, Voice $voice)
    {
        return  $user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $user, Voice $voice)
    {
        return  $user;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user, Voice $voice)
    {
        return  $user;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Voice  $voice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user, Voice $voice)
    {
        return  $user;
    }
}
