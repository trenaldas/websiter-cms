<?php

namespace App\Mail;

use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionSuccessfulMail extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;
    private int $totalPayed;

    public function __construct(User $user, int $totalPayed)
    {
        $this->user = $user;
        $this->totalPayed =  $totalPayed;
    }

    public function build()
    {
        $subscriptionType = 'Monthly plan. Your next payment is due on ' . now()->addMonth();

        if ($this->totalPayed === SubscriptionPlan::THREE_YEAR_FULL_PRICE) {
            $subscriptionType = "Three Years plan. We will send you a notice before you are due to renewal which is on {$this->user->threeYearPlan->ends_at}.";
        }

        if ($this->totalPayed === SubscriptionPlan::YEARLY_FULL_PRICE) {
            $subscriptionType = 'Yearly plan. Your next payment is due on ' . now()->addYear();
        }

        return $this->markdown('mail.subscription-successful', [
            'user'             => $this->user,
            'subscriptionType' => $subscriptionType,
        ]);
    }
}
