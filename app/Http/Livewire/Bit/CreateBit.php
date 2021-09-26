<?php

namespace App\Http\Livewire\Bit;

use App\Models\Bit;
use App\Models\BitTheme;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;

class CreateBit extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public array $photoCount = [
        BitTheme::TEXT_AND_PHOTO  => 1,
        BitTheme::PHOTO_AND_TEXT  => 1,
        BitTheme::TEXT_ONLY       => 0,
        BitTheme::FULL_SIZE_PHOTO => 1,
        BitTheme::TWO_PHOTOS      => 2,
        BitTheme::THREE_PHOTOS    => 3,
        BitTheme::FOUR_PHOTOS     => 4,
        BitTheme::SIX_PHOTOS      => 6,
        BitTheme::TWELVE_PHOTOS   => 12,
    ];

    public Collection $parentBits;
    public BitTheme   $bitTheme;
    public int        $tagId;

    public ?int    $tag_id       = null;
    public ?int    $bit_theme_id = null;
    public bool    $product      = false;
    public bool    $active       = false;
    public string  $name         = '';
    public string  $text         = '';
    public         $photos       = null;
    public string  $code         = '';
    public         $price        = 0.01;
    public ?int    $parentId     = null;

    protected function rules(): array
    {
        return [
            'name'         => [
                'max:25',
                'required_if:bit_theme_id,1',
                'required_if:bit_theme_id,2',
                'required_if:bit_theme_id,3',
            ],
            'bit_theme_id' => ['required', 'exists:bit_themes,id'],
            'tag_id'       => [
                Rule::exists('tags', 'id')->where(function ($query) {
                    return $query->where('project_id', auth()->user()->selectedProject->id);
                }),
                'required',
            ],
            'text'         => [
                'required_if:bit_theme_id,1',
                'required_if:bit_theme_id,2',
                'required_if:bit_theme_id,3',
            ],
            'photos.*'     => [
                'file',
                'mimes:jpg,jpeg,png,bmp',
                'max:2000',
            ],
            'photos'       => [
                'required_if:bit_theme_id,1',
                'required_if:bit_theme_id,2',
                'required_if:bit_theme_id,4',
                'required_if:bit_theme_id,5',
                'required_if:bit_theme_id,6',
                'required_if:bit_theme_id,7',
                'required_if:bit_theme_id,8',
                'required_if:bit_theme_id,9',
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
        $this->authorize('create', Bit::class);

        $this->tag_id       = $this->tagId;
        $this->bit_theme_id = $this->bitTheme->id;
    }

    public function updatedPhotos($value): void
    {
        $this->photos = array_slice(
            $this->photos,
            0,
            $this->photoCount[$this->bit_theme_id]
        );
    }

    public function back(): Redirector
    {
        return redirect()->route('bit-theme.index', ['tag_id' => $this->tagId]);
    }

    public function store(): Redirector
    {
        $this->validate([
            'photos' => [
                'min:' . $this->photoCount[$this->bitTheme->id],
            ],
        ], [
            'photos.min' => __('This bit theme needs :min photos.'),
        ]);

        $this->validate();
        $parentBit = null;
        if ($this->parentId > 0) {
            $parentBit = $this->parentBits
                              ->where('id', $this->parentId)
                              ->first();
        }

        $data = [
            'parent_id'      => $this->parentId ?? null,
            'tag_id'         => $this->parentId ? $parentBit->tag_id :  $this->tagId,
            'bit_theme_id'   => $this->bitTheme->id,
            'name'           => Str::ucfirst($this->name),
            'text'           => $this->text,
            'active'         => $this->active,
        ];

        if ($this->product) {
            $data = array_merge(
                $data,
                [
                    'price' => $this->price * 100,
                    'code'  => $this->code,
                ]
            );
        }

        $bit = Bit::create($data);

        if ($this->photos) {
            $photoUrl = [];
            foreach ($this->photos as $photo) {
                $photoUrl[] = $photo->store('temp');
            }

            foreach ($photoUrl as $url) {
                $bit->addMedia(storage_path('app/'.$url))->toMediaCollection();
            }
        }
        session()->flash('message', __('Bit created successfully!'));

        return redirect()->route('tag.bits', $this->tagId);
    }

    public function render(): View
    {
        return view('livewire.bit.create-bit');
    }
}
