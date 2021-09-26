<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Redirector;

class CreateTag extends Component
{
    public Collection $parentTags;

    public string $name        = '';
    public string $description = '';
    public int    $parent_id   = 0;
    public bool   $active      = false;
    public bool   $home        = false;

    public string $message         = '';
    public bool   $showParentInput = true;
    public bool   $showHomeSelect  = true;

    protected function rules(): array
    {
        return [
            'name'        => [
                'required',
                'min:3',
                'max:15',
            ],
            'description' => [
                'string',
                'min:5',
                'max:50',
            ],
            'parent_id' => [
                'exclude_if:parent_id,0',
                Rule::exists('tags', 'id')->where(function ($query) {
                    return $query->where('project_id', auth()->user()->selectedProject->id);
                }),
            ]
        ];
    }

    public function updatedParentId(): void
    {
        if ($this->parent_id > 0) {
            $this->showHomeSelect = false;
            $tag = Tag::find($this->parent_id);
            if (count($tag->bits) > 0) {
                $this->message =
                    "Selected page '$tag->name' has "
                    . count($tag->bits)
                    . " bits attached. If you'll proceed all bits will be attached to this page.";
            }
            return;
        }

        $this->message        = '';
        $this->showHomeSelect = true;
    }

    public function updatedHome(): void
    {
        if ($this->home) {
            $this->showParentInput = false;
            $this->active          = true;

            return;
        }

        $this->showParentInput = true;
    }

    public function updatedActive(): void
    {
        if ($this->active) {
            return;
        }

        $this->home = false;
    }

    public function store(): Redirector
    {
        $this->validate();
        $home = [];

        if (($this->home && !$this->parent_id)
            || count(auth()->user()->selectedProject->tags()->active()->get()) === 0
        ) {
            $home = ['home' => 1];
            auth()->user()->selectedProject->tags()->update([
                'home' => 0,
            ]);
        }

        $newTag = auth()->user()->selectedProject->tags()->create(
            array_merge(
                $home, [
                'parent_id'   => $this->parent_id > 0 ? $this->parent_id : null,
                'name'        => $this->name,
                'description' => $this->description,
                'active'      => $this->active,
                'position'    => count(auth()->user()->selectedProject->tags) + 1,
            ]));

        $parentTagBits = null;
        if ($this->parent_id > 0) {
            $parentTagBits = Tag::find($this->parent_id)->bits;
            foreach ($parentTagBits as $parentTagBit) {
                $newTag->bits()->save($parentTagBit);
            }
        }

        if ($this->parent_id > 0) {
            $parentTag = Tag::find($this->parent_id);
            $tags = $parentTag->childrenTags;
            $tagsActive = $tags->pluck('active')->toArray();

            if (!in_array(1, $tagsActive, true)) {
                $parentTag->update([
                    'active' => 0,
                ]);
            }
        }

        session()->flash('message', __('Page created successfully!'));
        return redirect()->route('tag.index');
    }

    public function render(): View
    {
        return view('livewire.tag.create-tag');
    }
}
