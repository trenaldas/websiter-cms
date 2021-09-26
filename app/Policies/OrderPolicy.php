<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return auth()->check() && auth()->id() === $user->id
            ? Response::allow()
            : Response::deny();
    }

    public function view(User $user, Order $order): Response
    {
        return $user->id === $order->project->user->id
            ? Response::allow()
            : Response::deny();
    }
}
