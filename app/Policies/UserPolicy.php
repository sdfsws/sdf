<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function __construct()
    {
        //
    }

    public function view(User $user): bool
    {
        return true; // أي مستخدم يمكنه عرض بياناته الخاصة
    }

    public function update(User $user): bool
    {
        return true; // يمكن للمستخدم تحديث بياناته
    }

    public function delete(User $user): bool
    {
        return $user->hasRole('admin'); // يمكن للمشرف فقط حذف المستخدمين
    }
}
