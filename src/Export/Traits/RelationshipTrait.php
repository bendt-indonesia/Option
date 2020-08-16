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

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


/**
 * Trait RelationshipTrait
 * @package App\Component
 */
trait RelationshipTrait
{

    /**
     * @param $related
     * @param null $foreignKey
     * @param null $otherKey
     * @param null $relation
     * @return BelongsTo
     */
    abstract public function belongsTo($related, $foreignKey = null, $otherKey = null, $relation = null);

    /**
     * @param $related
     * @param null $foreignKey
     * @param null $localKey
     * @return HasOne
     */
    abstract public function hasOne($related, $foreignKey = null, $localKey = null);

    /**
     * @param $related
     * @param $name
     * @param null $type
     * @param null $id
     * @param null $localKey
     * @return MorphOne
     */
    abstract public function morphOne($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * @param null $name
     * @param null $type
     * @param null $id
     * @return MorphTo
     */
    abstract public function morphTo($name = null, $type = null, $id = null);

    /**
     * @param $related
     * @param null $foreignKey
     * @param null $localKey
     * @return HasMany
     */
    abstract public function hasMany($related, $foreignKey = null, $localKey = null);

    /**
     * @param $related
     * @param $name
     * @param null $type
     * @param null $id
     * @param null $localKey
     * @return MorphMany
     */
    abstract public function morphMany($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * @param $related
     * @param null $table
     * @param null $foreignPivotKey
     * @param null $relatedPivotKey
     * @param null $parentKey
     * @param null $relatedKey
     * @param null $relation
     * @return BelongsToMany
     */
    abstract public function belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null);

    /**
     * @param $related
     * @param $name
     * @param null $table
     * @param null $foreignPivotKey
     * @param null $relatedPivotKey
     * @param null $parentKey
     * @param null $relatedKey
     * @param bool $inverse
     * @return MorphToMany
     */
    abstract public function morphToMany($related, $name, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $inverse = false);
}
