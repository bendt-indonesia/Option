<?php

namespace Bendt\Option\Data\Option;

use App\User;
use Bendt\Option\Models\Option as Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\Option $model
     * @return mixed
     */
    public function view(User $user, Model $model)
    {
        return $user->hasAnyRole(['VIEW_OPTION','VIEW_OPTION_DETAIL','VIEW_PRODUCT_TYPE_ATTRIBUTE']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAnyRole(['STORE_OPTION']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\Option $model
     * @return mixed
     */
    public function update(User $user, Model $model)
    {
        return $user->hasAnyRole(['UPDATE_OPTION']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\Option $model
     * @return mixed
     */
    public function destroy(User $user, Model $model)
    {
        return $user->hasAnyRole(['DESTROY_OPTION']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User $user
     * @param  \Bendt\Option\Models\Option $model
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
     * @param  \Bendt\Option\Models\Option $model
     * @return mixed
     */
    public function forceDelete(User $user, Model $model)
    {
        return false;
    }
}
