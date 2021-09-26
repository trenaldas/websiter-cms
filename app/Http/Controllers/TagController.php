<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tag::class, 'tag');
    }

    public function index(Request $request): View
    {
        return view('tag.index', [
            'tags' => auth()->user()
                ->selectedProject
                ->tags()
                ->parent()
                ->get()
                ->load(['bits', 'childrenTags']),
        ]);
    }

    public function create(): View
    {
        return view('tag.create', [
            'parentTags' => auth()->user()->selectedProject->tags()->parent()->get(),
        ]);
    }

    public function edit(Tag $tag): View
    {
        return view('tag.edit', [
            'parentTags' => auth()->user()->selectedProject->tags()->parent()->get(),
            'tag'        => $tag,
        ]);
    }

    public function showBits(Tag $tag): View
    {
        $this->authorize('showBits', $tag);

        return view('tag.show-bits', [
            'tag'  => $tag,
            'bits' => $tag->bits()
                ->parent()
                ->withCount('childrenBits')
                ->with(['bitTheme', 'childrenBits'])
                ->get(),
        ]);
    }
}
