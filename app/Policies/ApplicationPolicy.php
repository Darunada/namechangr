<?php

namespace App\Policies;

use App\User;
use App\Models\Application\Application;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the application.
     *
     * @param  User $user
     * @param Application $application
     * @return mixed
     */
    public function view(User $user, Application $application)
    {
        return $user->id == $application->user_id;
    }

    /**
     * Determine whether the user can create applications.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the application.
     *
     * @param  User  $user
     * @param  Application  $application
     * @return mixed
     */
    public function update(User $user, Application $application)
    {
        return $user->id == $application->user_id;
    }

    /**
     * Determine whether the user can delete the application.
     *
     * @param  User  $user
     * @param  Application  $application
     * @return mixed
     */
    public function delete(User $user, Application $application)
    {
        return $user->id == $application->user_id;
    }
}
