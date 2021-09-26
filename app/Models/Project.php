<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class)
                    ->orderBy('position');
    }

    public function parentTags(): HasMany
    {
        return $this->hasMany(Tag::class)
                    ->whereNull('parent_id');
    }

    public function queries(): HasMany
    {
        return $this->hasMany(Query::class);
    }

    public function bits(): HasManyThrough
    {
        return $this->hasManyThrough(Bit::class, Tag::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)
                    ->orderBy('created_at', 'desc');
    }

    public function shippingMethods(): HasMany
    {
        return $this->hasMany(ShippingMethod::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
