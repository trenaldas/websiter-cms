<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Billable, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForSlack($notification)
    {
        return config('slack.cms-webhook-url');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function selectedProject(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'selected_project_id');
    }

    public function queries(): HasManyThrough
    {
        return $this->hasManyThrough(Query::class, Project::class);
    }

    public function getSubscriptionPlan(): SubscriptionPlan
    {
        if ($this->threeYearPlan || auth()->user()->subscriptions()->count() > 0) {
            return SubscriptionPlan::find(2);
        }

        return SubscriptionPlan::find(1);
    }

    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function threeYearPlan(): HasOne
    {
        return $this->hasOne(ThreeYearPlan::class);
    }
}
