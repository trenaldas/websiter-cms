<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Redirector;

class ShowOrder extends Component
{
    public Order $order;
    public int   $totalCost = 0;

    public string $status   = '';
    public string $currency = 'USD';

    public function mount(): void
    {
        $this->totalCost = $this->order->full_order_cost;
        $this->status    = $this->order->status;
        $this->currency  = auth()->user()->selectedProject->currency->name;
    }

    public function updateStatus(): void
    {
        $this->order->update([
            'status'  => $this->status,
        ]);

        session()->flash(
            'message',
            __('Status successfully set to :status',
                ['status' => ucwords(str_replace('_', ' ', $this->status))]
            ));
    }

    public function edit(): Redirector
    {
        return redirect()->route('order.edit', $this->order->id);
    }

    public function changeStatus($status): void
    {
        $this->order->update(['status' => $status]);
        $this->order->refresh();
    }

    public function render(): View
    {
        return view('livewire.order.show-order');
    }
}
