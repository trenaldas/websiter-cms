<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BitTheme extends Model
{
    use SoftDeletes;

    public const TEXT_AND_PHOTO  = 1;
    public const PHOTO_AND_TEXT  = 2;
    public const TEXT_ONLY       = 3;
    public const FULL_SIZE_PHOTO = 4;
    public const TWO_PHOTOS      = 5;
    public const THREE_PHOTOS    = 6;
    public const FOUR_PHOTOS     = 7;
    public const SIX_PHOTOS      = 8;
    public const TWELVE_PHOTOS   = 9;

    protected $guarded = [];

    public function bits(): HasMany
    {
        return $this->hasMany(Bit::class);
    }
}
