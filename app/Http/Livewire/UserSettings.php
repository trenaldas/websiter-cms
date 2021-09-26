<?php

namespace App\Http\Livewire;

use App\Models\SubscriptionPlan;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Redirector;

class UserSettings extends Component
{
    public Collection $subscriptionPlans;
    public SubscriptionPlan $currentSubscriptionPlan;
    public string     $plan = 'monthly_cost';

    public function mount(): void
    {
        $this->subscriptionPlans = SubscriptionPlan::all();
        $this->currentSubscriptionPlan = auth()->user()->getSubscriptionPlan();
    }

    public function subscribe(int $subscriptionPlanId): Redirector
    {
        return redirect()->route('subscription-plan.create', [
            'subscriptionPlanId' => $subscriptionPlanId,
            'planPeriod'         => $this->plan,
        ]);
    }

    public function render(): View
    {
        return view('livewire.user-settings');
    }
}
