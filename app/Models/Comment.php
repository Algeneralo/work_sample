<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Multicaret\Acquaintances\Traits\CanBeLiked;

class Comment extends Model
{
    use SoftDeletes, CanBeLiked;

    protected $table = "topic_comments";

    public function alumnus()
    {
        return $this->belongsTo(Alumnus::class, 'alumnus_id')
            ->withoutGlobalScopes()
            ->withTrashed();
    }
}
