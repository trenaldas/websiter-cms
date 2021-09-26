<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    public const THREE_YEAR_FULL_PRICE = 10800;
    public const YEARLY_FULL_PRICE     = 6000;
    public const MONTHLY_FULL_PRICE    = 700;

    protected $guarded = [];
}
