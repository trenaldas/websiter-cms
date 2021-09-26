<?php

namespace App\Providers;

use App\Models\Bit;
use App\Models\Order;
use App\Models\Project;
use App\Models\Tag;
use App\Policies\BitPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Bit::class     => BitPolicy::class,
        Tag::class     => TagPolicy::class,
        Project::class => ProjectPolicy::class,
        Order::class   => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
