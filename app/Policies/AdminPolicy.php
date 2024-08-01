<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    public function __construct()
    {
        //
    }

    public function manageUsers(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function viewAny(User $user): bool
    {
        return $this->manageUsers($user); // يمكن للمشرف عرض جميع المستخدمين
    }

    public function view(User $user, User $targetUser): bool
    {
        return $this->manageUsers($user); // يمكن للمشرف عرض تفاصيل المستخدمين
    }

    public function create(User $user): bool
    {
        return $this->manageUsers($user); // يمكن للمشرف إنشاء مستخدمين
    }

    public function update(User $user, User $targetUser): bool
    {
        return $this->manageUsers($user); // يمكن للمشرف تحديث مستخدمين
    }

    public function delete(User $user, User $targetUser): bool
    {
        return $this->manageUsers($user); // يمكن للمشرف حذف مستخدمين
    }
}
