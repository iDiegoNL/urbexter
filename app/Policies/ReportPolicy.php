<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param User $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param Report $report
     * @return bool
     */
    public function view(?User $user, Report $report): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Report $report
     * @return bool
     */
    public function update(User $user, Report $report): bool
    {
        return $user->id === $report->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Report $report
     * @return bool
     */
    public function delete(User $user, Report $report): bool
    {
        return $user->id === $report->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Report $report
     * @return bool
     */
    public function restore(User $user, Report $report): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Report $report
     * @return bool
     */
    public function forceDelete(User $user, Report $report): bool
    {
        return $user->is_admin;
    }
}
