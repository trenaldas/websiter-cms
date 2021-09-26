<?php

namespace App\Providers;

use App\Models\Bit;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use App\Observers\BitObserver;
use App\Observers\ProjectObserver;
use App\Observers\TagObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot(): void
    {
        Bit::observe(BitObserver::class);
        Tag::observe(TagObserver::class);
        Project::observe(ProjectObserver::class);
        User::observe(UserObserver::class);
    }
}
