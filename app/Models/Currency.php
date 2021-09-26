<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    protected $guarded = [];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
