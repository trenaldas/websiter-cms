<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    private array $statusTypes = [
        'pending'     => 'Pending',
        'in_progress' => 'In Progress',
        'completed'   => 'Completed',
        'cancelled'   => 'Cancelled',
        'refunded'    => 'Refunded',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrderIdAttribute(): string
    {
        return substr(str_repeat(0, 5).$this->id, - 5);
    }

    public function getOrderStatusAttribute(): string
    {
        return $this->statusTypes[$this->status];
    }

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class)->withTrashed();
    }

    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->last_name;
    }

    public function getFullOrderCostAttribute(): int
    {
        return $this->orderItems->sum('order_item_full_cost');
    }
}
