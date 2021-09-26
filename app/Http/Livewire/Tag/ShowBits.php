<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Redirector;

class ShowBits extends Component
{
    public Collection $bits;
    public Tag        $tag;

    public function sort(array $items): void
    {
        foreach ($items as $item) {
            $bit           = $this->bits->find($item['value']);
            $bit->position = $item['order'];
            $bit->saveQuietly();
        }

        $this->bits = Tag::find($this->tag->id)->bits()
            ->parent()
            ->withCount('childrenBits')
            ->with(['bitTheme', 'childrenBits'])
            ->get();
    }

    public function create(): Redirector
    {
        return redirect()->route('bit-theme.index', ['tag_id' => $this->tag->id]);
    }

    public function render(): View
    {
        return view('livewire.tag.show-bits');
    }
}
