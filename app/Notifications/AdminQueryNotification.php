<?php

namespace App\Notifications;

use App\Models\AdminQuery;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class AdminQueryNotification extends Notification
{
    use Queueable;

    private AdminQuery $adminQuery;

    public function __construct(AdminQuery $adminQuery)
    {
        $this->adminQuery = $adminQuery;
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack($notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->from('New Admin Query Received')
            ->content($this->adminQuery->message);
    }
}
