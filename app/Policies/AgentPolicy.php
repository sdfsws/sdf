<?php

namespace App\Policies;

use App\Models\User;

class AgentPolicy
{
    public function __construct()
    {
        //
    }

    public function manageClients(User $user): bool
    {
        return $user->hasRole('agent'); // فقط الوكلاء يمكنهم إدارة العملاء
    }

    public function viewAny(User $user): bool
    {
        return $this->manageClients($user);
    }

    public function view(User $user, $client): bool
    {
        return $this->manageClients($user); // الوكيل يمكنه رؤية عملائه
    }

    public function create(User $user): bool
    {
        return $this->manageClients($user);
    }

    public function update(User $user, $client): bool
    {
        return $this->manageClients($user);
    }

    public function delete(User $user, $client): bool
    {
        return $this->manageClients($user);
    }
}
