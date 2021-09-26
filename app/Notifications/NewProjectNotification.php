<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class NewProjectNotification extends Notification
{
    use Queueable;

    private Project $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack($notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->from('Websiter')
            ->content("New project created by {$notifiable->name} {$notifiable->surname}. Project name: {$this->project->title}");
    }
}
