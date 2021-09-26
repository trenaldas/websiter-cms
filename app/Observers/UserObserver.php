<?php

namespace App\Observers;

use App\Mail\NewUserRegistrationMail;
use App\Models\User;
use App\Notifications\NewUserRegistrationNotification;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    public function updated(User $user): void
    {
        if ($user->email_verified_at && $user->getOriginal('email_verified_at') === null) {
            Mail::to($user->email)->send(new NewUserRegistrationMail($user));
            $user->notify(new NewUserRegistrationNotification());
        }
    }

}
