<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return auth()->check()
            ? Response::allow()
            : Response::deny();
    }

    public function view(User $user, Tag $tag): Response
    {
        return $user->id === $tag->project->user_id
            ? Response::allow()
            : Response::deny();
    }

    public function update(User $user, Tag $tag): Response
    {
        return $user->id === $tag->project->user_id
            ? Response::allow()
            : Response::deny();
    }

    public function create(User $user): Response
    {
        if ($user->tags_count < $user->getSubscriptionPlan()->bits
            && auth()->check()
            && auth()->id() === $user->id
        ) {
            return Response::allow();
        }

        return Response::deny();
    }

    public function delete(User $user, Tag $tag): Response
    {
        return $user->id === $tag->project->user_id
            ? Response::allow()
            : Response::deny();
    }

    public function showBits(User $user, Tag $tag): Response
    {
        return $user->id === $tag->project->user_id
            ? Response::allow()
            : Response::deny();
    }
}
