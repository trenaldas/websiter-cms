<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return auth()->check() && auth()->id() === $user->id
            ? Response::allow()
            : Response::deny();
    }

    public function update(User $user, Project $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny();
    }

    public function create(User $user): Response
    {
        if ($user->projects_count < $user->getSubscriptionPlan()->projects
            && auth()->check()
            && auth()->id() === $user->id) {

            return Response::allow();
        }

        return Response::deny();
    }

    public function delete(User $user, Project $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny();
    }

    public function setProject(User $user, Project $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny();
    }
}
