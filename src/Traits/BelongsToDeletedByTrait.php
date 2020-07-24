<?php
/*
 *
  ____                 _ _     _____           _                       _
 |  _ \               | | |   |_   _|         | |                     (_)
 | |_) | ___ _ __   __| | |_    | |  _ __   __| | ___  _ __   ___  ___ _  __ _
 |  _ < / _ \ '_ \ / _` | __|   | | | '_ \ / _` |/ _ \| '_ \ / _ \/ __| |/ _` |
 | |_) |  __/ | | | (_| | |_   _| |_| | | | (_| | (_) | | | |  __/\__ \ | (_| |
 |____/ \___|_| |_|\__,_|\__| |_____|_| |_|\__,_|\___/|_| |_|\___||___/_|\__,_|

 Please don't modify this file because it may be overwritten when re-generated.
 */

namespace Bendt\Option\Traits;

use Bendt\Option\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait BelongsToDeletedByTrait
 */
trait BelongsToDeletedByTrait
{
    use RelationshipTrait;

    /**
     * @return BelongsTo
     */
    public function deleted_by(): BelongsTo
    {
        return $this->belongsTo(User::class,'deleted_by_id');
    }
}
