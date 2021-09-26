<?php

namespace App\Observers;

use App\Models\Bit;
use App\Models\BitTheme;

class BitObserver
{
    public array $photoCount = [
        BitTheme::TEXT_AND_PHOTO  => 1,
        BitTheme::PHOTO_AND_TEXT  => 1,
        BitTheme::TEXT_ONLY       => 0,
        BitTheme::FULL_SIZE_PHOTO => 1,
        BitTheme::TWO_PHOTOS      => 2,
        BitTheme::THREE_PHOTOS    => 3,
        BitTheme::FOUR_PHOTOS     => 4,
        BitTheme::SIX_PHOTOS      => 6,
        BitTheme::TWELVE_PHOTOS   => 12,
    ];

    public function created(Bit $bit): void
    {
        auth()->user()->increment('bits_count');
        $bit->tag->project->user->increment('photos_count', $this->photoCount[$bit->bit_theme_id]);

        if (!$bit->tag->active) {
            $bit->update(['active' => false]);
        }
    }

    public function updated(Bit $bit): void
    {
        if (!$bit->tag->active) {
            $bit->active = false;
            $bit->saveQuietly();
        }
    }

    public function deleted(Bit $bit): void
    {
        auth()->user()->decrement('bits_count');
        auth()->user()->decrement('photos_count', $this->photoCount[$bit->bit_theme_id]);

        if (count($bit->childrenBits) > 0) {
            foreach ($bit->childrenBits as $childrenBit) {
                $childrenBit->clearMediaCollection();
            }
            $bit->childrenBits()->delete();
        }

        $bit->clearMediaCollection();
    }

    public function restored(Bit $bit): void
    {
        //
    }

    public function forceDeleted(Bit $bit): void
    {
        //
    }
}
