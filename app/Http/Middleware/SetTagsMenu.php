<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SetTagsMenu
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->selected_project_id) {
            View::composer('layouts.sidenav', function ($view) use ($request) {
                $tags = auth()->user()
                    ->selectedProject
                    ->tags()
                    ->active()
                    ->parent()
                    ->with(['childrenTags', 'childrenTags.bits', 'bits'])
                    ->get();

                $activeNav = 0;

                if (request()->routeIs('tag.bits')) {
                    $activeNav = $request->route('tag')->id;
                }

                if (request()->routeIs('bit.edit')) {
                    $bit = $request->route('bit');
                    $activeNav = $bit->tag_id;
                }

                $view->with('activeNav', $activeNav);
                $view->with('navTags', $tags);
            });

            return $next($request);
        }

        View::composer('layouts.sidenav', function ($view) {
            $view->with('navTags', []);
        });

        return $next($request);
    }
}
