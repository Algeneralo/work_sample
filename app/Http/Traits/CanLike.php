<?php

namespace App\Http\Traits;

use Multicaret\Acquaintances\Interaction;

/**
 * Trait CanLike.
 */
trait CanLike
{
    use \Multicaret\Acquaintances\Traits\CanLike;

    /**
     * Return item likes.
     *
     * @param string $class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes($class = __CLASS__)
    {
        return $this->morphedByMany($class, 'subject',
            config('acquaintances.tables.interactions'), "user_id")
            ->wherePivot('relation', '=', Interaction::RELATION_LIKE)
            ->withPivot(...Interaction::$pivotColumns);
    }
}
