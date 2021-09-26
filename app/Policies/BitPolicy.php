<?php

namespace App\Policies;

use App\Models\Bit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BitPolicy
{
    use HandlesAuthorization;

    public function create(User $user): Response
    {
        if ($user->bits_count < $user->getSubscriptionPlan()->bits
            && auth()->check()
            && auth()->id() === $user->id
        ) {
            return Response::allow();
        }

        return Response::deny();
    }

    public function update(User $user, Bit $bit): Response
    {
        return $user->id === $bit->tag->project->user_id
            ? Response::allow()
            : Response::deny();
    }

    public function delete(User $user, Bit $bit): Response
    {
        return $user->id === $bit->tag->project->user_id
            ? Response::allow()
            : Response::deny();
    }
}
