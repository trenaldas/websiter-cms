<?php

namespace App\Http\Livewire\Bit;

use App\Models\Bit;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;

class EditBit extends Component
{
    use AuthorizesRequests;

    public Collection $parentBits;
    public Bit        $bit;

    public bool   $product  = false;
    public bool   $active   = false;
    public string $name     = '';
    public string $text     = '';
    public        $photos   = null;
    public string $code     = '';
    public        $price    = 0.01;
    public ?int   $parentId = null;

    protected $listeners = ['delete'];

    protected function rules(): array
    {
        return [
            'name'         => [
                'max:25',
                'required_if:bit_theme_id,1',
                'required_if:bit_theme_id,2',
                'required_if:bit_theme_id,3',
            ],
            'price' => [
                'required_if:product,true',
                'numeric',
            ],
            'code' => [
                'required_if:product,true',
                'string',
                'max:25',
                'min:3',
            ],
        ];
    }

    public function mount(): void
    {
        $this->name     = $this->bit->name;
        $this->product  = $this->bit->price ? true : false;
        $this->price    = $this->bit->productPrice;
        $this->code     = $this->bit->code ?? '';
        $this->active   = $this->bit->active;
        $this->text     = $this->bit->text ?? '';
        $this->parentId = $this->bit->parent_id;
    }

    public function sort($items): void
    {
        foreach ($items as $item) {
            Bit::find($item['value'])->update([
                'position' => $item['order'],
            ]);
        }

        $this->bit = Bit::find($this->bit->id);
    }

    public function back(): Redirector
    {
        if ($this->bit->parent_id) {
            return redirect()->route('bit.edit', $this->bit->parent_id);
        }

        return redirect()->route('tag.bits', $this->bit->tag_id);
    }

    public function deleteConfirm(): void
    {
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'title' => __('Are you sure?'),
                'text' => '',
            ]
        );
    }

    public function delete(): Redirector
    {
        $this->authorize('delete', $this->bit);

        $tagId     = $this->bit->tag_id;
        $parentBit = $this->bit->parent_id;

        $this->bit->delete();

        session()->flash('message', __('Bit deleted successfully!'));

        if ($parentBit) {
            return redirect()->route('bit.edit', $parentBit);
        }

        return redirect()->route('tag.bits', $tagId);
    }

    public function update(): Redirector
    {
        $this->authorize('update', $this->bit);

        $this->validate();

        $data = [
            'name'   => Str::ucfirst($this->name),
            'text'   => $this->text,
            'active' => $this->active,
            'parent_id' => $this->parentId == 0 ? null : $this->parentId,
        ];

        if ($this->bit->price) {
            $data = array_merge(
                $data,
                [
                    'old_price' => $this->bit->price * 100,
                ]
            );
        }

        if ($this->product) {
            $data = array_merge(
                $data,
                [
                    'price'     => $this->price * 100,
                    'code'      => $this->code,
                ]
            );
        }

        $this->bit->update($data);

        session()->flash('message', __('Bit updated successfully!'));

        return $this->bit->parent_id
            ? redirect()->route('bit.edit', $this->bit->parent_id)
            : redirect()->route('tag.bits', $this->bit->tag_id);
    }

    public function render(): View
    {
        return view('livewire.bit.edit-bit');
    }
}
