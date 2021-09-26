<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }

    public function index(): View
    {
        return view('project.index', [
            'projects' => auth()->user()->projects()
                                ->select(['title', 'id', 'active'])
                                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('project.create');
    }

    public function edit(Project $project): View
    {
        return view('project.edit',compact('project'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('project.index')
                        ->with('success',__('Deleted'));
    }

    public function setProject(Project $project): RedirectResponse
    {
        $this->authorize('setProject', $project);

        auth()->user()->selected_project_id = $project->id;
        auth()->user()->update();

        return redirect()->route('project.index')->with('success',__('Saved'));
    }
}
