<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{
    public function created(Tag $tag): void
    {
        auth()->user()->increment('tags_count');

        $parentTag = $tag->parentTag;
        if ($parentTag) {
            count($parentTag->activeChildrenTags) === 0
                ? $parentTag->update(['active' => false])
                : $parentTag->update(['active' => true]);
        }

        if ($tag->home) {
            $tag->active = true;
            $tag->saveQuietly();
        }
    }

    public function updated(Tag $tag): void
    {
        $parentTag   = $tag->parentTag;
        $originalTag = (object) $tag->getOriginal();

        if ($parentTag) {
            count($parentTag->activeChildrenTags) === 0
                ? $parentTag->update(['active' => false])
                : $parentTag->update(['active' => true]);
        }

        if ($originalTag->parent_id > 0 && $originalTag->parent_id !== $tag->parent_id) {
            $originalParentTag = Tag::find($originalTag->parent_id );
            count($originalParentTag->activeChildrenTags) === 0
                ? $originalParentTag->update(['active' => false])
                : $originalParentTag->update(['active' => true]);
        }

        if (count($tag->childrenTags) > 0 && $tag->active === false) {
            $tag->childrenTags()->update(['active' => false]);
        }

        if ($tag->active === true && count($tag->activeChildrenTags) === 0) {
            $tag->childrenTags()->update(['active' => true]);
        }
    }

    public function deleted(Tag $tag): void
    {
        auth()->user()->decrement('tags_count');

        foreach ($tag->childrenTags as $childrenTag) {
            $childrenTag->delete();
        }

        foreach ($tag->bits as $bit) {
            $bit->delete();
        }
    }

    public function restored(Tag $tag): void
    {
        //
    }

    public function forceDeleted(Tag $tag): void
    {
        //
    }
}
