<?php

namespace App\Observers;

use App\Models\Bit;
use App\Models\Project;

class ProjectObserver
{
    public function created(Project $project): void
    {
        $project->user->increment('projects_count');
    }

    public function updated(Project $project): void
    {
        //
    }

    public function deleted(Project $project): void
    {
        $project->user->decrement('projects_count');

        foreach ($project->parentTags as $tag) {
            $tag->delete();
        }

        if (auth()->user()->selected_project_id === $project->id) {
            auth()->user()->selected_project_id = null;
            if (!auth()->user()->selected_project_id && auth()->user()->projects()->count() > 0) {
                auth()->user()->selected_project_id = auth()->user()->projects()->first()->id;
            }

            auth()->user()->save();
        }
    }

    public function restored(Project $project): void
    {
        //
    }

    public function forceDeleted(Project $project): void
    {
        //
    }
}
