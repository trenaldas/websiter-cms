<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Redirector;

class IndexTag extends Component
{
    public Collection $tags;

    protected $listeners = ['delete'];

    public function sort($list): void
    {
        foreach ($list as $item) {
            Tag::find($item['value'])->update([
                'position' => $item['order'],
            ]);
        }

        $this->tags = auth()->user()->selectedProject->tags()->parent()->get();
        session()->flash('message', __('Position saved!'));
    }

    public function sortSubTag($list)
    {
        //
    }

    public function deleteConfirm(int $id): void
    {
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'title' => __('Are you sure?'),
                'text' => '',
                'id' => $id,
            ]
        );
    }

    public function delete(int $tagId): void
    {
        $tag = Tag::find($tagId);
        if ($tag->home) {
            session()->flash(
                'message',
                __('Page is set as Home, and could not be deleted!')
            );
            return;
        }

        $tag->delete();

        $this->tags = auth()->user()->selectedProject->tags()->parent()->get()->load('bits');
    }

    public function edit(int $tagId): Redirector
    {
        return redirect()->route('tag.edit', $tagId);
    }

    public function render(): View
    {
        return view('livewire.tag.index-tag');
    }
}
