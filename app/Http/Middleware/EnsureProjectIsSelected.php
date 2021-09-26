<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProjectIsSelected
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->user()->selected_project_id) {
            $projects = auth()->user()->projects;
            if (count($projects) > 1) {
                auth()->user()->selected_project_id = $projects->first()->id;
                auth()->user()->save();

                return $next($request);
            }

            return redirect()->route('project.index');
        }

        return $next($request);
    }
}
