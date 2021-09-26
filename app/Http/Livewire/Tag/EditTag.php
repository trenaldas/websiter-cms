<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Redirector;

class EditTag extends Component
{
    use AuthorizesRequests;

    public Collection $parentTags;
    public Tag        $tag;

    public string $name        = '';
    public string $description = '';
    public int    $parent_id   = 0;
    public bool   $active      = false;
    public bool   $home        = false;

    public bool   $showParentInput  = true;
    public bool   $showHomeSelect   = true;
    public bool   $disableHomeCheck = false;
    public string $message          = '';

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

    public function mount(): void
    {
        $this->name        = $this->tag->name;
        $this->description = $this->tag->description;
        $this->parent_id   = $this->tag->parent_id ?? 0;
        $this->active      = $this->tag->active ?? false;
        $this->home        = $this->tag->home ?? false;

        if ($this->tag->home || count($this->tag->childrenTags) > 0) {
            $this->disableHomeCheck = true;
        }

        $this->showParentInput  = !$this->home;
        $this->showHomeSelect   = !$this->parent_id;
    }

    public function updatedParentId(): void
    {
        if ($this->parent_id > 0) {
            $this->showHomeSelect = false;
            $tag = auth()->user()->selectedProject->tags()->find($this->parent_id);
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

    public function updatedActive(): void
    {
        if ($this->active) {
            return;
        }

        $this->home = false;
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

    public function update(): Redirector
    {
        $this->authorize('update', $this->tag);

        $this->validate();

        $home = [];
        if (($this->home && $this->parent_id === 0)
            || count(auth()->user()->selectedProject->tags()->active()->get()) === 0
        ) {
            $home = ['home' => true];
            auth()->user()->selectedProject->tags()->update([
                'home' => 0,
            ]);
        }

        $this->tag->update(
            array_merge(
                $home, [
                'parent_id'   => $this->parent_id > 0 ? $this->parent_id : null,
                'name'        => $this->name,
                'description' => $this->description,
                'active'      => $this->active,
        ]));

        session()->flash('message', __('Page updated successfully!'));
        return redirect()->route('tag.index');
    }

    public function render(): View
    {
        return view('livewire.tag.edit-tag');
    }
}
