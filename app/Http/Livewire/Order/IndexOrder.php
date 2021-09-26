<?php

namespace App\Http\Livewire\Order;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class IndexOrder extends Component
{
    use WithPagination;

    public string $findByStatus = 'pending';
    public string $currency = 'USD';

    public function mount(): void
    {
        $this->currency = auth()->user()->selectedProject->currency->name;
    }

    public function render(): View
    {
        return view('livewire.order.index-order', [
            'orders' => auth()->user()
                ->selectedProject
                ->orders()
                ->where('confirmed', true)
                ->where('status', $this->findByStatus)
                ->paginate(10),
        ]);
    }
}
