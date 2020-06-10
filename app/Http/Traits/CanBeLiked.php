<?php


namespace App\Http\Traits;

use Multicaret\Acquaintances\Interaction;

/**
 * Trait CanBeLiked.
 */
trait CanBeLiked
{
    use \Multicaret\Acquaintances\Traits\CanBeLiked;

    /**
     * Return followers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likers()
    {
        return $this->morphToMany(get_class(auth()->user()), 'subject',
            config('acquaintances.tables.interactions'),"subject_id","user_id")
            ->wherePivot('relation', '=', Interaction::RELATION_LIKE)
            ->withPivot(...Interaction::$pivotColumns);
    }

}
