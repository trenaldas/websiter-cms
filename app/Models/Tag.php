<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function childrenTags(): HasMany
    {
        return $this->hasMany(Tag::class, 'parent_id')
                    ->orderBy('position', 'asc');
    }

    public function activeChildrenTags(): HasMany
    {
        return $this->hasMany(Tag::class, 'parent_id')
                    ->where('active', '=', true)
                    ->orderBy('position', 'asc');
    }

    public function parentTag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'parent_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function bits(): HasMany
    {
        return $this->hasMany(Bit::class)
                    ->orderBy('position');
    }

    public function childrenTagsBits(): HasManyThrough
    {
        return $this->hasManyThrough(Bit::class, Tag::class, 'parent_id');
    }

    public function hasChildren(): bool
    {
        return $this->childrenTags->count() > 0;
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id')
            ->orderBy('position', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
