<?php

namespace App\Http\Livewire\ShippingMethod;

use App\Models\Project;
use App\Models\ShippingMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class IndexShippingMethod extends Component
{
    public Collection $methods;
    public Project    $project;

    public string $price = '';
    public string $name = '';

    public array $rules = [
        'name'  => 'required|string|min:5|max:25',
        'price' => 'required|numeric',
    ];

    public function mount(): void
    {
        $this->project = auth()->user()->selectedProject;
    }

    public function store(): void
    {
        $this->validate();

        ShippingMethod::create([
            'project_id' => auth()->user()->selectedProject->id,
            'name'       => $this->name,
            'price'      => $this->price * 100,
        ]);

        $this->methods = auth()->user()->selectedProject->shippingMethods;
        $this->reset(['price', 'name']);
    }

    public function delete(ShippingMethod $method): void
    {
        $method->delete();

        $this->methods = auth()->user()->selectedProject->shippingMethods;
    }

    public function render(): View
    {
        return view('livewire.shipping-method.index-shipping-method');
    }
}
