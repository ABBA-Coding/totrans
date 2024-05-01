<?php

namespace App\Observers;

use App\Services\BitrixService;
use App\User;

class UserObserver
{
    public function created(User $user): void
    {
        $service = new BitrixService();
        $service->createUser($user->id);
    }
}
