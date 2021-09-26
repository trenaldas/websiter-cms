<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdminConfig extends Model
{
    use Notifiable;

    public function routeNotificationForSlack($notification)
    {
        return config('slack.cms-webhook-url');
    }
}
