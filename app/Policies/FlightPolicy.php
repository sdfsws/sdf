<?php

namespace App\Policies;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FlightPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // أو وضع الشرط المناسب
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Flight $Flight): bool
    {
        return $user->id === $Flight->user_id; // مثال: المستخدم يمكنه رؤية العميل إذا كان هو مالكه
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // أو وضع الشرط المناسب
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Flight $Flight): bool
    {
        return $user->id === $Flight->user_id; // مثال: المستخدم يمكنه تعديل العميل إذا كان هو مالكه
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Flight $Flight): bool
    {
        return $user->id === $Flight->user_id; // مثال: المستخدم يمكنه حذف العميل إذا كان هو مالكه
    }
}
