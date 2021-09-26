<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Exceptions\IncompletePayment;

class SubscriptionPlanController extends Controller
{
    public function create(Request $request): View
    {
        $subscriptionPlan = SubscriptionPlan::find($request->subscriptionPlanId);

        if ($request->planPeriod === 'three_years') {
            $checkout = auth()->user()
                ->checkout($subscriptionPlan->{$request->planPeriod . '_stripe_id'}, [
                    'success_url' => route('user.settings'),
                    'cancel_url'  => route('user.settings'),
                ]);

            return view('subscription-plan.create', [
                'checkout'         => $checkout,
                'subscriptionPlan' => $subscriptionPlan,
                'planPeriod'       => $request->planPeriod,
            ]);
        }

        $checkout = auth()->user()
            ->newSubscription(
                $subscriptionPlan->name,
                $subscriptionPlan->{$request->planPeriod.'_stripe_id'}
            )->checkout([
                'success_url' => route('user.settings'),
                'cancel_url' => route('user.settings'),
            ]);

        return view('subscription-plan.create', [
            'checkout'         => $checkout,
            'subscriptionPlan' => $subscriptionPlan,
            'planPeriod'       => $request->planPeriod,
        ]);
    }

    public function store(Request $request)
    {

        $subscriptionPlan = SubscriptionPlan::find($request->subscription_plan_id);

        if ($request->plan_period === 'three_years') {
                auth()->user()->checkout($subscriptionPlan->three_years_stripe_id);

            return response([
                'success_url' => redirect()->intended('/settings')->getTargetUrl(),
                'message'     => __('Subscription Successful')
            ]);
        }
    }
}
