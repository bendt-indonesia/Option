<?php

namespace Bendt\Option\Data\OptionDetail;

use App\User;
use Bendt\Option\Models\OptionDetail as Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\OptionDetail $model
     * @return mixed
     */
    public function view(User $user, Model $model)
    {
        return $user->hasAnyRole(['VIEW_OPTION_DETAIL','VIEW_OPTION']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAnyRole(['STORE_OPTION_DETAIL','STORE_OPTION']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\OptionDetail $model
     * @return mixed
     */
    public function update(User $user, Model $model)
    {
        return $user->hasAnyRole(['UPDATE_OPTION_DETAIL','UPDATE_OPTION']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\OptionDetail $model
     * @return mixed
     */
    public function destroy(User $user, Model $model)
    {
        return $user->hasAnyRole(['DESTROY_OPTION_DETAIL','DESTROY_OPTION']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\OptionDetail $model
     * @return mixed
     */
    public function restore(User $user, Model $model)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\OptionDetail $model
     * @return mixed
     */
    public function forceDelete(User $user, Model $model)
    {
        return false;
    }
}
