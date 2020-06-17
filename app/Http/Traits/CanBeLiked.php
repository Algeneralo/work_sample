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
        //this line is for fixing livewire auth issue
        if (auth()->guard("alumni")->check())
            auth()->login(auth()->guard("alumni")->user());
        $class = auth()->user() ? get_class(auth()->user()) : config('auth.providers.users.model');
        return $this->morphToMany($class, 'subject',
            config('acquaintances.tables.interactions'), "subject_id", "user_id")
            ->wherePivot('relation', '=', Interaction::RELATION_LIKE)
            ->withPivot(...Interaction::$pivotColumns);
    }

}
