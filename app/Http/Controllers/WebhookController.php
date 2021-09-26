<?php


namespace App\Http\Controllers;

use App\Mail\SubscriptionSuccessfulMail;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    public function handleCheckoutSessionCompleted($payload): void
    {
        $totalPayed = $payload['data']['object']['amount_total'];
        $userEmail  = $payload['data']['object']['customer_details']['email'];
        $user       = User::where('email', $userEmail)->firstOrFail();

        if ($totalPayed === SubscriptionPlan::THREE_YEAR_FULL_PRICE) {
            $user->threeYearPlan()->create([
                'ends_at' => now()->addYears(3),
            ]);
        }

        Mail::to($user->email)->send(new SubscriptionSuccessfulMail($user, $totalPayed));
    }
}
